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

        $data   =   [
            'title'             =>  'Dashboard',
            'breadCrumbs'       =>  $this->breadcrumbs,
            'totalBillCount'    =>  $totalBillCount,
        ];
        return view('dashboard')->with($data);
    }
}
