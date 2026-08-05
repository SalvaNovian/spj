<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'username',
        'password',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'status' => 'boolean',
        ];
    }

    public function spjs()
{
    return $this->hasMany(Spj::class);
}

public function customNotifications()
{
    return $this->hasMany(Notification::class)
        ->orderBy('created_at','desc');
}
}