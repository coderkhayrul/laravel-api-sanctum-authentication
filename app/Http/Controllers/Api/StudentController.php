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
        // Validation Request
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Check Student
        $student = Student::where('email', '=', $request->email)->first();

        if (isset($student->id)) {

            if (Hash::check($request->password, $student->password)) {

                // Create a Token
                $token = $student->createToken("auth_token")->plainTextToken;

                // Send A Response
                return  response()->json([
                    'status' => '1',
                    'message' => 'Student Login Successfully',
                    'access_token' => $token
                ]);
            } else {
                return response()->json([
                    'status' => '0',
                    'message' => 'Password is incorrect',
                ], 404);
            }
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Student Not Found',
            ], 404);
        }
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
