<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'tanggal',
        'lokasi',
        'keterangan',
    ];

    public function spjs()
{
    return $this->hasMany(Spj::class);
}
}