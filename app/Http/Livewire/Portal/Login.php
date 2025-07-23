<?php

namespace App\Http\Livewire\Portal;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username, $password;

    public function render()
    {
        return view('livewire.portal.login')->extends('layouts.portal.auth')->section('content');
    }

    public function authenticateUser()
    {
        $this->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt(['email' => $this->username, 'password' => $this->password])) {
            return to_route('portal.dashboard');
        }
            flash()->addFlash('error', 'Username or Password is incorrect...');
            return;
    }
}
