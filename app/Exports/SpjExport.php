<?php

namespace App\Exports;

use App\Models\Spj;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SpjExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Spj::with(['kegiatan','user'])
            ->get()
            ->map(function ($spj) {

                return [

                    $spj->nomor_spj,
                    $spj->kegiatan->nama,
                    $spj->user->nama,
                    $spj->tanggal,
                    ucfirst($spj->status),

                ];

            });

    }

    public function headings(): array
    {
        return [

            'Nomor SPJ',
            'Kegiatan',
            'User',
            'Tanggal',
            'Status',

        ];
    }
}