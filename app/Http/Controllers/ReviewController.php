<?php

namespace App\Http\Controllers;
use App\Http\Requests\Review\ReviewStoreRequest;
use App\Http\Requests\Review\ReviewUpdateRequest;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        return response()->json([
            'Reviews' => Review::paginate(5),
            'message' => 'Reviews are retrieved successfully.'
        ]);
    }

    public function store(ReviewStoreRequest $request)
    {
        $review = Review::create($request->validated());
        
        if($request->hasFile('profile_picture'))
        {
            $path = $request->file('profile_picture')->store('profile-picture/images', 'public');
            $imagePath = asset('storage/' . $path);
            $review->profile_picture = $imagePath;
        }

        return response()->json([
            'Review' => $review,
            'message' => 'Reviews are created successfully.'
        ], 201);
        
    }

    public function update(ReviewUpdateRequest $request, Review $review)
    {
        $review->update($request->validated());

        if($request->hasFile('profile_picture'))
        {
            $path = $request->file('profile_picture')->store('profile-picture/images', 'public');
            $imagePath = asset('storage/' . $path);
            $review->image = $imagePath;
        }

        return response()->json([
            'Review' => $review,
            'message' => 'Reviews are updated successfully.'
        ]);
        
    }

    public function show(Review $review)
    {
        return response()->json([
            'Review' => $review,
            'message' => 'Reviews are retrieved successfully.'
        ]);
        
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json([
            'message' => 'Reviews are deleted successfully.'
        ]);
        
    }
}
