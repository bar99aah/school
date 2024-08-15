<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\UserClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = UserClass::all();
        return response()->json([
            'status' => true,
            'classes' => $classes
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
            'name' => 'required|string',
        ]);
        $class = UserClass::create($request->all());
        return response()->json([
            'status' => true,
            'class' => $class
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'User not authenticated'
            ],401);
        }
        $class = UserClass::findOrFail($id);
        return response()->json([
            'status' => true,
            'class' => $class
        ]);
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
        
        UserClass::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'class deleted successfully'
        ]);
    }
}
