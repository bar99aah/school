<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Plan;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $word = $request->input('word');
        if (empty($word)) {
            return response()->json([
                'status' => false,
                'message' => 'Please enter a search term'
            ],403);
        }
        $courses = Course::where('name', 'LIKE', '%' . $word . '%')->get();
        return response()->json([
            'status' => true,
            'courses' => $courses
        ]);
    }
}
