<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

class RegisterNewUser
{
    /**
     * Handle an authentication attempt.
     */
    public function handle(Request $request)
    {
        return User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    }
}
