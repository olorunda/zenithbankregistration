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
        return Registration::query()->leftJoin('qr_codes', 'qr_codes.registration_id', 'registrations.id');
    }

    public function columns()
    {
        return [


            Column::callback(['qr_codes.id'], function ($id) {
                return view('table-actions', ['id' => $id]);
            })->excludeFromExport()->unsortable()->label('Action'),

            Column::name("name")
                ->label('Name')->searchable()->unwrap(),

            Column::name('email')
                ->label('Email')->searchable()->unwrap(),

            Column::name('qr_codes.token')
                ->label('Token')->searchable()->unwrap(),

            Column::name('phone')
                ->label('Phone')->unwrap(),

            Column::name('ran')
                ->label('RAN')->unwrap(),

//            Column::name('attending_masterclass')
//                ->label('Attending MasterClasses')->unwrap(),

//            Column::name('master_classes')->label('Master Classes')->unwrap(),

            Column::callback(['consent'], function ($consent) {
                return strtoupper($consent);
            })->unsortable()->label('Consent'),

//            Column::callback(['is_zenith_customer'], function ($consent) {
//                return strtoupper($consent);
//            })->unsortable()->label('Is Zenith Customer'),

            DateColumn::raw('registrations.created_at')
                ->label('Date Registered')
                ->format('j F, Y H:i a')
                ->defaultSort('desc')->unwrap()

        ];
    }
}
