<?php

namespace App\Livewire\Admin\Datatables;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PatientTable extends DataTableComponent
{
    public function builder(): Builder
    {
        return Patient::query()->with('user');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "user.name")
                ->sortable(),
            Column::make("Cedula", "user.cedula")
                ->sortable(),
            Column::make("Email", "user.email")
                ->sortable(),
            Column::make("Celular", "user.phone")
                ->sortable(),
            Column::make("Acciones")
                ->label(function ($row) {
                    return view('admin.patients.actions', [
                        'patient' => $row
                    ]);
                })

        ];
    }
}
