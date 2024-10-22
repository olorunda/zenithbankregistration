<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.portal.dashboard')->extends('layouts.portal.dashboard')->section('content');
    }
}
