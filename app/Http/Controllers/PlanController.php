<?php

namespace App\Http\Controllers;

use App\Http\Requests\Plan\PlanStoreRequest;
use App\Http\Requests\Plan\PlanUpdateRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        return response()->json([
            'Plans' => Plan::all(),
            'message' => 'All available plans are retrieved successfully.'
        ]);
    }

    public function store(PlanStoreRequest $request)
    {

        $plan = Plan::create($request->validated());

        return response()->json([
            'Plan' => $plan,
            'message' => 'Plan is created successfully.'
        ], 201);
    }

    public function update(PlanUpdateRequest $request, Plan $plan)
    {
        $plan->update($request->validated());

        return response()->json([
            'Plan' => $plan,
            'message' => 'Plan is updated successfully.'
        ]);
    }

    public function show(Plan $plan)
    {
        return response()->json([
            'Plan' => $plan,
            'message' => 'Plan is updated successfully.'
        ]);
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return response()->json([
            'message' => 'Plan is deleted successfully.'
        ]);
    }
}
