<?php

namespace App\Http\Controllers;

use App\DataTables\WorksPlaceDataTable;
use App\DataTables\WorksPlaceShowDataTable;
use App\Models\User;
use App\Models\Work_place;
use Illuminate\Http\Request;

class WorkPlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(WorksPlaceDataTable $dataTable)
    {
        // return view('admin.WorkPlace', ['workPlaces' => Work_place::all()]);
        return $dataTable->render('admin.WorkPlace');
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'tempat_tugas' => 'required'
        ];


        $messages = [
            'tempat_tugas.required' => 'Tempat Tugas wajib diisi.',
        ];

        $validateData = $request->validate($rules, $messages);

        $workPlace = Work_place::create([
            'work_place' => $validateData['tempat_tugas'],

        ]);

        if ($workPlace) {
            return redirect()->route('workPlace.index')->with('success', 'Data Tempat Tugas berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Data Tempat Tugas gagal ditambahkan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Work_place $work_place,WorksPlaceShowDataTable $dataTable)
    {
        // $users = User::where('work_place_id', $work_place->id)->get();
        // return view('admin.WorkPlaceShow', ['users' => $users]);
        return $dataTable->with('id',$work_place->id)->render('admin.WorkPlaceShow');
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work_place $work_place)
    {
        $rules = [
            'tempat_tugas' => 'required'
        ];


        $messages = [
            'tempat_tugas.required' => 'Tempat Tugas wajib diisi.',
        ];

        $validateData = $request->validate($rules, $messages);

        $work_place->work_place = $validateData['tempat_tugas'];
        $work_place->save();

        if ($work_place->save()) {
            return redirect()->route('workPlace.index')->with('success', 'Data Tempat Tugas berhasil di edit!');
        } else {
            return redirect()->back()->with('error', 'Data Tempat Tugas gagal di edit!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work_place $work_place)
    {
        Work_place::destroy($work_place->id);
        $work_place->delete();
        return redirect()->route('workPlace.index')->with('success', 'Berhasil Menghapus data Dokumen Tempat Tugas');
    }
}
