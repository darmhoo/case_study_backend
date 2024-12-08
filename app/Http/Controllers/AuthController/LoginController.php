<?php

namespace App\Http\Controllers\AuthController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $user = User::where('email', $credentials['email'])->first();
            $token = $user->createToken($user->first_name . '-AuthToken')->plainTextToken;

            
            return response()->json([
                'token' => $token,
                'status' => 'success',
                'user' => $user
            ]);
        }

        return Response([
            'message' => 'Mismatch email and password!',
            'dd' => $credentials
        ], 401);
    }
}
