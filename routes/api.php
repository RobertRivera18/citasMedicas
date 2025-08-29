<?php

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/patients', function (Request $request) {
    return User::query()
        ->select('id', 'name', 'email')
        ->when(
            $request->search,
            fn($query) => $query
                ->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
        )
        ->when(
            $request->exists('selected'),
            fn($query) => $query->whereHas('patient', function ($query) use ($request) {
                $query->whereIn('id', $request->input('selected', []));
            }),
            fn($query) => $query->limit(10)
        )
        ->whereHas('patient')
        ->with('patient')
        ->orderBy('name')
        ->get()
        ->map(function (User $user) {
            return [
                'id'   => $user->patient->id,
                'name' => $user->name,
            ];
        });
})->name('api.patients.index');
Route::get('/appointments',function(Request $request){
$appoitments=Appointment::with(['patient.user','doctor.user'])
->whereBetween('date',[$request->start,$request->end])
->get();
return $appoitments->map(function($appointment){
return [ 
    'id'=>$appointment->id,
    'title'=>$appointment->patient->user->name,
    'start'=>$appointment->start,
    'end'=>$appointment->end,
    'color'=>$appointment->status->colorHex(),
    'extendedProps'=>[
             'dateTime'=>$appointment->start->format('d/m/Y H:i:s'),
             'patient'=>$appointment->patient->user->name,
             'doctor'=>$appointment->doctor->user->name,         
             'status'=>$appointment->status->label(),
             'color'=>$appointment->status->color(),
             'url'=> route('admin.appointments.consultation', $appointment),
    ]
];
})->values();
})->name('api.appointments.index');
