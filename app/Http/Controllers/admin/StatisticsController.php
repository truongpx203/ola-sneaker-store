<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    //

    public function index()
    {
        return view('admin.dashboard');
    }

    public function getStatistics(Request $request)
    {
        $date = $request->input('date') ?? Carbon::today()->toDateString();

        // Query để lấy dữ liệu được nhóm theo giờ
        $data = DB::table('bills')
            ->select(DB::raw('HOUR(created_at) as hour'), DB::raw('COUNT(*) as count'))
            ->whereDate('created_at', $date)
            ->groupBy('hour')
            ->pluck('count', 'hour');

        // Tạo một mảng có 24 phần tử cho mỗi giờ trong ngày
        $hourlyData = array_fill(0, 24, 0);

        foreach ($data as $hour => $count) {
            $hourlyData[$hour] = $count;
        }

        return response()->json($hourlyData);
    }
}

