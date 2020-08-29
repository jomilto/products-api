<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTokenController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'email'       => 'required|email',
            'password'    => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email',$request->get('email'))->first();

        if(!$user || !Hash::check($request->get('password'),$user->password)){
            throw ValidationException::withMessages([
                'email' => 'Bad Credencials'
            ]);
        }

        return response()->json([
            'token' => $user->createToken($request->get('device_name'))->plainTextToken
        ]);
    }
}
