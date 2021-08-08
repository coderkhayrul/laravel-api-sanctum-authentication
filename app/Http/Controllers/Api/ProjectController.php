<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // CREATE PROJECT API
    public function createProject(Request $request)
    {
        // Validation
        $request->validate([
            "name" => "required",
            "description" => "required",
            "duration" => "required",
        ]);

        // Student Id + Crate Data
        $student_id = auth()->user()->id;
        $project = new Project();
        $project->student_id = $student_id;
        $project->name = $request->name;
        $project->description = $request->description;
        $project->duration = $request->duration;
        $project->save();

        // Send Response
        return response()->json([
            'status' => '1',
            'message' => 'Project Create Successfully',
        ], 200);
    }

    // LIST PROJECT API
    public function listProject()
    {
    }

    // SINGLE PROJECT API
    public function singleProject($id)
    {
    }

    // DELETE PROJECT API
    public function deleteProject($id)
    {
    }
}
