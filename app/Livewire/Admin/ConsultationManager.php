<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Consultation;
use Livewire\Component;

class ConsultationManager extends Component
{
    public Appointment $appointment;
    public Consultation $consultation;
    public $form = [];

    public function mount(Appointment $appointment)
    {
        $this->consultation = $appointment->consultation;
        $this->form =[
            'diagnosis'=> $this->consultation->diagnosis,
             'treatment'=> $this->consultation->treatment,
              'notes'=> $this->consultation->notes,
              'prescriptions'=>$this->consultation->prescriptions ?? [
                [

                ]
                ],

        ];
        
    }
    public function render()
    {
        return view('livewire.admin.consultation-manager');
    }
}
