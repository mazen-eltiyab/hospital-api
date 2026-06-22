<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return response()->json(['departments' => $departments]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'icon_url' => 'nullable|string'
        ]);

        $department = Department::create($validated);
        
        return response()->json([
            'message' => 'Department created successfully',
            'department' => $department
        ], 201);
    }
}
