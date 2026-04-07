<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }
        return Inertia::render('Login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials do not match our records.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function index()
    {
        return Inertia::render('Dashboard', [
            'services' => Service::all(),
            'appointments' => Appointment::orderBy('date_time', 'desc')->get(),
        ]);
    }

    public function storeAppointment(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'date_time' => 'required|date|after:now',
        ]);

        $validated['client_name'] = Auth::user()->name;

        Appointment::create($validated);

        return redirect()->back()->with('message', 'Appointment created successfully!');
    }
}
