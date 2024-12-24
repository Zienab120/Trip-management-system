<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Contact;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function store_new_contact()
    {
        $contact = [
            'name' => 'Mekka',
            'email' => fake()->email,
            'content' => fake()->realText()
        ];

        $response = $this->postJson('api/contact', $contact);
        $response->assertStatus(201);
    }
}
