<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ScheduleManager extends Component
{

    public Doctor $doctor;
    public $schedule = [];
    public $days = [

        '1' => 'Lunes',
        '2' => 'Martes',
        '3' => 'Miercoles',
        '4' => 'Jueves',
        '5' => 'Viernes',
        '6' => 'Sabado',
        '0' => 'Domingo'
    ];

    public $apointment_duration = 15;
    public $intervals;


    public function mount()
    {

        $this->intervals = 60 / $this->apointment_duration;
    }
    #[Computed()]
    public function hourBlocks()
    {
        return CarbonPeriod::create(
            Carbon::createFromTimeString('08:00:00'),
            '1 hour',
            Carbon::createFromTimeString('18:00:00')
        );
    }


    public function render()
    {
        return view('livewire.admin.schedule-manager');
    }
}
