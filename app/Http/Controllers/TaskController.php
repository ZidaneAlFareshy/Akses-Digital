<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Request $request)
    {
        $query = Task::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('task_name', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('assignee', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('status', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        // }

        // Pagination with 10 staffs per page
        $tasks = $query->paginate(10);

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_name' => 'required|string|max:255',
            'assignee' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required|string|max:255',
            'progress' => 'required|string|max:255',
        ]);

        Task::create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'task_name' => 'required|string|max:255' . $task->task_id . ',task_id',
            'assignee' => 'required|string|max:255',
            'priority' => 'required|string|max:255',
            'deadline' => 'required|date',
            'status' => 'required|string|max:255',
            'progress' => 'required|string|max:255',
        ]);

        $task->update([
            'task_name' => $request->task_name,
            'assignee' => $request->assignee,
            'priority' => $request->priority,
            'deadline' => $request->deadline,
            'status' => $request->status,
            'progress' => $request->progress,
        ]);

        // $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
