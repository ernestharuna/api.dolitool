<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:2', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' =>  ['required', 'confirmed', Password::min(8)->letters()->symbols()],
        ]);

        /**
         * @var User $user
         */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($user);

        return response()->json([
            'user' => $user,
            'message' => 'Registration successful',
        ], 201);
    }
}
