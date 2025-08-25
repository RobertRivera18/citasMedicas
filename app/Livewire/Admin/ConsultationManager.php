<?php

namespace App\Livewire\Admin;

use App\Models\Appointment;
use App\Models\Consultation;
use Livewire\Component;

class ConsultationManager extends Component
{
   
    public Appointment $appointment;
    public Consultation $consultation;
    
    
    public $previousConsultations;

    public $form = [
        'diagnosis' => '',
        'treatment' => '',
        'notes' => '',
        'prescriptions' => [],
    ];

    public function mount(Appointment $appointment)
    {
        $this->consultation = $appointment->consultation;
        

        $this->form = [
            'diagnosis' => $this->consultation->diagnosis,
            'treatment' => $this->consultation->treatment,
            'notes' => $this->consultation->notes,
            'prescriptions' => $this->consultation->prescriptions ?? [
                [
                    'medicine' => '',
                    'dosage' => '',
                    'frequency' => '',
                ]
            ],
        ];
    }

    public function addPrescription(){
        return dd('Presionando el boton de eliminar m');
    }
    public function render()
    {
        return view('livewire.admin.consultation-manager');
    }
}
