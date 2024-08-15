<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $exam = Exam::where('class_id',$user->class_id)->get();
        return response()->json([
            'status' => true,
            'exam' => $exam
        ]);
    }
}
