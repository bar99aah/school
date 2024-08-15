<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Course;
use App\Models\File;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
class FileController extends Controller
{
    public function index($course_id)
    {
        $files = File::where('course_id',$course_id)->get();
        $course = Course::findOrFail($course_id);
        $course_name = $course->name;
        return response()->json([
            'status' => true,
            'course_name' => $course_name,
            'files' => $files
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
            'exam' => 'required',
            'class_id'=> 'required'
        ]);

        $filePath = time() . '.' . $request->file('file')->extension();
        $request->file('file')->move(public_path('files/'), $filePath);

            $file = File::create([
                'course_id' =>$request->input('course_id'),
                'filePath' => $filePath
            ]);



        return response()->json([
            'status' => true,
            'file' => $file
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
        File::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'file deleted successfully'
        ]);
    }
}
