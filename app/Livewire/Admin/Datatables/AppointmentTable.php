<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Appointment;

class AppointmentTable extends DataTableComponent
{
    protected $model = Appointment::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Patient id", "patient.user.name")
                ->sortable(),
            Column::make("Doctor id", "doctor_id")
                ->sortable(),
            Column::make("Date", "date")
                ->sortable(),
            Column::make("Start time", "start_time")
                ->sortable(),
            Column::make("End time", "end_time")
                ->sortable(),
            Column::make("Duration", "duration")
                ->sortable(),
            Column::make("Reason", "reason")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
