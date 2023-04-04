<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        //ToDo trycatch
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|min:6|max:12',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
            "success" => true,
            "message" => "User registered successfully",
            'data' => $user,
            "token" => $token
        ];
    return response($res, Response::HTTP_CREATED);
    }
}
