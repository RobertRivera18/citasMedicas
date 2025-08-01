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



    #[Computed()]
    public function hourBlocks()
    {
        return CarbonPeriod::create(
            Carbon::createFromTimeString('08:00:00'),
            '1 hour',
            Carbon::createFromTimeString('18:00:00')
        );
    }

    public function mount()
    {

        $this->intervals = 60 / $this->apointment_duration;
        $this->initializeSchedule();
    }

    public function initializeSchedule()
    {
        $schedules = $this->doctor->schedules();
        foreach ($this->hourBlocks() as $hourBlock) {
            $period = CarbonPeriod::Create(
                $hourBlock->copy(),
                $this->apointment_duration . 'minutes',
                $hourBlock->copy()->addHour(),

            );
            foreach ($period as $time) {

                foreach ($this->days as $index => $day) {
                    $this->schedule[$index][$time->format('H:i:s')] = false;
                }
            }
        }
        dd($this->schedule);
    }


    public function render()
    {
        return view('livewire.admin.schedule-manager');
    }
}
