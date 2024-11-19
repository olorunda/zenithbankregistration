<?php

namespace App\Http\Livewire\Portal;

use App\Models\QrCode;
use Livewire\Component;
use App\Models\Attendance;

class ViewDetails extends Component
{
    public function mount($id)
    {
        $this->details = QrCode::with(['registration', 'attendance'])->where('id', cleaner($id))->first();
        abort_if(!$this->details, 404);
    }

    public function render()
    {
        return view('livewire.portal.view-details')->extends('layouts.portal.dashboard')->section('content');
    }

    public function markPresent()
    {
        $this->details->update([
            'date_used' => now()->format('Y-m-d')
        ]);

        Attendance::updateOrCreate([ 'registration_id' => $this->details->registration->id],[
            'registration_id' => $this->details->registration->id,
            'date_admitted' => now()
        ]);

        flash()->addFlash('success', 'Successfully marked as present...');
        return;
    }

    public function markPresentMasterClass()
    {
        $this->details->update([
            'date_used_master_class' => now()->format('Y-m-d')
        ]);

        Attendance::updateOrCreate([ 'registration_id' => $this->details->registration->id],[
            'registration_id' => $this->details->registration->id,
            'date_admitted_master_class' => now()
        ]);

        flash()->addFlash('success', 'Successfully marked as present...');
        return;
    }
}
