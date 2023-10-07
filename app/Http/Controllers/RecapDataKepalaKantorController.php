<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lckh_reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RecapDataKepalaKantorController extends Controller
{
    public function index()
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
        // dd($users);
        return view('kepala-kantor.RekapData', ['users' => $users, 'data' => $data]);
    }
}
