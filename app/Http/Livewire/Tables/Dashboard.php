<?php

namespace App\Http\Livewire\Tables;

use App\Models\Registration;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class Dashboard extends LivewireDatatable
{
    public $exportable = true;

    public function builder()
    {
        return Registration::query()->leftJoin('qr_codes', 'qr_codes.registration_id', 'registrations.id');;
    }

    public function columns()
    {
        return [
            Column::name("name")
                ->label('Name')->searchable()->unwrap(),

            Column::name('email')
                ->label('Email')->searchable()->unwrap(),

            Column::name('phone')
                ->label('Phone')->unwrap(),

            Column::name('reason_for_attending')
                ->label('Reason For Attending')->unwrap(),
            Column::name('attending_masterclass')
                ->label('Attending MasterClasses')->unwrap(),
            Column::name('master_classes')->label('Master Classes')->unwrap(),

            Column::callback(['consent'], function ($consent) {
                return strtoupper($consent);
            })->unsortable()->label('Consent'),

            Column::callback(['is_zenith_customer'], function ($consent) {
                return strtoupper($consent);
            })->unsortable()->label('Is Zenith Customer'),

            DateColumn::raw('registrations.created_at')
                ->label('Date Registered')
                ->format('j F, Y H:i a')
                ->defaultSort('desc')->unwrap(),

            Column::callback(['qr_codes.token'], function ($token) {
                return view('table-actions', ['token' => $token]);
            })->excludeFromExport()->unsortable()->label('Action')
        ];
    }
}
