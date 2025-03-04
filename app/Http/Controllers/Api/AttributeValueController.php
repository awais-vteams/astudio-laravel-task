<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AttributeValueRequest;
use App\Http\Resources\AttributeValueResource;
use App\Models\AttributeValue;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AttributeValueController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $values = AttributeValue::paginate();

        return AttributeValueResource::collection($values);
    }

    public function store(AttributeValueRequest $request): JsonResponse
    {
        $attributeValue = AttributeValue::create($request->validated());

        return response()->json($attributeValue, 201);
    }

    public function show(AttributeValue $attributeValue): AttributeValue
    {
        return $attributeValue;
    }

    public function update(AttributeValueRequest $request, AttributeValue $attributeValue): JsonResponse
    {
        $attributeValue->update($request->validated());

        return response()->json($attributeValue);
    }

    public function destroy(AttributeValue $attributeValue): JsonResponse
    {
        $attributeValue->delete();

        return response()->json(null, 204);
    }
}
