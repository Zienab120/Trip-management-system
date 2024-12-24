<?php

namespace Tests\Feature;
use App\Models\Review;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function display_all_reviews()
    {
        $response = $this->getJson('/api/review');
        $response->assertStatus(200);
    }

    /** @test */
    public function store_new_review()
    {
        $review = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'rating' => fake()->numberBetween(1,5),
            'content' => fake()->text()
        ];

        $response = $this->postJson('api/review', $review);
        $response->assertStatus(201);
    }

    /** @test */
    public function show_specific_review()
    {
        $review = [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'rating' => fake()->numberBetween(1,5),
            'content' => fake()->realText()
        ];
        
        $response = $this->postJson('api/review', $review);
        $reviewId = $response->json('data.id');
        $response = $this->getJson("api/review/{$reviewId}");
        $response->assertStatus(200);
    }

    /** @test */
    public function update_review()
    {
        $review = Review::create([
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'rating' => fake()->numberBetween(1,5),
            'content' => fake()->realText()
        ]);

        $updatedReview = [
            'content' => 'new content'
        ];
        $response = $this->putJson("api/review/{$review->id}", $updatedReview);
        
        $response->assertStatus(200);
    }

    /** @test */
    public function delete_review()
    {
        $review = Review::create([
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'rating' => fake()->numberBetween(1,5),
            'content' => fake()->realText()
        ]);

        $response = $this->deleteJson("api/review/{$review->id}");
        $response->assertStatus(200);
    }
}
