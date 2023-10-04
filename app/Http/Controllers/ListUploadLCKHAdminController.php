<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Work_place;
use App\Models\Lckh_reports;
use Illuminate\Http\Request;

class ListUploadLCKHAdminController extends Controller
{
    public function index()
    {
        $lckh = Lckh_reports::all();
        foreach ($lckh as $data) {
            $nama_bulan = ucfirst(Carbon::parse($data->monthly_report)->locale('id')->isoFormat('MMMM YYYY'));
            $data->nama_bulan = $nama_bulan;
            $tanggal_upload = ucfirst(Carbon::parse($data->upload_date)->locale('id')->isoFormat('MMMM YYYY'));
            $data->tanggal_upload = $tanggal_upload;
        }
        return view('admin.ListUploadLCKH', [
            'users' => User::all(),
            'work_places' => Work_place::all(),
            'lckh_reports' => $lckh,
        ]);
    }
    public function show(Lckh_reports $lckh)
    {
        $nama_bulan = ucfirst(Carbon::parse($lckh->monthly_report)->locale('id')->isoFormat('YYYY MMMM'));
        return view('admin.LCKHShow', [
            'lckh' => $lckh,
            'nama_bulan' => $nama_bulan,
        ]);
    }
    public function filter(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $tempat_tugas = $request->input('tempat_tugas');
        $nama = $request->input('nama');

        $users = User::where('work_place_id', $tempat_tugas)->get();

        $user_ids = [];
        foreach ($users as $user) {
            $user_ids[] = $user->id;
        }

        $query = Lckh_reports::query();
        if ($tahun) {
            $query->whereYear('monthly_report', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('monthly_report', $bulan);
        }

        if ($tempat_tugas) {
            $query->whereIn('user_id', $user_ids);
        }

        if ($nama) {
            $query->where('user_id', $nama);
        }

        $lckh_reports = $query->get();
        foreach ($lckh_reports as $data) {
            $data->nama_bulan  = ucfirst(Carbon::parse($data->monthly_report)->locale('id')->isoFormat('MMMM YYYY'));
            // $data->nama_bulan = $nama_bulan;
        }
        return view('admin.ListUploadLCKH', [
            'users' => User::all(),
            'work_places' => Work_place::all(),
            'lckh_reports' => $lckh_reports,
        ]);
    }
}
