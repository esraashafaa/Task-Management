<?php

namespace App\Services;

use App\Models\Project;

class ProjectService
{
    public function update($validated, $id)
    {
        $project = Project::findOrFail($id);
        $project->update($validated);
    }

    public function index()
    {
        return  Project::with('user')->paginate(2);
    }

    public function store(array $validatedData)
    {

        Project::create([
            'name' => $validatedData['name'],
            'user_id' => auth()->id()
        ]);
    }
}
