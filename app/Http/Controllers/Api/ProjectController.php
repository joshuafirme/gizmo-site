<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::latest()->get();
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
        }

        return Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
    }

    public function update(Request $request, $id)
    {

        $project = Project::findOrFail($id);

        if ($request->hasFile('image')) {
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->update($request->only('title', 'description', 'start_date', 'end_date'));

        return response()->json(['message' => 'Updated']);
    }

    public function destroy($id)
    {
        Project::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
