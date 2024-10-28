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
            ->select('bill_items.variant_id', 'bill_items.product_name', 'bill_items.product_image_url', 'bill_items.sale_price', 'bill_items.listed_price', 'bill_items.import_price', DB::raw('COUNT(bill_items.variant_id) as appearances'))
            ->where('bills.bill_status', 'delivered') // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
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
            ->where('bills.bill_status', 'delivered') // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
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
            ->where('bills.bill_status', 'delivered') // Điều kiện chỉ tính các đơn hàng có trạng thái hoàn thành
            ->groupBy(
                'bill_items.variant_id',
                'bill_items.product_name',
                'bill_items.product_image_url'
            )
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
            ->where('bills.bill_status', 'delivered') // Chỉ tính cho hóa đơn đã hoàn thành
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
    public function getStatisticsYear(Request $request)
    {
        $year = $request->input('year') ?? Carbon::today()->format('Y');
        $data = DB::table('bills')
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $monthlyData = [
            'counts' => array_fill(0, 12, 0),
            'revenues' => array_fill(0, 12, 0.0)
        ];
        foreach ($data as $item) {
            $monthlyData['counts'][$item->month - 1] = $item->count;
            $monthlyData['revenues'][$item->month - 1] = $item->revenue;
        }
        return response()->json($monthlyData);
    }

    public function statisticsMonth(Request $request)
{
 $request->validate([
    'month' => 'required|date_format:m',
    'year' => 'required|digits:4'
]);

$month = $request->input('month');
$year = $request->input('year');
$revenues = array_fill(0, 31, 0);
$profits = array_fill(0, 31, 0); 
$startDate = "$year-$month-01";
$endDate = date("Y-m-t", strtotime($startDate));
$bill_items = BillItem::whereBetween('created_at', [$startDate, $endDate])
                 ->get();
$bills = Bill::whereBetween('created_at', [$startDate, $endDate])
->where('bill_status', 'completed')
->get();

foreach ($bills as $bill) {
    $day = (int) $bill->created_at->format('d');
    $revenues[$day - 1] += $bill->total_price; // Tính doanh thu
}
foreach ($bill_items as $bill_item) {
    $day = (int) $bill_item->created_at->format('d');
    $profits[$day - 1] += ($bill_item->sale_price - $bill_item->import_price) * $bill_item->variant_quantity; // Tính lợi nhuận
}

// Trả về dữ liệu
return response()->json([
    'revenues' => $revenues,
    'profits' => $profits,
]);
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
$revenuePerDay = DB::table('bills')
->select(DB::raw('DATE(created_at) as order_date'), DB::raw('SUM(total_price) as total_revenue'))
->whereBetween('created_at', [$startDate, $endDate])
->where('bill_status', 'completed')
->groupBy(DB::raw('DATE(created_at)'))
->orderBy('order_date', 'asc')
->get();

// Truy vấn lợi nhuận theo ngày
$profitPerDay = DB::table('bill_items')
->join('bills', 'bill_items.bill_id', '=', 'bills.id')
->select(DB::raw('DATE(bills.created_at) as order_date'), DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit'))
->whereBetween('bills.created_at', [$startDate, $endDate])
->where('bills.bill_status', 'completed')
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

    

