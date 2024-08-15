<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $plans = Plan::where('class_id',$user->class_id)->get();
        return response()->json([
            'status' => true,
            'plans' => $plans
        ]);
    }

}
