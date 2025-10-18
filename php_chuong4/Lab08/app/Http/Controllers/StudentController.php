<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('courses')->get();
        return view('students.index', compact('students'));
    }
}
