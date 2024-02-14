<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $this->addBreadcrumb('Dashboard', '#', 'active');
        $data   =   [
            'title'    =>  'Dashboard',
            'breadCrumbs'   =>  $this->breadcrumbs
        ];
        return view('dashboard')->with($data);
    }
}
