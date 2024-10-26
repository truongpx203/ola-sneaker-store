<?php

namespace App\Http\Controllers\admin;


use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {

        // Lấy số liệu thống kê đơn hàng
        $choXacNhan         = Bill::where('bill_status', 'pending')->count();
        $daXacNhan          = Bill::where('bill_status', 'confirmed')->count();
        $dangGiao           = Bill::where('bill_status', 'in_delivery')->count();
        $giaoThanhCong      = Bill::where('bill_status', 'delivered')->count();
        $giaoThatBai        = Bill::where('bill_status', 'failed')->count();
        $daHuy              = Bill::where('bill_status', 'canceled')->count();
        $hoanThanh          = Bill::where('bill_status', 'completed')->count();

        // Lấy top 5 sản phẩm bán chạy nhất
        $topBanChayNhat = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id') // Join với bảng bills
            ->select('bill_items.variant_id', 'bill_items.product_name', 'bill_items.product_image_url', 'bill_items.sale_price', 'bill_items.listed_price', 'bill_items.import_price', DB::raw('COUNT(bill_items.variant_id) as appearances'))
            ->where('bills.bill_status', 'completed') // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
            ->groupBy('bill_items.variant_id', 'bill_items.product_name', 'bill_items.product_image_url', 'bill_items.sale_price', 'bill_items.listed_price', 'bill_items.import_price')
            ->orderBy('appearances', 'desc')
            ->take(5)
            ->get();

        // Lấy top 5 sản phẩm có doanh thu cao nhất
        $topDoanhThuCaoNhat = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id') // Join với bảng bills
            ->select(
                'bill_items.variant_id',
                'bill_items.product_name',
                'bill_items.product_image_url',
                DB::raw('SUM(bill_items.variant_quantity * bill_items.sale_price) as total_revenue') // Tính tổng doanh thu
            )
            ->where('bills.bill_status', 'completed') // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
            ->groupBy(
                'bill_items.variant_id',
                'bill_items.product_name',
                'bill_items.product_image_url',
            )
            ->orderBy('total_revenue', 'desc') // Sắp xếp theo tổng doanh thu giảm dần
            ->take(5)
            ->get();


        // Lấy top 5 sản phẩm có lợi nhuận cao nhất
        $topLoiNhuanCaoNhat = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id') // Join với bảng bills
            ->select(
                'bill_items.variant_id',
                'bill_items.product_name',
                'bill_items.product_image_url',
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Tính tổng lợi nhuận
            )
            ->where('bills.bill_status', 'completed') // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
            ->groupBy(
                'bill_items.variant_id',
                'bill_items.product_name',
                'bill_items.product_image_url'
            )
            ->orderBy('total_profit', 'desc') // Sắp xếp theo tổng lợi nhuận giảm dần
            ->take(5) // Lấy top 5 sản phẩm có lợi nhuận cao nhất
            ->get();


        return view('admin.dashboardThongke', compact(
            'choXacNhan',
            'daXacNhan',
            'dangGiao',
            'giaoThanhCong',
            'giaoThatBai',
            'daHuy',
            'hoanThanh',
            'topBanChayNhat',
            'topDoanhThuCaoNhat',
            'topLoiNhuanCaoNhat'
        ));

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

    public function getStatistics(Request $request)
    {
        $date = $request->input('date') ?? Carbon::today()->toDateString();

        // Truy vấn số lượng sản phẩm đã mua và doanh thu trong ngày, nhóm theo giờ
        $data = DB::table('bills')
            ->select(
                DB::raw('HOUR(created_at) as hour'), 
                DB::raw('COUNT(*) as count'), 
                DB::raw('SUM(total_price) as revenue')
            )
            ->whereDate('created_at', $date)
            ->groupBy('hour')
            ->get();

        // Tạo mảng 24 phần tử cho số lượng sản phẩm và doanh thu
        $hourlyData = [
            'counts' => array_fill(0, 24, 0),
            'revenues' => array_fill(0, 24, 0.0)
        ];

        foreach ($data as $item) {
            $hourlyData['counts'][$item->hour] = $item->count;
            $hourlyData['revenues'][$item->hour] = $item->revenue;
        }

        return response()->json($hourlyData);

    }
}
