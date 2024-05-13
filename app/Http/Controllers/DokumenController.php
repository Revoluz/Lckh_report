<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Documents;
use App\Models\Work_place;
use Illuminate\Http\Request;
use App\Models\Document_types;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Documents::all();
        foreach ($documents as $data) {
            $tanggal_upload = ucfirst(Carbon::parse($data->document_date)->locale('id')->isoFormat('MMMM YYYY'));
            $data->tanggal_upload = $tanggal_upload;
            // $data->created_at = preg_replace("/00:00:00/", '',  $data->created_at->toDateString());
        }
        // dd($documents);
        return view('admin.ListUploadDocument', [
            'users' => User::all(),
            'work_places' => Work_place::all(),
            'document_types' => Document_types::all(),
            'documents' => $documents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.DocumentCreate', [
            'users' => User::all(),
            'document_types' => Document_types::all(),
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
            'nama_dokumen' => 'required',
            'tipe_dokumen' => 'required',
            'deskripsi' => 'nullable',
            'dokumen_bulan' => 'required|date_format:Y-m',
            'upload_dokumen' => 'required|file|mimes:pdf|max:2048',
        ];

        $messages = [
            'upload_dokumen.max' => 'Ukuran file maksimal 20MB',
        ];

        $validateData = $request->validate($rules, $messages);

        // Simpan data dokumen
        $date = Carbon::parse($request->dokumen_bulan)->format('Y-m-d');
        $file = $request->file('upload_dokumen');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/documents/', $filename);
        $document = Documents::create([
            'user_id' => $validateData['nama'],
            'document_type_id' =>  $validateData['tipe_dokumen'],
            'name' => $validateData['nama_dokumen'],
            'document_date' => $date,
            'filename' => $filename,
            'description' =>  $validateData['deskripsi'],
        ]);
        // Jika data dokumen berhasil disimpan, tampilkan pesan berhasil
        if ($document) {
            return redirect()->route('document.index')->with('success', 'Dokumen berhasil ditambahkan!');
        } else {
            // Jika data dokumen gagal disimpan, tampilkan pesan gagal
            return redirect()->back()->with('error', 'Dokumen gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Documents $document)
    {
        // dd($document);
        $nama_bulan = ucfirst(Carbon::parse($document->document_date)->locale('id')->isoFormat('YYYY MMMM'));

        $file = Storage::url('documents/' . $document->filename);

        return view('admin.DocumentShow', [
            'document' => $document,
            'nama_bulan' => $nama_bulan,
            'file' => $file,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Documents $document)
    {

        $nama_bulan = Carbon::parse($document->document_date)->format('Y-m');

        return view('admin.DocumentEdit', [
            'document' => $document,
            "nama_bulan" => $nama_bulan,
            'users' => User::all(),
            'document_types' => Document_types::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Documents $document)
    {
        $rules = [
            'nama' => 'required',
            'nama_dokumen' => 'required',
            'tipe_dokumen' => 'required',
            'deskripsi' => 'nullable',
            'dokumen_bulan' => 'required|date_format:Y-m',
            'upload_dokumen' => 'nullable|file|mimes:pdf|max:20480',

        ];
        $validateData = $request->validate($rules);
        if ($request->file('upload_dokumen')) {
            if ($document->filename) {
                Storage::delete('public/documents/' . $document->filename);
            }
            // Simpan data dokumen
            $file = $request->file('upload_dokumen');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/documents/', $filename);
            $document->filename = $filename;
        }
        $date = Carbon::parse($request->dokumen_bulan)->format('Y-m-d');
        $document->user_id = $validateData['nama'];
        $document->name = $validateData['nama_dokumen'];
        $document->document_type_id = $validateData['tipe_dokumen'];
        $document->document_date = $date;
        $document->description = $validateData['deskripsi'];
        $document->save();
        if ($document->save()) {
            return redirect()->route('document.index')->with('success', 'Dokumen berhasil ditambahkan!');
        } else {
            // Jika data dokumen gagal disimpan, tampilkan pesan gagal
            return redirect()->back()->with('error', 'Dokumen gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Documents $document)
    {
        if (Storage::exists('public/documents/' . $document->filename)) {
            Storage::delete('public/documents/' . $document->filename);
        }
        Documents::destroy($document->id);
        $document->delete();
        return redirect()->route('document.index')->with('success', 'Berhasil Menghapus data Dokumen');
    }
    public function filterDocument(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulan = $request->input('bulan');
        $tempat_tugas = $request->input('tempat_tugas');
        $nama = $request->input('nama');
        $tipe_dokumen = $request->input('tipe_dokumen');

        $users = User::where('work_place_id', $tempat_tugas)->get();

        $user_ids = [];
        foreach ($users as $user) {
            $user_ids[] = $user->id;
        }

        $query = Documents::query();
        if ($tahun) {
            $query->whereYear('document_date', $tahun);
        }

        if ($bulan) {
            $query->whereMonth('document_date', $bulan);
        }

        if ($tempat_tugas) {
            $query->whereIn('user_id', $user_ids);
        }

        if ($nama) {
            $query->where('user_id', $nama);
        }
        if ($tipe_dokumen) {
            $query->where('document_type_id', $tipe_dokumen);
        }
        $documents = $query->get();
        foreach ($documents as $data) {
            $data->tanggal_upload  = ucfirst(Carbon::parse($data->document_date)->locale('id')->isoFormat('MMMM YYYY'));
            // $data->nama_bulan = $nama_bulan;
        }
        return view('admin.ListUploadDocument', [
            'users' => User::all(),
            'work_places' => Work_place::all(),
            'document_types' => Document_types::all(),
            'documents' => $documents,
        ]);
    }
    public function downloadDocument(Documents $document)
    {
        // $file = Documents::where('id', '=', $document->id)->get();
        $file = Storage::path('/public/documents/' . $document->filename);

        return response()->download($file);
        // return response()->file($file);
        // return redirect()->route('document.index')->with('success', 'Dokumen berhasil didownload!');
    }
}
