<?php

namespace App\Http\Livewire\Tables;

use App\Models\Attendance;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Admissions extends LivewireDatatable
{
    public $exportable = true;
    public function builder()
    {
        return Attendance::with('registration');//query()->leftJoin('registrations', 'attendances.registration_id', 'registrations.id');
    }

    public function columns()
    {
        return [
            Column::name("registration.name")
            ->label('Name')->searchable()->unwrap(),

            Column::name("registration.email")
            ->label('Email')->searchable()->unwrap(),

            DateColumn::raw('attendances.date_admitted')
                ->label('Date Checked In')
                ->format('j F, Y H:i a')
                ->defaultSort('desc')->unwrap(),

        DateColumn::raw('attendances.date_admitted_master_class')
                ->label('Date Checked In For Master Class')
                ->format('j F, Y H:i a')
                ->defaultSort('desc')->unwrap()
        ];
    }
}
