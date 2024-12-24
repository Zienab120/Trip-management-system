<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Trip;

class TripTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function display_all_trips()
    {
        $response = $this->getJson('/api/trip');
        $response->assertStatus(200);
    }

    /** @test */
    public function store_new_trip()
    {
        $trip = [
            'destination' => 'Mekka',
            'cost' => 200,
            'days' => 10,
            'image' => fake()->imageUrl()
        ];

        $response = $this->postJson('api/trip', $trip);
        $response->assertStatus(201);
    }

    /** @test */
    public function show_specific_trip()
    {
        $trip = [
            'destination' => 'Mekka',
            'cost' => 200,
            'days' => 10,
            'image' => fake()->image()
        ];
        
        $response = $this->postJson('api/trip', $trip);
        $tripId = $response->json('data.id');
        $response = $this->getJson("api/trip/{$tripId}");
        $response->assertStatus(200);
    }

    /** @test */
    public function update_trip()
    {
        $trip = Trip::create([
            'destination' => 'Mekka',
            'cost' => 200,
            'days' => 10,
            'image' => fake()->image()
        ]);

        $updatedTrip = [
            'days' => 15
        ];
        $response = $this->putJson("api/trip/{$trip->id}", $updatedTrip);
        
        $response->assertStatus(200);
    }

    /** @test */
    public function delete_trip()
    {
        $trip = Trip::create([
            'destination' => 'Mekka',
            'cost' => 200,
            'days' => 10,
            'image' => fake()->image()
        ]);

        $response = $this->deleteJson("api/trip/{$trip->id}");
        $response->assertStatus(200);
    }

}
