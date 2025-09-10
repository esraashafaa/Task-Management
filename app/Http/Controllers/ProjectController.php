<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('user')->paginate(2);
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Project::create([
            'name' => $request->name,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('projects');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('tasks.user')->where('id', $id)
            ->firstOrFail();
        return view("project.edit", compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['nullable']
        ]);

        $project = Project::findOrFail($id);
        $project->update($validated);

        return redirect()->route('projects');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('projects');

        //
    }
}
