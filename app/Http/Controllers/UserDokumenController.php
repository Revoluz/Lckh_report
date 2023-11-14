<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Documents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserDokumenController extends Controller
{
    function index()
    {
        $auth = auth()->user();
        if (!$auth) {
            abort(403);
        }

        $documents = Documents::where("user_id", $auth->id)->get();
        foreach ($documents as $data) {
            $tanggal_upload = ucfirst(Carbon::parse($data->document_date)->locale('id')->isoFormat('MMMM YYYY'));
            $data->tanggal_upload = $tanggal_upload;
            // $data->created_at = preg_replace("/00:00:00/", '',  $data->created_at->toDateString());
        }
        return view('user.ListUploadDocument', [
            'documents' => $documents,
        ]);
    }
    function show(Documents $document)
    {
        $auth = auth()->user();
        if ($document->user_id != $auth->id) {
            abort(404);
        }
        $nama_bulan = ucfirst(Carbon::parse($document->document_date)->locale('id')->isoFormat('YYYY MMMM'));

        $file = Storage::url('documents/' . $document->filename);

        return view('user.DocumentShow', [
            'document' => $document,
            'nama_bulan' => $nama_bulan,
            'file' => $file,

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
