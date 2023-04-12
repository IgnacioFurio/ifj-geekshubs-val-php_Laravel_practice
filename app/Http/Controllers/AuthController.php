<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            //code...
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
                "data" => $user,
                "token" => $token
            ];

            Mail::to([$request['email'], "eddieden@eddieden.mail"])->send(new RegisterMail($request['name']));

        return response()->json(
            [
                "success" => true,
                "message" => "User registered successfully",
                "data" => $res
            ],
            200
        );

        } catch (\Throwable $th) {
            //throw $th;
            Log::info("REGISTER USER ".$th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering new user"
                ],
                500
            );
        }
    }

    public function login(Request $request)
    {
        //ToDo TryCatch
        $request->validate([
            'email' => 'required|string',   
            'password' => 'required|string',
        ]);

        $user = User::query()->where('email', $request['email'])->first();
        // Validamos si el usuario existe
            if (!$user) {
            return response(
                [
                    "success" => false, 
                    "message" => "Email or password are invalid",
                ], 
                Response::HTTP_NOT_FOUND);
            }
            // Validamos la contraseña
            if (!Hash::check($request['password'], $user->password)) {
                return response(["success" => true, "message" => "Email or password are invalid"], Response::HTTP_NOT_FOUND);
            }

        $token = $user->createToken('apiToken')->plainTextToken;

        $res = [
                "success" => true, 
                "message" => "User logged successfully", 
                "token" => $token
            ];

        return response($res, Response::HTTP_ACCEPTED);
    }

    public function logout(Request $request)
    {
        $accessToken = $request->bearerToken();

        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);

        // Revoke token
        $token->delete();
        
        return response(
            [
                "success" => true,
                "message" => "Logout successfully"
            ],
            Response::HTTP_OK
        );
    }

    public function profile()
    {
        $user = auth()->user();

        return response(
            [
                "success" => true,
                "message" => "User profile get succsessfully",
                "data" => $user
            ],

        Response::HTTP_OK
        );
    }
}
