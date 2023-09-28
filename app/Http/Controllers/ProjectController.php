<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\QueryBuilder;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projects=QueryBuilder::for(Project::class)
            ->allowedIncludes('tasks')
            ->paginate();
        return new  ProjectCollection($projects);
    }


    public function store(StoreProjectRequest $request)
    {
        $validated=$request->validated();
        $project=Auth::user()->projects()->create($validated);
        return new ProjectResource($project);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $validated=$request->validated();
        $project->update($validated);
        return new ProjectResource($project);
    }

    public function show (Request $request ,Project $project)
    {
        //هنا  تم تحميلها سوف تظهر في العرض
        return (new ProjectResource($project))
            ->load('tasks')
            ->load('members');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->noContent();
    }
}
