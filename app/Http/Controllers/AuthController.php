<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\accountMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // return response()->json(['messages' => $request->all()]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        Mail::to($request->email)->send(new accountMail($request->name));
        $user->save();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        // return response()->json(['messages' => $request->all()]);
        // $user = new User();
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if (!$user ||!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
        }
        // $user->password = Hash::make($request->password);
        // $user->save();
        $user->tokens()->delete();
        $user->token = $user->createToken($user->id)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }
}
