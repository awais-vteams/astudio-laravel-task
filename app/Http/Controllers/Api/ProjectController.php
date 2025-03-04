<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = $request->user()->projects()->filter($request->query());

        $projects = $query->with('timesheets', 'attributeValues.attribute')->paginate();

        return ProjectResource::collection($projects);
    }

    public function store(ProjectRequest $request): JsonResponse
    {
        $project = $request->user()->projects()->create($request->only('name', 'status'));

        // Handle dynamic attributes
        if ($request->has('attr')) {
            foreach ($request->attr as $attribute) {
                $project->attributeValues()->create([
                    'attribute_id' => $attribute['id'],
                    'value' => $attribute['value'],
                ]);
            }
        }

        return response()->json($project, 201);
    }

    public function show(Project $project): Project
    {
        return $project->load('attributeValues');
    }

    public function update(ProjectRequest $request, Project $project): JsonResponse
    {
        $project->update($request->only('name', 'status'));

        // Update dynamic attributes
        if ($request->has('attr')) {
            foreach ($request->attr as $attribute) {
                $project->attributeValues()->updateOrCreate(
                    ['attribute_id' => $attribute['id']],
                    ['value' => $attribute['value']]
                );
            }
        }

        return response()->json($project);
    }

    public function destroy(Project $project): JsonResponse
    {
        $project->delete();

        return response()->json(null, 204);
    }
}
