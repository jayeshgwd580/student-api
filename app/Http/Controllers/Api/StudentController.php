<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'image' => 'nullable'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students', 'public');
        } 

        elseif ($request->image) {
            $imagePath = $request->image;
        }

        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imagePath
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Student created successfully',
            'data' => $student
        ]);
    }

    public function index()
    {
        $students = Student::with('subjects')->get();

        $data = $students->map(function ($student) {
            return [
                'name' => $student->name,
                'email' => $student->email,
                'image' => $student->image,
                'subject' => $student->subjects->pluck('subject_name')
            ];
        });

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }


    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email,' . $id,
            'image' => 'nullable'
        ]);

        if ($request->hasFile('image')) {

            if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
            }

            $imagePath = $request->file('image')->store('students', 'public');
            $student->image = $imagePath;

        } elseif ($request->image) {
            $student->image = $request->image;
        }

        $student->name = $request->name;
        $student->email = $request->email;
        $student->save();

        return response()->json([
            'status' => true,
            'message' => 'Student updated successfully',
            'data' => $student
        ]);
    }


    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'Student not found'
            ], 404);
        }

        if ($student->image && Storage::disk('public')->exists($student->image)) {
            Storage::disk('public')->delete($student->image);
        }

        $student->delete();

        return response()->json([
            'status' => true,
            'message' => 'Student deleted successfully'
        ]);
    }
}
