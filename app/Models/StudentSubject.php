<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_name'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function destroy($id)
    {
        $subject = StudentSubject::find($id);

        if (!$subject) {
            return response()->json([
                'status' => false,
                'message' => 'Subject not found'
            ], 404);
        }

        $subject->delete();

        return response()->json([
            'status' => true,
            'message' => 'Subject deleted successfully'
        ]);
    }
}
