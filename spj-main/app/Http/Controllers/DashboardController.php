<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $role = auth()->user()->role;

        if ($role == 'admin') {
            return view('dashboard.admin');
        }

        if ($role == 'user') {
            return view('dashboard.user');
        }

        if ($role == 'pimpinan') {
            return view('dashboard.pimpinan');
        }

        abort(403);
    }
}