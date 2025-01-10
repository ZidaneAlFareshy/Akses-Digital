<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function index(Request $request)
    {
        $query = Report::query();

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('type', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('generated_by', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Role filter
        // if ($request->filled('role')) {
        //     $query->where('role', $request->role);
        // }

        // Pagination with 10 staffs per page
        $reports = $query->paginate(10);

        return view('reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'date_generated' => 'required|date',
            'generated_by' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        Report::create($request->all());
        return redirect()->route('reports.index')->with('success', 'Report added successfully.');
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'type' => 'required|string|max:255' . $report->report_id . ',report_id',
            'date_generated' => 'required|date',
            'generated_by' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $report->update([
            'type' => $request->type,
            'date_generated' => $request->date_generated,
            'generated_by' => $request->generated_by,
            'description' => $request->description,
        ]);

        // $report->update($request->all());
        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
