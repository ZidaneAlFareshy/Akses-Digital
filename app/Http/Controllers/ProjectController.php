<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $query = Project::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('project_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('status', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        // }

        // Pagination with 10 staffs per page
        $projects = $query->paginate(10);

        return view('projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'deadline' => 'required|date',
            'staff' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'progress' => 'required|string|max:255',
        ]);

        Project::create($request->all());
        return redirect()->route('projects.index')->with('success', 'Project added successfully.');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'project_name' => 'required|string|max:255' . $project->project_id . ',project_id',
            'start_date' => 'required|date',
            'deadline' => 'required|date',
            'staff' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'progress' => 'required|string|max:255',
        ]);

        $project->update([
            'project_name' => $request->project_name,
            'start_date' => $request->start_date,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'staff' => $request->staff,
            'progress' => $request->progress,
        ]);

        // $project->update($request->all());
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
