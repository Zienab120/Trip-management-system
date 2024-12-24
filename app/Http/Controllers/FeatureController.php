<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::with('plans')->get();
        return response()->json($features);
    }

    public function show(Feature $feature)
    {
        return response()->json($feature::with('plans')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $feature = Feature::create(['name' => $validated['name']]);

        return response()->json([
            'feature' => $feature,
            'message' => 'Feature created'
        ], 201);
    }

    // Update a feature
    public function update(Request $request, Feature $feature)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
        ]);

        $feature->update($validated);

        return response()->json(['message' => 'Feature updated', 'feature' => $feature]);
    }

    // Delete a feature
    public function destroy(Feature $feature)
    {
        if (!$feature) {
            return response()->json(['message' => 'Feature not found'], 404);
        }

        $feature->plans()->detach();
        $feature->delete();

        return response()->json(['message' => 'Feature deleted']);
    }
}
