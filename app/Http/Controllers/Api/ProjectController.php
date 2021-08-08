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
        $student_id = auth()->user()->id;

        $porjects = Project::where('student_id', $student_id)->get();

        // Send Response
        return response()->json([
            'status' => '1',
            'message' => 'Project Project',
            'data' => $porjects
        ], 200);
    }

    // SINGLE PROJECT API
    public function singleProject($id)
    {
        $student_id = auth()->user()->id;

        if (Project::where(['id' => $id, 'student_id' => $student_id])->exists()) {

            $project_detail = Project::where(['id' => $id, 'student_id' => $student_id])->first();
            // Send Response
            return response()->json([
                'status' => '1',
                'message' => 'Project Show',
                'data' => $project_detail
            ], 200);
        } else {
            // Send Response
            return response()->json([
                'status' => '0',
                'message' => 'Project Not Found',
            ], 404);
        }
    }

    // DELETE PROJECT API
    public function deleteProject($id)
    {
    }
}
