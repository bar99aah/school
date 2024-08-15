<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marks = Mark::all();
        return response()->json([
            'status' => true,
            'marks' => $marks
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
            'marks' => 'required',
            'course_id' => 'required'
        ]);

        $filePath = time() . '.' . $request->file('marks')->extension();
        $request->file('marks')->move(public_path('marks/'), $filePath);

        $mark = Mark::create([
            'course_id' =>$request->input('course_id'),
            'filePath' => $filePath
        ]);
        return response()->json([
            'status' => true,
            'mark' => $mark
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
        Mark::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'mark deleted successfully'
        ]);
    }
}
