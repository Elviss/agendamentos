<?php

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;

test('it can list appointments', function () {
    $user = User::factory()->create();
    Appointment::factory()->count(2)->create();

    $response = $this->actingAs($user, 'sanctum')
        ->getJson('/api/appointments');

    $response->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('it can create an appointment', function () {
    $user = User::factory()->create();
    $service = Service::factory()->create();
    $dateTime = now()->addDay()->setTime(10, 0, 0)->format('Y-m-d H:i:s');

    $response = $this->actingAs($user, 'sanctum')
        ->postJson('/api/appointment', [
            'service_id' => $service->id,
            'date_time' => $dateTime,
        ]);

    $response->assertStatus(201)
        ->assertJsonPath('data.client_name', $user->name)
        ->assertJsonPath('data.service_id', $service->id);

    $this->assertDatabaseHas('appointments', [
        'client_name' => $user->name,
        'service_id' => $service->id,
        'date_time' => $dateTime,
    ]);
});

test('it validates appointment creation', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user, 'sanctum')
        ->postJson('/api/appointment', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['service_id', 'date_time']);
});

test('it requires authentication to access appointments', function () {
    $this->getJson('/api/appointments')->assertStatus(401);
    $this->postJson('/api/appointment', [])->assertStatus(401);
});
