<?php

namespace App\Livewire\Admin;

use App\Models\Doctor;
use Livewire\Component;

class ScheduleManager extends Component
{

    public Doctor $doctor;
    public $schedule = [];
    public $days = [

        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        '0'
    ];
    public function render()
    {
        return view('livewire.admin.schedule-manager');
    }
}
