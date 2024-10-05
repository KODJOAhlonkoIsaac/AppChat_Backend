<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\accountMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        // return response()->json(['messages' => $request->all()]);
        $user=new User();
        $user->name= $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        Mail::to($request->email)->send(new accountMail($request->name));
        $user->save();

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }
}
