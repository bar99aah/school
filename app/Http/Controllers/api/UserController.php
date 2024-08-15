<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DownloadExam;
use App\Models\DownloadFile;
use App\Models\DownloadMark;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\MobileUser;
use App\Models\Plan;
use App\Models\UserClass;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        $user = auth()->user();
        $user_name = $user->f_name . ' ' . $user->m_name . ' ' . $user->l_name;
        $class = UserClass::findOrFail($user->class_id);
        $class_name = $class->name;

        return response()->json([
            'status' => true,
            'user_name' => $user_name,
            'class_name' => $class_name,
            'student_id' => $user->stu_id,
            'phone_number' => $user->phone_number
        ]);
    }

    public function downloadMark(Request $request)
    {
        $user = auth()->user();
        $file = Mark::findOrFail($request->mark_id);
        if ($file) {
            $download = DownloadMark::create([
                'mobile_user_id' => $user->id,
                'mark_id' => $file->id
            ]);
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }


    }

    public function downloadPlan(Request $request)
    {
        $user = auth()->user();
        $file = Plan::findOrFail($request->plan_id);
        $download = DownloadFile::create([
            'mobile_user_id' => $user->id,
            'plan_id' => $file->id
        ]);

        return response()->json([
            'status' => true,
        ]);
    }
    public function downloadExam(Request $request)
    {
        $user = auth()->user();
        $file = Exam::findOrFail($request->exam_id);
        $download = DownloadExam::create([
            'mobile_user_id' => $user->id,
            'exam_id' => $file->id
        ]);

        return response()->json([
            'status' => true,
        ]);
    }

    public function getUserDownloads()
    {
        $user = auth()->user();
        $plans = $user->files()->get();
        $exams = $user->exams()->get();
        $marks = $user->marks()->get();

        $sortedArray = collect([])
        ->concat($plans)
        ->concat($exams)
        ->concat($marks)
        ->sortByDesc('created_at');

        return response()->json([
            'status' => true,
            'files' => $sortedArray
        ]);
    }

    public function getAllUsers(){
        $users = MobileUser::all();
        return response()->json([
            'users' => $users
        ]);
    }

}
