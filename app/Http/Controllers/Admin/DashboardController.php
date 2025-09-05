<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AppointmentEnum;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate as FacadesGate;

class DashboardController extends Controller
{
    public function index()
    {
        FacadesGate::authorize('access_dashboard');

        $data = [];

        if (auth()->user()->hasRole('Admin')) {
            $data['total_patients'] = Patient::count();
            $data['total_doctors'] = Doctor::count();
            $data['appointments_today'] = Appointment::whereDate('created_at', now())
                ->where('status', AppointmentEnum::SCHEDULED)
                ->count();
            $data['recent_users'] = User::latest()
                ->take(5)
                ->get();
        }

        if (auth()->user()->hasRole('Doctor')) {
            $data['appointments_today_count'] = Appointment::whereDate('created_at', now())
                ->where('status', AppointmentEnum::SCHEDULED)
                ->whereHas('doctor', function ($query) {
                    $query->where('user_id', auth()->id());
                })->count();

            $data['appointments_week'] = Appointment::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
                ->where('status', AppointmentEnum::SCHEDULED)
                ->whereHas('doctor', function ($query) {
                    $query->where('user_id', auth()->id());
                })->count();


            $data['next_appointment'] = Appointment::whereHas('doctor', function ($query) {
                $query->where('user_id', auth()->id());
            })
                ->where('status', AppointmentEnum::SCHEDULED)
                ->whereDate('date', '>=', now())
                ->whereTime('end_time', '>=', now()->toTimeString())
                ->orderBy('date')
                ->orderBy('start_time')
                ->first();
        }

        $data['appointments_today'] = Appointment::whereDate('created_at', now())
            ->where('status', AppointmentEnum::SCHEDULED)
            ->whereHas('doctor', function ($query) {
                $query->where('user_id', auth()->id());
            })->get();


        return view('admin.dashboard', compact('data'));
    }
}
