<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $this->addBreadcrumb('Dashboard', '#', 'active');
        $totalBillCount =   Bill::count();
        $todayCount     =   Bill::whereDate('billing_date', Carbon::today())->count();

        $data   =   [
            'title'             =>  'Dashboard',
            'breadCrumbs'       =>  $this->breadcrumbs,
            'totalBillCount'    =>  $totalBillCount,
            'todayBillCount'    =>  $todayCount
        ];
        return view('dashboard')->with($data);
    }
}
