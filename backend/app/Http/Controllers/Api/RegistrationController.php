<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use App\Mail\UserRegistration;

use Hash;
use Str;

class RegistrationController extends Controller
{
    public function register(RegisterRequest $request): Response
    {
        [$firstName, $lastName] = getFirstLastName($request->get('name'));

        $user = User::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $user->verification_token = Str::random(64);
        $user->save();

        Mail::to($user->email)->send(new UserRegistration($user));

        return response(['message' => 'User created successfully', 'user' => $user], 201);
    }

    public function verifyEmail(Request $request, $token): Response
    {
        $user = User::where('verification_token', $token)->get()->first();

        if (!$user) {
            return Response(['message' => 'user not found', 'success' => false], 404);
        }

        if ($user->is_verified) {
            return Response(['message' => 'unprocessable entity', 'success' => false], 422);
        }

        $user->is_verified = true;
        $user->verification_token = null;
        $user->save();

        return Response(['message' => 'user is verified', 'success' => true], 200);
    }
}
