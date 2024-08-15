<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\MobileUser;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $user = MobileUser::where('phone_number', $request->input('phone_number'))->first();

        $requestData = $request->all();
        $randomNumber = mt_rand(10, 99); // Generates a random four-digit number
        $stuId = 'C' . $requestData['class_id'] . $randomNumber;
        if ($user) {
            return response()->json([
                'status'=>false,
                'message'=> 'Already Exist'
            ],403);
        } else {
            $user = MobileUser::create([
                'f_name' => $requestData['f_name'],
                'm_name' => $requestData['m_name'],
                'l_name' => $requestData['l_name'],
                'phone_number' => $requestData['phone_number'],
                'password' => Hash::make($requestData['password']) ,
                'class_id' => $requestData['class_id'],
                'stu_id' => $stuId,
            ]);

        }
        $token = $user->createToken('Api Token')->plainTextToken ;
        UserToken::create([
            'mobile_user_id' => $user->id,
            'api_token' =>$token
        ]);
        return response()->json([
            'status'=>true,
            'user' => $user,
            'token' => $token,
            'message'=> 'User regestered successfully'
        ]);
    }

    public function logIn(Request $request)
    {
        $user = MobileUser::where('phone_number', $request->input('phone_number'))->first();
        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json([
                'status'=>false,
                'message'=> 'Invalid phone number or password'
            ],401);
        }
        $token = $user->createToken('API TOKEN')->plainTextToken;
        UserToken::create([
            'mobile_user_id' => $user->id,
            'api_token' =>$token
        ]);
        return response()->json(['status' => true, 'token' => $token]);
    }
}
