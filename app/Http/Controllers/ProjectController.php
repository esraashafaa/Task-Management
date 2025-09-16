<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function __construct(protected ProjectService $projectService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = $this->projectService->index();
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
    public function store(StoreProjectRequest $request)
    {
        $this->projectService->store($request->validated());
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
    public function edit(Project $project)
    {
        $project = $project->load('task.user');
        // $project = Project::with('tasks.user')->where('id', $id)
        //     ->firstOrFail();
        return view("project.edit", compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, string $id)
    {
        $validated = $request->validated();

        (new ProjectService())->update($validated, $id);
        return response()->json();
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
