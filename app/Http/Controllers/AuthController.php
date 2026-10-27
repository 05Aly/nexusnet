<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function demoSwitch(string $username)
    {
        $user = User::where('username', $username)->first() ?? User::first();
        if ($user) {
            Auth::login($user);
            request()->session()->regenerate();
        }
        return redirect()->route('feed');
    }
}
