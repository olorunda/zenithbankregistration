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

        $credentials=['email' => $this->username, 'password' => $this->password];

        if (Auth::attempt($credentials)) {
            return to_route('portal.dashboard');
        } else {
            flash()->addFlash('error', 'Username or Password is incorrect...');
            return;
        }
    }
}
