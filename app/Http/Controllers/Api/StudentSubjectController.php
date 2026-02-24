<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentSubject;

class StudentSubjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_name' => 'required|string'
        ]);

        $subject = StudentSubject::create([
            'student_id' => $request->student_id,
            'subject_name' => $request->subject_name
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Subject added to student successfully',
            'data' => $subject
        ]);
    }

    public function update(Request $request, $id)
    {
        $subject = StudentSubject::find($id);

        if (!$subject) {
            return response()->json([
                'status' => false,
                'message' => 'Subject not found'
            ], 404);
        }

        $request->validate([
            'student_id' => 'required|exists:students,id',
            'subject_name' => 'required|string'
        ]);

        $subject->student_id = $request->student_id;
        $subject->subject_name = $request->subject_name;
        $subject->save();

        return response()->json([
            'status' => true,
            'message' => 'Subject updated successfully',
            'data' => $subject
        ]);
    }
}
