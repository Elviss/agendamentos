<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
