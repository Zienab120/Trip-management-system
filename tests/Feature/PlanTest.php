<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Plan;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function display_all_plans()
    {
        $response = $this->getJson('/api/plan');
        $response->assertStatus(200);
    }

    /** @test */
    public function store_new_plan()
    {
        $plan = [
            'name' => 'Person',
            'price' => 200,
            'description' => fake()->text,
            'features' => 'Features'
        ];
        $response = $this->postJson('api/plan', $plan);
        $response->assertStatus(201);
    }

    /** @test */
    public function show_specific_plan()
    {
        $plan = [
            'name' => 'Person',
            'price' => 200,
            'description' => fake()->text,
            'features' => 'Features'
        ];
        
        $response = $this->postJson('api/plan', $plan);
        $planId = $response->json('data.id');
        $response = $this->getJson("api/plan/{$planId}");
        $response->assertStatus(200);
    }

    /** @test */
    public function update_plan()
    {
        $plan = Plan::create([
            'name' => 'Person',
            'price' => 200,
            'description' => fake()->text,
            'features' => 'Features'
        ]);

        $updatedPlan = [
            'price' => 250
        ];

        $response = $this->putJson("api/plan/{$plan->id}", $updatedPlan);
        
        $response->assertStatus(200);
    }

    /** @test */
    public function delete_plan()
    {
        $plan = Plan::create([
            'name' => 'Person',
            'price' => 200,
            'description' => fake()->text,
            'features' => 'Features'
        ]);

        $response = $this->deleteJson("api/plan/{$plan->id}");
        $response->assertStatus(200);
    }

}
