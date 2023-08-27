<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $sales_data = Order::select(
            DB::raw("year(created_at) as year"),
            DB::raw("month(created_at) as month"),
            DB::raw("SUM(total_price) as total_price"),
        )->groupBy("month")->get();

        foreach($sales_data as $row)
        {
            $year = $row->year;
            $lables[] = $row->month;
            $data[] = $row->total_price;
        }

        return view("Dashboard.index", compact("year", "lables", "data"));
    }
}
