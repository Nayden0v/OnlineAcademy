<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Http\Resources\StudentCollection;

class StudentController extends Controller
{
   public function index()
   {
        $students = Student::all();

        return new StudentCollection($students);
   }

   public function delete(int $user_id)
   {
        Student::where('user_id', $user_id)->delete();

        return response()->json(['message' => 'Student is succesfully deleted.', 204]);
   }
}
