<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Helpers\Activity;

class PimpinanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $spjs = Spj::with(['kegiatan','user'])

            ->where('status','diterima')

            ->when($search,function($query) use($search){

                $query->where('nomor_spj','like',"%{$search}%")
                    ->orWhereHas('kegiatan',function($q) use($search){

                            $q->where('nama','like',"%{$search}%");

                    })
                    ->orWhereHas('user',function($q) use($search){

                            $q->where('nama','like',"%{$search}%");

                    });

            })

            ->latest()

            ->paginate(10);

        return view('pimpinan.index',compact(
            'spjs',
            'search'
        ));
    }

    public function show(Spj $spj)
    {
        return view('pimpinan.show', compact('spj'));
    }

    public function update(Request $request, Spj $spj)
    {
        $request->validate([
            'status'   => 'required|in:final,ditolak',
            'catatan'  => 'nullable|string',
        ]);

        if ($request->status == 'ditolak' && empty($request->catatan)) {

            return back()
                ->withInput()
                ->withErrors([
                    'catatan' => 'Alasan penolakan wajib diisi.'
                ]);

        }

        $spj->update([

            'status'   => $request->status,

            'catatan'  => $request->catatan,

        ]);

        $pesan = '';

        switch ($request->status) {

            case 'final':
                $pesan = 'SPJ '.$spj->nomor_spj.' telah disetujui Pimpinan.';
                break;

            case 'ditolak':
                $pesan = 'SPJ '.$spj->nomor_spj.' ditolak oleh Pimpinan.';
                break;

            default:
                $pesan = 'Status SPJ '.$spj->nomor_spj.' berubah.';
        }

        Notification::create([

            'user_id' => $spj->user_id,

            'title' => 'Persetujuan Pimpinan',

            'message' => $pesan,

        ]);

        Activity::add(
        'Persetujuan Pimpinan SPJ '.$spj->nomor_spj.' menjadi '.$request->status
    );

        return redirect()
                ->route('pimpinan.index')
                ->with('success','Persetujuan berhasil disimpan.');
    }
}