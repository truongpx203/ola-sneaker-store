<?php

namespace App\Http\Controllers\admin;


use App\Models\Bill;
use App\Models\BillItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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
            ->select('bill_items.product_name', 'bill_items.product_image_url', DB::raw('SUM(bill_items.variant_quantity) as total_revenue'), DB::raw('COUNT(bill_items.product_name) as appearances'))
            ->whereIn('bills.bill_status', ['delivered', 'completed']) // Lấy cả đơn hàng hoàn thành và thành công
            ->groupBy('bill_items.product_name', 'bill_items.product_image_url')
            ->orderBy('appearances', 'desc')
            ->take(5)
            ->get();

        // dd( $topBanChayNhat );
        // Lấy top 5 sản phẩm có doanh thu cao nhất
        $topDoanhThuCaoNhat = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id') // Join với bảng bills
            ->select(
                'bill_items.product_name',
                'bill_items.product_image_url',
                DB::raw('SUM(bill_items.variant_quantity * bill_items.sale_price) as total_revenue') // Tính tổng doanh thu
            )
            ->whereIn('bills.bill_status', ['delivered', 'completed']) // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
            ->groupBy(
                'bill_items.product_name',
                'bill_items.product_image_url'
            )
            ->orderBy('total_revenue', 'desc') // Sắp xếp theo tổng doanh thu giảm dần
            ->take(5)
            ->get();


        // Lấy top 5 sản phẩm có lợi nhuận cao nhất
        $topLoiNhuanCaoNhat = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id') // Join với bảng bills
            ->select(
                'bill_items.product_name',
                'bill_items.product_image_url',
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Tính tổng lợi nhuận
            )
            ->whereIn('bills.bill_status', ['delivered', 'completed'])  // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
            ->groupBy('bill_items.product_name', 'bill_items.product_image_url') // Nhóm theo sản phẩm
            ->orderBy('total_profit', 'desc') // Sắp xếp theo tổng lợi nhuận giảm dần
            ->take(5) // Lấy top 5 sản phẩm có lợi nhuận cao nhất
            ->get();
        // $month = request('month', date('m'));
        $monthYear = $request->query('month', date('m-Y'));
        [$month, $year] = explode('-', $monthYear);
        $thongKeNgayTheoThang = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(
                DB::raw('DAY(bills.created_at) as day'), // Lấy ngày
                DB::raw('SUM(bill_items.sale_price * bill_items.variant_quantity) as total_revenue'), // Tổng doanh thu
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Tổng lợi nhuận
            )
            ->whereIn('bills.bill_status', ['delivered', 'completed'])   // Chỉ tính cho hóa đơn đã hoàn thành
            ->whereMonth('bills.created_at', $month) // Lọc theo tháng
            ->groupBy(DB::raw('DAY(bills.created_at)')) // Nhóm theo ngày trong tháng
            ->get();

        $thongKeNgayTheoThangData = $thongKeNgayTheoThang->toArray();

        // dd( $thongKeNgayTheoThangData);

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
            'topLoiNhuanCaoNhat',
            'thongKeNgayTheoThangData',
            'topLoiNhuanCaoNhat'
        ));

        $year = $request->yearDasboard ?? now()->format('Y');
        $monthlyRevenue = Bill::query()
            ->with('histories')
            ->whereHas('histories', function ($query) use ($year) {
                $query->where('to_status', '=', 'delivered')
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
    $date = $request->input('date');

    // Truy vấn doanh thu theo giờ sử dụng bill_items
    $revenuePerHour = DB::table('bill_items')
        ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
        ->select(
            DB::raw('HOUR(bills.created_at) as hour'), 
            DB::raw('SUM(bill_items.variant_quantity * bill_items.sale_price) as total_revenue')
        )
        ->whereDate('bills.created_at', $date)
        ->whereIn('bills.bill_status', ['delivered', 'completed'])  // Chỉ lấy những đơn đã giao hoặc hoàn thành
        ->groupBy(DB::raw('HOUR(bills.created_at)'))
        ->orderBy('hour')
        ->get();

    // Truy vấn lợi nhuận theo giờ
    $profitPerHour = DB::table('bill_items')
        ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
        ->select(
            DB::raw('HOUR(bills.created_at) as hour'), 
            DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit')
        )
        ->whereDate('bills.created_at', $date)
        ->whereIn('bills.bill_status', ['delivered', 'completed'])  // Chỉ lấy những đơn đã giao hoặc hoàn thành
        ->groupBy(DB::raw('HOUR(bills.created_at)'))
        ->orderBy('hour')
        ->get();

    // Chuyển đổi dữ liệu về định dạng mảng
    $revenues = array_fill(0, 24, 0);
    $profits = array_fill(0, 24, 0);

    foreach ($revenuePerHour as $revenue) {
        $revenues[$revenue->hour] = $revenue->total_revenue;
    }

    foreach ($profitPerHour as $profit) {
        $profits[$profit->hour] = $profit->total_profit;
    }

    return response()->json([
        'revenues' => $revenues,
        'profits' => $profits,
    ]);
}
    public function getStatisticsByYear(Request $request)
    {
        $year = $request->input('year');

        // Lấy doanh thu và lợi nhuận theo tháng
        $statistics = BillItem::join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(
                DB::raw('MONTH(bills.created_at) as month'),
                DB::raw('SUM(bill_items.sale_price * bill_items.variant_quantity) as total_revenue'), // Doanh thu
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Lợi nhuận
            )
            ->whereYear('bills.created_at', $year)
            // ->where('bills.bill_status', 'completed') // Chỉ tính cho đơn hàng hoàn thành
            ->whereIn('bills.bill_status', ['delivered', 'completed'])  
            ->groupBy(DB::raw('MONTH(bills.created_at)'))
            ->orderBy(DB::raw('MONTH(bills.created_at)'))
            ->get();

        // Trả về kết quả dưới dạng JSON
        return response()->json($statistics);
    }
    public function statisticsMonth(Request $request)
    {
        $year = $request->input('year');
        $month = $request->input('month');
    
        // Lấy doanh thu và lợi nhuận cho tháng cụ thể trong năm
        $statistics = BillItem::join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(
                DB::raw('DAY(bills.created_at) as day'), // Lấy ngày trong tháng
                DB::raw('SUM(bill_items.variant_quantity * bill_items.sale_price) as total_revenue'), // Doanh thu
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Lợi nhuận
            )
            ->whereYear('bills.created_at', $year) // Lọc theo năm
            ->whereMonth('bills.created_at', $month) // Lọc theo tháng
            ->whereIn('bills.bill_status', ['delivered', 'completed']) // Chỉ tính cho đơn hàng đã giao hoặc hoàn thành
            ->groupBy(DB::raw('DAY(bills.created_at)')) // Nhóm theo ngày trong tháng
            ->orderBy(DB::raw('DAY(bills.created_at)')) // Sắp xếp theo ngày
            ->get();
    
        // Trả về kết quả dưới dạng JSON
        return response()->json($statistics);
            }
    public function getStatisticsByTimeRange(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
        ]);
        $startDate = $request->input('start_date', now()->subDays(30)->toDateString());
        $endDate = $request->input('end_date', now()->toDateString());

        // Kiểm tra khoảng thời gian có hợp lệ không
        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        if ($end->diffInDays($start) > 30) {
            return response()->json([
                'success' => false,
                'message' => 'Khoảng thời gian không được vượt quá 30 ngày.',
            ], 400);
        }
        // Truy vấn số lượng đơn hàng theo ngày
        $data = DB::table('bills')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        // Truy vấn doanh thu theo ngày (chỉ tính đơn hàng đã hoàn thành)
            $revenuePerDay = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(DB::raw('DATE(bills.created_at) as order_date'), DB::raw('SUM(bill_items.variant_quantity * bill_items.sale_price) as total_revenue'))
            ->whereBetween('bills.created_at', [$startDate, $endDate])
            ->whereIn('bills.bill_status', ['delivered', 'completed'])
            ->groupBy(DB::raw('DATE(bills.created_at)'))
            ->orderBy('order_date', 'asc')
            ->get();


        // Truy vấn lợi nhuận theo ngày
        $profitPerDay = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(DB::raw('DATE(bills.created_at) as order_date'), DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit'))
            ->whereBetween('bills.created_at', [$startDate, $endDate])
            // ->where('bills.bill_status', 'completed')
            ->whereIn('bills.bill_status', ['delivered', 'completed'])  
            ->groupBy(DB::raw('DATE(bills.created_at)'))
            ->orderBy('order_date', 'asc')
            ->get();
        // doanh thu lợi nhuận theo tháng  
        // Trả về dữ liệu dưới dạng JSON
        return response()->json([
            'success' => true,
            'labels' => $data->pluck('date'),
            'orderCounts' => $data->pluck('count'),
            'revenues' => $revenuePerDay->pluck('total_revenue'),
            'profits' => $profitPerDay->pluck('total_profit'),
        ]);
    }
}