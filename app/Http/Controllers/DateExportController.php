<?php

namespace App\Http\Controllers;

use App\Exports\DateExport;
use App\Exports\MonthExport;
use App\Exports\YearExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DateExportController extends Controller
{
   public function dateExport(Request $request){
    $monthYear = $request->query('month', date('m-Y'));
    [$month, $year] = explode('-', $monthYear);
    return Excel::download(new DateExport($month, $year), 'doanh-thu-loi-nhuan.xlsx');
   }
   public function monthExport(Request $request){
    $monthYear = $request->query('month', date('m-Y'));
    [$month, $year] = explode('-', $monthYear);
    return Excel::download(new MonthExport($month, $year), 'doanh-thu-loi-nhuan-thang.xlsx');
   }
   public function yearExport(Request $request){
    $year = $request->query('year', date('Y'));
    // [ $year] = explode('-', $monthYear);
    return Excel::download(new YearExport( $year), 'doanh-thu-loi-nhuan-nam.xlsx');
   }
}
