<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\TimesheetRequest;
use App\Http\Resources\TimesheetResource;
use App\Models\Timesheet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TimesheetController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $timesheets = $request->user()->timesheets()->paginate();

        return TimesheetResource::collection($timesheets);
    }

    public function store(TimesheetRequest $request): JsonResponse
    {
        $timesheet = $request->user()->timesheets()->create($request->validated());

        return response()->json($timesheet, 201);
    }

    public function show(Timesheet $timesheet): Timesheet
    {
        return $timesheet;
    }

    public function update(TimesheetRequest $request, Timesheet $timesheet): JsonResponse
    {
        $timesheet->update($request->all());

        return response()->json($timesheet);
    }

    public function destroy(Timesheet $timesheet): JsonResponse
    {
        $timesheet->delete();

        return response()->json(null, 204);
    }
}
