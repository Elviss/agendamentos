<?php

use App\Models\Service;
use App\Models\User;

test('it can list services', function () {
    $user = User::factory()->create();
    Service::factory()->count(3)->create();

    $response = $this->actingAs($user, 'sanctum')
        ->getJson('/api/services');

    $response->assertStatus(200)
        ->assertJsonCount(3, 'data')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'duration', 'created_at', 'updated_at']
            ]
        ]);
});

test('it requires authentication to list services', function () {
    $response = $this->getJson('/api/services');

    $response->assertStatus(401);
});
