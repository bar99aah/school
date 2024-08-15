<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Mark;
use App\Models\MobileUser;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class MarkController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->stu_id === $request->student_id){
            $marks = Mark::where('mobile_user_id',$user->id)->get();
        }else{
            $user = MobileUser::where('stu_id',$request->student_id)->first();
            if($user){
                $marks = Mark::where('mobile_user_id',$user->id)->get();
            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'student number invalid'
                ],400);
            }
            return response()->json([
                'status' => true,
                'marks' => $marks
            ]);

        }

    }

    public function getUserMarks($userId)
    {
        $user = MobileUser::find($userId);
        $stu_id = $user->stu_id;
        if(!$user){
            return response()->json([
                'status' => false,
                'message' => 'user not exist'
            ],403);
        }
        $marks = Mark::all();

        $userMarks = [];

        foreach ($marks as $mark) {
            $filePath = public_path('marks/' . $mark->filePath);

            $spreadsheet = IOFactory::load($filePath);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            // Example: Assuming the first column (index 0) is the student's ID and the second column (index 2) contains the marks.
            foreach ($sheetData as $row) {
                if (isset($row[0]) && trim($row[0]) == $stu_id) { // Check if the user ID matches
                    $userMarks[] = [
                        'course_name' => $mark->course->name, // Assuming the Course model has a 'name' attribute
                        'teacher_name' => $mark->course->teacher_name, // Assuming the Course model has a 'name' attribute
                        'mark' => $row[2], // Assuming the mark is in the third column
                    ];
                    break; // Found the user, no need to check further rows
                }
            }
        }

        return response()->json([
            'status' => true,
            'user_name' => $user->f_name . ' ' . $user->m_name . ' ' . $user->l_name,
            'user_id' => $user->stu_id,
            'userMarks' => $userMarks
        ]);
    }
}
