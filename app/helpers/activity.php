<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Activity
{
    public static function add($aktivitas)
    {
        if (!Auth::check()) {
            return;
        }

        ActivityLog::create([

            'user_id' => Auth::id(),

            'nama' => Auth::user()->nama,

            'role' => Auth::user()->role,

            'aktivitas' => $aktivitas,

            'ip_address' => request()->ip(),

        ]);
    }
}