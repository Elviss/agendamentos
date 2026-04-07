<?php

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->service = Service::factory()->create();
});

test('it cannot create an appointment at the same time as another', function () {
    $dateTime = '2026-04-07 10:00:00';

    Appointment::factory()->create([
        'date_time' => $dateTime,
    ]);

    $response = $this->actingAs($this->user, 'sanctum')
        ->postJson('/api/appointment', [
            'service_id' => $this->service->id,
            'date_time' => $dateTime,
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['date_time']);
});

test('it cannot create an appointment before 8 am', function () {
    $dateTime = '2026-04-07 07:59:59';

    $response = $this->actingAs($this->user, 'sanctum')
        ->postJson('/api/appointment', [
            'service_id' => $this->service->id,
            'date_time' => $dateTime,
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['date_time']);
});

test('it cannot create an appointment after 6 pm', function () {
    $dateTime = '2026-04-07 18:00:01';

    $response = $this->actingAs($this->user, 'sanctum')
        ->postJson('/api/appointment', [
            'service_id' => $this->service->id,
            'date_time' => $dateTime,
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['date_time']);
});

test('it can create an appointment at 8 am', function () {
    $dateTime = '2026-04-07 08:00:00';

    $response = $this->actingAs($this->user, 'sanctum')
        ->postJson('/api/appointment', [
            'service_id' => $this->service->id,
            'date_time' => $dateTime,
        ]);

    $response->assertStatus(201);
});

test('it cannot create an appointment at 7 pm', function () {
    $dateTime = '2026-04-07 19:00:00';

    $response = $this->actingAs($this->user, 'sanctum')
        ->postJson('/api/appointment', [
            'service_id' => $this->service->id,
            'date_time' => $dateTime,
        ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['date_time']);
});

test('it can create an appointment at 6 pm', function () {
    $dateTime = '2026-04-07 18:00:00';

    $response = $this->actingAs($this->user, 'sanctum')
        ->postJson('/api/appointment', [
            'service_id' => $this->service->id,
            'date_time' => $dateTime,
        ]);

    $response->assertStatus(201);
});
