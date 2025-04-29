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
        return Attendance::query()->leftJoin('registrations', 'attendances.registration_id', 'registrations.id');
    }

    public function columns()
    {
        return [
            Column::name("registrations.name")
                ->label('Name')->searchable()->unwrap(),

            Column::name("registrations.email")
                ->label('Email')->searchable()->unwrap(),

            Column::name("registrations.holdings")
                ->label('Holdings')->searchable()->unwrap(),

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
