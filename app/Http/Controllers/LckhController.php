<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lckh_reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;

class LckhController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lckh = Lckh_reports::where('user_id', Auth::id())->get();
        foreach ($lckh as $data) {
            $nama_bulan = ucfirst(Carbon::parse($data->monthly_report)->locale('id')->isoFormat('MMMM YYYY'));
            $data->nama_bulan = $nama_bulan;
            $tanggal_upload = ucfirst(Carbon::parse($data->upload_date)->locale('id')->isoFormat('MMMM YYYY'));
            $data->tanggal_upload = $tanggal_upload;
        }

        return view('admin.LCKHList', [
            'lckh' => $lckh,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.LCKHCreate', [
            'users' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lakukan validasi data input
        $rules = [
            'nama' => 'required',
            'laporan_bulan' => 'required|date_format:Y-m',
            'upload_document' => 'required|url',
        ];

        $messages = [
            'nama.required' => 'Nama wajib diisi.',
            'laporan_bulan.required' => 'Laporan Bulan laporan wajib diisi.',
            'laporan_bulan.date_format' => 'Format Laporan Bulan tidak valid.',
            'upload_document.required' => 'Dokumen wajib diupload.',
            'upload_document.url' => 'Dokumen harus berupa link URL Google Drive.',
        ];

        $validateData = $request->validate($rules, $messages);

        // Jika validasi berhasil, simpan data ke database
        $date = Carbon::parse($validateData['laporan_bulan'])->format('Y-m-d');
        $lckh = Lckh_reports::create([
            'user_id' => $validateData['nama'],
            // 'user_id' => Auth::id(),
            'upload_document' => $validateData['upload_document'],
            'monthly_report' => $date,
            'upload_date' => Carbon::now()->format('Y-m-d'),
        ]);

        if ($lckh) {
            return redirect()->route('lckh.index')->with('success', 'Data Dokumen LCKH berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Data Dokumen LCKH ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Lckh_reports $lckh)
    {
        $nama_bulan = ucfirst(Carbon::parse($lckh->monthly_report)->locale('id')->isoFormat('YYYY MMMM'));
        return view('admin.LCKHShow', [
            'lckh' => $lckh,
            'nama_bulan' => $nama_bulan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lckh_reports $lckh)
    {
        $lckh = $lckh::where('user_id', Auth::id())->where('id', $lckh->id)->get();
        // dd($lckh);
        if (count($lckh) === 0) {
            abort(404);
        }
        $month = $lckh[0]->monthly_report;

        // Ubah string menjadi objek Carbon
        $month = Carbon::parse($month);

        // Ubah format tanggal
        $month = $month->format('Y-m');

        return view('admin.LCKHEdit', [
            'users' => User::all(),
            'lckh' => $lckh[0],
            'monthly_report' => $month,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lckh_reports $lckh)
    {
        $rules = [
            'laporan_bulan' => 'required|date_format:Y-m',
            'upload_document' => 'required|url',
        ];

        $messages = [
            'laporan_bulan.required' => 'Laporan Bulan laporan wajib diisi.',
            'laporan_bulan.date_format' => 'Format Laporan Bulan tidak valid.',
            'upload_document.required' => 'Dokumen wajib diupload.',
            'upload_document.url' => 'Dokumen harus berupa link URL Google Drive.',
        ];
        $validateData = $request->validate($rules, $messages);
        // Jika validasi berhasil, simpan data ke database
        $date = Carbon::parse($validateData['laporan_bulan'])->format('Y-m-d');
        // $user->save();
        $lckh->user_id = Auth::id();
        $lckh->upload_document = $validateData['upload_document'];
        $lckh->monthly_report = $date;
        $lckh->save();

        if ($lckh->save()) {
            return redirect()->route('lckh.index')->with('success', 'Dokumen LCKH berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Dokumen LCKH gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lckh_reports $lckh)
    {
        Lckh_reports::destroy($lckh->id);
        $lckh->delete();
        return redirect()->route('lckh.index')->with('success', 'Berhasil Menghapus Dokumen LCKH');
    }
}
