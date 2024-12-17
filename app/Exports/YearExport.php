<?php

namespace App\Exports;

use App\Models\BillItem;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class YearExport implements FromCollection, WithHeadings
{

    protected $year;

    public function __construct($year)
    {

        $this->year = $year;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BillItem::join('bills', 'bill_items.bill_id', '=', 'bills.id')
            ->select(
                DB::raw('YEAR(bills.created_at) as year'),
                DB::raw('SUM(bill_items.sale_price * bill_items.variant_quantity) as total_revenue'), // Tổng doanh thu
                DB::raw('SUM((bill_items.sale_price - bill_items.import_price) * bill_items.variant_quantity) as total_profit') // Tổng lợi nhuận
            )
            // ->whereYear('bills.created_at',  $this->year) // Lọc theo năm
            // ->whereYear('bills.created_at', $this->year) // Lọc theo năm
            ->whereIn('bills.bill_status', ['delivered', 'completed']) // Trạng thái hóa đơn hợp lệ
            ->groupBy(DB::raw('YEAR(bills.created_at)'))
            ->orderBy(DB::raw('YEAR(bills.created_at)'))
            ->get();
    }
    
    public function headings(): array
    {
        return [
            'Năm',
            'Doanh Thu',
            'Lợi Nhuận'
        ];
    }
}
