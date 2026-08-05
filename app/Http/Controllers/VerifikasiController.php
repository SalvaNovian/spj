<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use Illuminate\Http\Request;
use App\Models\Notification;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $spjs = Spj::with(['kegiatan','user'])

            ->when($search, function ($query) use ($search) {

                $query->where('nomor_spj', 'like', "%{$search}%")
                    ->orWhereHas('kegiatan', function ($q) use ($search) {

                            $q->where('nama', 'like', "%{$search}%");

                    })
                    ->orWhereHas('user', function ($q) use ($search) {

                            $q->where('nama', 'like', "%{$search}%");

                    });

            })

            ->latest()

            ->paginate(10);

        return view('verifikasi.index', compact(
            'spjs',
            'search'
        ));
    }

    public function show(Spj $spj)
    {
        return view('verifikasi.show', compact('spj'));
    }

    public function update(Request $request, Spj $spj)
    {
        $request->validate([
            'status' => 'required',
            'catatan' => 'nullable',
        ]);

        $spj->update([
            'status' => $request->status,
            'catatan' => $request->catatan,
        ]);

        Notification::create([

            'user_id'=>$spj->user_id,

            'title'=>'Status SPJ',

            'message'=>'SPJ '.$spj->nomor_spj.' telah '.$request->status,

        ]);

        return redirect()
            ->route('verifikasi.index')
            ->with('success','Verifikasi berhasil disimpan.');
    }
}   