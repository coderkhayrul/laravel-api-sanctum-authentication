<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // STUDENT REGISTER API
    public function register(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required | email |unique:students',
            'password' => 'required| confirmed',
        ]);

        // $Create Data
        $student = new Student();
        $student->name = $request->name;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->phone_no = isset($request->phone_no) ? $request->phone_no : '';
        $student->save();

        // Sent Response
        return response()->json([
            'status' => '1',
            'message' => 'Student Register Successfully',
        ]);
    }

    // STUDENT LOGIN API
    public function login(Request $request)
    {
    }

    // STUDENT PROFILE API
    public function profile($id)
    {
    }

    // STUDENT LOGOUT API
    public function logout($id)
    {
    }
}
