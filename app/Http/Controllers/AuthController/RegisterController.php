<?php

namespace App\Http\Controllers\AuthController;

use App\Actions\RegisterNewUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{

    public function register(Request $request, RegisterNewUser $registerNewUser)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'password' => ['required', 'confirmed', Password::min(5)],
        ]);

        $user = $registerNewUser->handle($request);

        if ($user) {
            return response()->json([
                'user' => $user,
                'status' => 'success'
            ], 201);
        }



        return Response([
            'message' => 'Mismatch email and password!'
        ], 401);
    }
}
