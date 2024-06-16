<?php

namespace App\Http\Controllers;

use App\Models\Document_types;
use App\Models\User;
use App\Models\Work_place;
use Illuminate\Http\Request;

class DataSelect2Controller extends Controller
{
    public function dataUser(Request $request){
        $data = User::where('name','LIKE','%'. $request->input('q') .'%')->paginate(10);
        foreach ($data as $nip) {
            $nip->nip = "$nip->nip";
        }
        // dd($data);
        return response()->json($data);
    }
    public function dataWorkPlace(Request $request){
        $data = Work_place::where('work_place','LIKE','%'. $request->input('q') .'%')->paginate(10);
        return response()->json($data);
    }
    public function dataDocumentType(Request $request){
        $data = Document_types::where('name','Like','%'. $request->input('q') .'%')->paginate(10);
        return response()->json($data);
    }
}
