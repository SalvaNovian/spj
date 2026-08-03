<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();

        return view('kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function edit(Kegiatan $kegiatan)
    {
        //
    }

    public function update()
    {
        //
    }

    public function destroy(Kegiatan $kegiatan)
    {
        //
    }
}