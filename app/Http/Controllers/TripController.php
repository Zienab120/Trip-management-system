<?php

namespace App\Http\Controllers;
use App\Http\Requests\Trip\TripStoreRequest;
use App\Http\Requests\Trip\TripUpdateRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        return response()->json([
            "Trips" => Trip::all(),
            'message' => 'All trips are retrieved successfully.'
        ], 200);
    }

    public function store(TripStoreRequest $request)
    {
        // return response()->json('done');
        $trip = Trip::create($request->validated());

        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('trip/images', 'public');
            $imagePath = asset('storage/' . $path);
            $trip->image = $imagePath;
        }

        return response()->json([
            "Trip" => $trip,
            'message' => 'Trip is created successfully.'
        ], 201);
    }

    public function update(TripUpdateRequest $request, Trip $trip)
    {
        $trip->update($request->validated());
        if($request->hasFile('image'))
        {
            $path = $request->file('image')->store('trip/images', 'public');
            $imagePath = asset('storage/' . $path);
            $trip->image = $imagePath;
        }

        return response()->json([
            "Trip" => $trip,
            'message' => 'Trip is updated successfully.'
        ], 200);
    }

    public function show(Trip $trip)
    {
        return response()->json([
            'Trip' => $trip,
            'message' => 'Trip is retrieved successfully.'
        ], 200);
    }

    public function destroy(Trip $trip)
    {
        if(!$trip->exists())
            return response()->json(['message' => "Not Found"], 404);
        
        $trip->delete();

        return response()->json([
            'message' => 'Trip is deleted successfully.'
        ], 200);
    }
}

