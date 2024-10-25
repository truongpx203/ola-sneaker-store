<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $year = $request->yearDasboard ?? now()->format('Y');
        $monthlyRevenue = Bill::query()
            ->with('histories')
            ->whereHas('histories', function ($query) use ($year) {
                $query->where('to_status', '=', 'completed')
                    ->whereYear('at_datetime', '=', $year);
            })
            ->join('bill_histories', 'bills.id', '=', 'bill_histories.bill_id')
            ->whereYear('bill_histories.at_datetime', '=', $year)
            ->select(DB::raw('SUM(total_price) as total_revenue, MONTH(bill_histories.at_datetime) as month'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $months = collect(range(1, 12));
        $revenueByMonth = $months->map(function ($month) use ($monthlyRevenue) {
            $revenue = $monthlyRevenue->firstWhere('month', $month);
            return [
                'month' => $month,
                'total_revenue' => $revenue ? $revenue->total_revenue : 0,
            ];
        });
        $doanhthu = 0;
        foreach ($revenueByMonth as $items) {
            $doanhthu += $items['total_revenue'];
        }
        return view('admin.dashboard', compact('revenueByMonth', 'doanhthu'));
    }
}
