<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kegiatan;
use App\Models\Spj;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;

        if ($role == 'admin') {

            $grafik = Spj::select(
                DB::raw('MONTH(tanggal) as bulan'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('tanggal', date('Y'))
            ->groupBy(DB::raw('MONTH(tanggal)'))
            ->pluck('total','bulan');

            return view('dashboard.admin', [

                'totalUser'      => User::count(),
                'totalKegiatan'  => Kegiatan::count(),
                'totalSpj'       => Spj::count(),
                'menunggu'       => Spj::where('status','menunggu')->count(),
                'revisi'         => Spj::where('status','revisi')->count(),
                'diterima'       => Spj::where('status','diterima')->count(),
                'final'          => Spj::where('status','final')->count(),

                'spjTerbaru' => Spj::with(['user','kegiatan'])
                                    ->latest()
                                    ->take(5)
                                    ->get(),
                
               'grafik' => $grafik,

            ]);

        }

        if ($role == 'user') {

            return view('dashboard.user',[

                'totalSpj' => Spj::where('user_id',Auth::id())->count(),

                'menunggu' => Spj::where('user_id',Auth::id())
                                ->where('status','menunggu')
                                ->count(),

                'revisi' => Spj::where('user_id',Auth::id())
                                ->where('status','revisi')
                                ->count(),

                'final' => Spj::where('user_id',Auth::id())
                                ->where('status','final')
                                ->count(),

                'spjTerbaru' => Spj::where('user_id',Auth::id())
                                ->latest()
                                ->take(5)
                                ->get(),

            ]);

        }

        return view('dashboard.pimpinan',[

            'menunggu' => Spj::where('status','diterima')->count(),

            'final' => Spj::where('status','final')->count(),

            'ditolak' => Spj::where('status','ditolak')->count(),

            'spjTerbaru' => Spj::whereIn('status',['diterima','final'])
                                ->latest()
                                ->take(5)
                                ->get(),

        ]);
    }
}