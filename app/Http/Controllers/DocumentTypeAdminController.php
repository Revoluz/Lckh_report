<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Documents;
use App\Models\Work_place;
use Illuminate\Http\Request;
use App\Models\Document_types;
use Illuminate\Routing\Controller;
use League\CommonMark\Node\Block\Document;

class DocumentTypeAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.DocumentType', ['documentTypes' => Document_types::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'tipe_dokumen' => 'required'
        ];


        $messages = [
            'tipe_dokumen.required' => 'Tipe Dokumen wajib diisi.',
        ];

        $validateData = $request->validate($rules, $messages);

        $tipeDokumen = Document_types::create([
            'name' => $validateData['tipe_dokumen'],

        ]);

        if ($tipeDokumen) {
            return redirect()->route('document-type.index')->with('success', 'Data Tipe Dokumen berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Data Tipe Dokumen gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Document_types $document_type)
    {
        // dd($document_type);
        $documents = Documents::where('document_type_id', $document_type->id)->get();

        return view('admin.ListUploadDocument', [
            'users' => User::all(),
            'work_places' => Work_place::all(),
            'document_types' => Document_types::all(),
            'documents' => $documents,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document_types $document_type)
    {
        $rules = [
            'tipe_dokumen' => 'required'
        ];


        $messages = [
            'tipe_dokumen.required' => 'Tipe Dokumen wajib diisi.',
        ];

        $validateData = $request->validate($rules, $messages);

        $document_type->name = $validateData['tipe_dokumen'];
        $document_type->save();

        if ($document_type->save()) {
            return redirect()->route('document-type.index')->with('success', 'Data Tipe Dokumen berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Data Tipe Dokumen gagal ditambahkan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document_types $document_type)
    {
        Documents::destroy($document_type->id);
        $document_type->delete();
        return redirect()->route('document-type.index')->with('success', 'Berhasil Menghapus data Tipe Dokumen');
    }
}
