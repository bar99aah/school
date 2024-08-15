<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = Plan::all();
        return response()->json([
            'status' => true,
            'plans' => $plans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plan' => 'required',
            'class_id' => 'required',
        ]);
        $plan = Plan::where('class_id',$request->input('class_id'))->first();
        $filePath = time() . '.' . $request->file('plan')->extension();
        $request->file('plan')->move(public_path('plans/'), $filePath);
        if(!$plan){
            $plan = Plan::create([
                'class_id' =>$request->input('class_id'),
                'filePath' => $filePath
            ]);
        }else{
            $plan->update([
                'class_id' =>$request->input('class_id'),
                'filePath' => $filePath
            ]);
        }



        return response()->json([
            'status' => true,
            'plan' => $plan
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Plan::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'plan deleted successfully'
        ]);
    }
}
