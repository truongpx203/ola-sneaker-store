<?php

namespace App\Exports;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DateExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        return  DB::table('bill_items')
        ->join('bills', 'bill_items.bill_id', '=', 'bills.id')
        ->select(
            DB::raw('DATE_FORMAT(bills.created_at, "%d-%m-%Y") as day'), // Hiển thị ngày, tháng, năm
            DB::raw('SUM(bill_items.sale_price * bill_items.variant_quantity) as total_revenue'), // Tổng doanh thu
            DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Tổng lợi nhuận
        )
        ->whereIn('bills.bill_status', ['delivered', 'completed'])   // Chỉ tính cho hóa đơn đã hoàn thành

        // ->whereYear('bills.created_at',  $this->year) // Lọc theo năm
        ->groupBy(DB::raw('DATE_FORMAT(bills.created_at, "%d-%m-%Y")')) // Nhóm theo ngày, tháng, năm
        ->get();

    }
    public function headings(): array
    {
        return [
            'Ngày',
            'Doanh Thu',
            'Lợi Nhuận'
        ];
    }



}
