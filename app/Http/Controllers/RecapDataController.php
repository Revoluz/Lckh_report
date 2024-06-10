<?php

namespace App\Http\Controllers;

use App\DataTables\RecapDataLCKHDataTable;
use App\DataTables\RecapDataUserDataTable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Lckh_reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecapDataController extends Controller
{
    public function index(RecapDataLCKHDataTable $lckhDatatable,RecapDataUserDataTable $userDataTable)
    {
        $auth = auth()->user();

        $users = User::groupBy('work_place_id')
            ->join('work_places', 'users.work_place_id', '=', 'work_places.id')
            // ->where('work_place_id', $auth->work_place->id)
            ->select('work_place_id', 'work_places.work_place', DB::raw('count(*) as count'))
            ->get();
        $data = Lckh_reports::whereNotNull('monthly_report')
            // ->join('users', 'users.id', '=', 'lckh_reports.user_id')
            // ->where('work_place_id', $auth->work_place->id)
            ->select(DB::raw('date(monthly_report) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->get();

        foreach ($data as $report) {
            $report->date = ucfirst(Carbon::parse($report->date)->locale('id')->isoFormat('MMMM YYYY'));
        }
        // // dd($users);
        // return view('admin.RekapData', ['userDataTable' => $userDataTable->html(), 'lckhDatatable' => $lckhDatatable->html()]);
        // $dataTableLckh = $LckhDatatable->html();
        // dd($userDataTable);
        // return $userDataTable->render('admin.RekapData',compact('dataTableLckh'));
        return view('admin.RekapData', ['users' => $users, 'data' => $data]);
    }
    // public function getRecapUser(RecapDataUserDataTable $userDataTable){
    //     return $userDataTable->render('admin.RekapData');
    // }
    // public function getRecapLCKH(RecapDataLCKHDataTable $LckhDatatable)
    // {
    //     return $LckhDatatable->render('admin.RekapData');
    // }
}
