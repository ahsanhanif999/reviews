<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;

use Auth;
use Validator;

class AuthController extends Controller
{

    public function register(): Response
    {

    }

    public function login(Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){

            return Response(['message' => $validator->errors()], 401);
        }

        if(Auth::attempt($request->all())){

            $user = Auth::user();
            $token =  $user->createToken('ReviewsApp')->plainTextToken;

            return Response(['token' => $token], 200);
        }

        return Response(['message' => 'email or password wrong'], 401);
    }

    public function logout(): Response
    {
        $user = Auth::user();

        $user->currentAccessToken()->delete();

        return Response(['data' => 'User Logout successfully.'], 200);
    }
}
