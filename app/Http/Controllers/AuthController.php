<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create(
            $request->only('first_name', 'last_name', 'email')
            + [
                'password' => \Hash::make($request->input('password')),
                'is_admin' => 1,
            ]
        );
        return response($user, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        if (!\Auth::attempt($request->only('email', 'password'))) {
            return response(['error' => 'Invalid credentials'], Response::HTTP_UNAUTHORIZED);
        };

        $user = \Auth::user();
        $jwt = $user->createToken('token')->plainTextToken;
        $cookie = $cookie = cookie('jwt', $jwt, 60 * 24);
        return response([
            'message' => 'Logged in successfully',
        ])->withCookie($cookie);
    }
}
