<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // public function register(Request $request)
    // {
    //     $user = User::where('email', $request->input('email'))->first();

    //     $requestData = $request->all();
    //     if ($user) {
    //         return response()->json([
    //             'status'=>false,
    //             'message'=> 'Already Exist'
    //         ],403);
    //     } else {
    //         $user = User::create([
    //             'f_name' => $requestData['name'],
    //             'email' => $requestData['eamil'],
    //             'password' => Hash::make($requestData['password']) ,
    //         ]);
    //     }
    //     $token = $user->createToken('Api Token')->plainTextToken  ;
    //     return response()->json([
    //         'status'=>true,
    //         'user' => $user,
    //         'token' => $token,
    //         'message'=> 'User regestered successfully'
    //     ]);
    // }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'status'=>false,
                'message'=> 'Invalid email or password'
            ],401);
        }
        $token = $user->createToken('API TOKEN')->plainTextToken;
        $user->api_token = $token;
        $user->save();
        return response()->json(['status' => true, 'token' => $token]);
    }
}
