<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttributeRequest;
use App\Http\Resources\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $attributes = Attribute::paginate();

        return AttributeResource::collection($attributes);
    }

    public function store(AttributeRequest $request): JsonResponse
    {
        $attribute = Attribute::create($request->validated());

        return response()->json($attribute, 201);
    }

    public function show(Attribute $attribute): Attribute
    {
        return $attribute;
    }

    public function update(AttributeRequest $request, Attribute $attribute): JsonResponse
    {
        $attribute->update($request->validated());

        return response()->json($attribute);
    }

    public function destroy(Attribute $attribute): JsonResponse
    {
        $attribute->delete();

        return response()->json(null, 204);
    }
}
