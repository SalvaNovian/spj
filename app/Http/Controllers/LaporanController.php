<?php

namespace App\Http\Controllers;

use App\Models\Spj;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\SpjExport;
use Maatwebsite\Excel\Facades\Excel;   

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $spjs = Spj::with(['user','kegiatan'])

            ->when($search,function($query) use($search){

                $query->where('nomor_spj','like',"%{$search}%")
                    ->orWhere('status','like',"%{$search}%")
                    ->orWhereHas('user',function($q) use($search){

                            $q->where('nama','like',"%{$search}%");

                    })
                    ->orWhereHas('kegiatan',function($q) use($search){

                            $q->where('nama','like',"%{$search}%");

                    });

            })

            ->latest()

            ->paginate(10);

        return view('laporan.index',[
            'spjs'=>$spjs,
            'search'=>$search,
        ]);
    }

    public function pdf(Request $request)
    {
        $query = Spj::with(['user','kegiatan']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('kegiatan')) {
            $query->where('kegiatan_id', $request->kegiatan);
        }

        if ($request->filled('awal') && $request->filled('akhir')) {
            $query->whereBetween('tanggal', [
                $request->awal,
                $request->akhir
            ]);
        }

        $laporan = $query->latest()->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('laporan'));

        return $pdf->stream('laporan-spj.pdf');
    }

    public function exportExcel()
    {
        $filename = 'laporan-spj-'.date('Y-m-d').'.xlsx';

        return Excel::download(
            new SpjExport,
            $filename
        );
    }
}