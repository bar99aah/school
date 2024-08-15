<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($class_id)
    {
        $exams = Exam::where('class_id',$class_id)->get();
        return response()->json([
            'status' => true,
            'exams' => $exams
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
        $exam = Exam::where('class_id',$request->class_id)->first();
        $validated = $request->validate([
            'exam' => 'required',
            'class_id'=> 'required'
        ]);

        $filePath = time() . '.' . $request->file('exam')->extension();
        $request->file('exam')->move(public_path('exams/'), $filePath);
        if(!$exam){
            $exam = Exam::create([
                'class_id' =>$request->input('class_id'),
                'filePath' => $filePath
            ]);
        }else{
            $exam->update([
                'class_id' =>$request->input('class_id'),
                'filePath' => $filePath
            ]);
        }


        return response()->json([
            'status' => true,
            'exam' => $exam
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
        Exam::where('id',$id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'exam deleted successfully'
        ]);
    }
}
