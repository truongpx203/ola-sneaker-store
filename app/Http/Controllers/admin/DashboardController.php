<?php

namespace App\Http\Controllers\admin;

use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

        $month = request('month', date('m')); // Lấy tháng từ request hoặc mặc định là tháng hiện tại

        $thongKeNgayTheoThang = DB::table('bill_items')
            ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(
                DB::raw('DAY(bills.created_at) as day'), // Lấy ngày
                DB::raw('SUM(bill_items.sale_price * bill_items.variant_quantity) as total_revenue'), // Tổng doanh thu
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Tổng lợi nhuận
            )
            ->where('bills.bill_status', 'completed') // Chỉ tính cho hóa đơn đã hoàn thành
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
            'thongKeNgayTheoThangData'
        ));
    }
}
