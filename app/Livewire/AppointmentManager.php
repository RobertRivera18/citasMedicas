<?php

namespace App\Livewire;

use App\Models\Appointment;
use App\Models\Speciality;
use App\Services\AppointmentService;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

class AppointmentManager extends Component
{

    public $search = [
        'date' => '',
        'speciality_id' => '',
        'hour' => ''
    ];

    public $specialities = [];
    public $availability= [];
    public $appointment = [
        'patient_id' => '',
        'doctor_id' => '',
        'date' => '',
        'start_time' => '',
        'end_time' => '',
        'duration' => '',
        'reason' => '',
        'status' => '',



    ];
    public function mount()
    {
        $this->specialities = Speciality::all();
        $this->search['date'] = now()->hour >= 12
            ? now()->addDay()->format('Y-m-d')
            : now()->format('Y-m-d');
    }

    #[Computed()]
    public function hourBlocks()
    {
        return CarbonPeriod::create(
            Carbon::createFromTimeString(config('schedule.start_time')),
            '1 hour',
            Carbon::createFromTimeString(config('schedule.end_time'))
        )->excludeEndDate();
    }

    public function searchAvailability(AppointmentService $service)
    {
        $this->validate([
            'search.date' => 'required|date|after_or_equal:today',
            'search.hour' => [
                'required',
                'date_format:H:i:s',
                Rule::when(
                    $this->search['date'] === now()->format('Y-m-d'),
                    ['after_or_equal:' . now()->format('H:i:s')]
                )
            ],


        ]);
        $this->availability = $service->searchAvailability(...$this->search);
        $this->appointment['date'] = $this->search['date'];
    }
    public function render()
    {
        return view('livewire.appointment-manager');
    }
}
