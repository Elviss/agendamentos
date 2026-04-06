<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreAppointmentRequest;
use App\Models\Appointment;

class AppointmentsController extends Controller
{
    public function index()
    {
        $services = Appointment::all();
        return response()->json([
            'data' => $services,
        ]);
    }

    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        return response()->json([
            'data' => $appointment,
        ], 201);
    }
}
