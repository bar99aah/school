<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $courses = Course::where('class_id',$user->class_id)->get();
        return response()->json([
            'status' => true,
            'courses' => $courses
        ]);
    }
}
