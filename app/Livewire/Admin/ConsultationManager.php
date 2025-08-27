<?php

namespace App\Livewire\Admin;

use App\Enums\AppointmentEnum;
use App\Models\Appointment;
use App\Models\Consultation;
use App\Models\Patient;
use Livewire\Component;

class ConsultationManager extends Component
{
   
    public Appointment $appointment;
    public Consultation $consultation;
    public Patient $patient;    
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
        $this->patient=$appointment->patient;
        $this->previousConsultations=Consultation::whereHas('appointment',function($query){
         $query->where('patient_id',$this->patient->id);
        })->where('id','!=',$this->consultation->id)
          ->where('created_at','<',$this->consultation->created_at)
           ->latest()
           ->take(5)
           ->get();
        

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
        $this->form['prescriptions'][]=[
            'medicine'=>'',
            'dosage' => '',
            'frequency' => '',
        ];
    }
    public function removePrescriptions($index){
        unset($this->form['prescriptions'][$index]);
        $this->form['prescriptions']=array_values($this->form['prescriptions']);
    }

    public function save(){
        $this->validate([
        'form.diagnosis'=>'required|string|max:255',
        'form.treatment'=>'required|string|max:255',
        'form.notes'=>'nullable|string|max:1000',
        'form.prescriptions'=>'required|array|min:1',
        'form.prescriptions.*.medicine'=>'required|string|max:255',
        'form.prescriptions.*.dosage'=>'required|string|max:255',
        'form.prescriptions.*.frequency'=>'required|string|max:255',
        ]);
        $this->consultation->update($this->form);
        $this->appointment->status=AppointmentEnum::COMPLETED;
        $this->appointment->save();
       $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Consulta Guardada Correctamente',
            'text' => 'Los Detalles de la Consulta han sido Actualizados',
        ]);

    }


    public function render()
    {
        return view('livewire.admin.consultation-manager');
    }
}
