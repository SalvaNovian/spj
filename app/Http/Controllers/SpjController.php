<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Activity;

class SpjController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $query = Spj::with(['kegiatan','user']);

        if(auth()->user()->role != 'admin'){

            $query->where('user_id', auth()->id());

        }

        if($search){

            $query->where(function($q) use ($search){

                $q->where('nomor_spj','like',"%{$search}%")
                ->orWhereHas('kegiatan',function($k) use($search){

                        $k->where('nama','like',"%{$search}%");

                })
                ->orWhereHas('user',function($u) use($search){

                        $u->where('nama','like',"%{$search}%");

                });

            });

        }

        $spjs = $query
                    ->latest()
                    ->paginate(10);

        return view('spj.index',compact(
            'spjs',
            'search'
        ));
    }

    public function create()
    {
        $kegiatan = Kegiatan::doesntHave('spjs')
            ->orderBy('nama')
            ->get();

        return view('spj.create', compact('kegiatan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_spj'   => 'required|unique:spjs',
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'tanggal'     => 'required|date',
            'file'        => 'required|mimes:pdf|max:10240',
        ]);

        $namaFile = time() . '_' . Str::slug(
            pathinfo($request->file('file')->getClientOriginalName(), PATHINFO_FILENAME)
        ) . '.pdf';

        $request->file('file')->storeAs(
            'spj',
            $namaFile,
            'public'
        );

        Spj::create([
            'nomor_spj'   => $request->nomor_spj,
            'kegiatan_id' => $request->kegiatan_id,
            'user_id'     => Auth::id(),
            'tanggal'     => $request->tanggal,
            'file'        => $namaFile,
            'status'      => 'menunggu',
            'catatan'     => null,
            'revisi_ke'   => 0,
        ]);

        Activity::add(
        'Upload SPJ '.$request->nomor_spj
    );

        return redirect()
            ->route('spj.index')
            ->with('success', 'SPJ berhasil diupload.');
    }

    public function edit(Spj $spj)
    {
        return view('spj.edit', compact('spj'));
    }

    public function update(Request $request, Spj $spj)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:10240',
        ]);

        if ($spj->revisi_ke >= 2) {

    return redirect()
        ->route('spj.index')
        ->with('error', 'Batas upload revisi sudah mencapai maksimal 2 kali.');

}

        // hapus file lama
        if ($spj->file && Storage::disk('public')->exists('spj/'.$spj->file)) {

            Storage::disk('public')->delete('spj/'.$spj->file);

        }

        // nama file baru
        $namaFile = time().'_'.
            Str::slug(
                pathinfo(
                    $request->file('file')->getClientOriginalName(),
                    PATHINFO_FILENAME
                )
            ).'.pdf';

        $request->file('file')->storeAs(
            'spj',
            $namaFile,
            'public'
        );

        $spj->update([

            'file' => $namaFile,

            'status' => 'menunggu',

            'catatan' => null,

            'revisi_ke' => $spj->revisi_ke + 1,

        ]);

        return redirect()
            ->route('spj.index')
            ->with('success','Revisi SPJ berhasil diupload.');
    }

    public function destroy(Spj $spj)
    {
        if ($spj->file &&
            Storage::disk('public')->exists('spj/'.$spj->file)) {

            Storage::disk('public')->delete('spj/'.$spj->file);

        }

        $spj->delete();

        return redirect()
            ->route('spj.index')
            ->with('success','SPJ berhasil dihapus.');
    }
}