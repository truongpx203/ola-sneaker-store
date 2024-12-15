<?php

namespace App\Exports;

use App\Models\BillItem;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthExport implements FromCollection, WithHeadings
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
        return BillItem::join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(
                DB::raw('DATE_FORMAT(bills.created_at, "%m-%Y") as month'),
                DB::raw('SUM(bill_items.sale_price * bill_items.variant_quantity) as total_revenue'), // Doanh thu
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Lợi nhuận
            )
            ->whereIn('bills.bill_status', ['delivered', 'completed']) // Chỉ lọc hóa đơn đã giao hoặc hoàn thành
            ->groupBy(DB::raw('DATE_FORMAT(bills.created_at, "%m-%Y")'))
            // Sắp xếp theo tháng
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tháng - Năm', // Month - Year
            'Doanh Thu',   // Total Revenue
            'Lợi Nhuận'    // Total Profit
        ];
    }
}
