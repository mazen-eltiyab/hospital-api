<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class DepartmentController extends Controller
{
    public function index()
    {
        $services = Service::where('status', 'active')->get();
        $departments = $services->map(function ($s) {
            return [
                'id' => $s->id,
                'name' => $s->service_name,
                'description' => '',
                'icon_url' => null,
            ];
        });
        return response()->json(['departments' => $departments]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $service = Service::create([
            'service_name' => $validated['name'],
            'price' => 0,
            'status' => 'active'
        ]);
        
        return response()->json([
            'message' => 'Department created successfully',
            'department' => [
                'id' => $service->id,
                'name' => $service->service_name,
                'description' => $validated['description'] ?? '',
                'icon_url' => null,
            ]
        ], 201);
    }
}
