<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $kegiatan = Kegiatan::when($search,function($query) use($search){

            $query->where('kode','like',"%{$search}%")
                ->orWhere('nama','like',"%{$search}%")
                ->orWhere('lokasi','like',"%{$search}%");

        })
        ->latest()
        ->paginate(10);

        return view('kegiatan.index',compact(
            'kegiatan',
            'search'
        ));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kegiatans',
            'nama' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
        ]);

        Kegiatan::create([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Data kegiatan berhasil ditambahkan');
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $request->validate([
            'kode' => 'required|unique:kegiatans,kode,' . $kegiatan->id,
            'nama' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
        ]);

        $kegiatan->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Data kegiatan berhasil diubah');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Data kegiatan berhasil dihapus');
    }
}