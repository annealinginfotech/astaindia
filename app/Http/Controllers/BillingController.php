<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Requests\BillCreateFormRequest;
use Carbon\Carbon;
use Log;


class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->addBreadcrumb('Dashboard', '/', '');
        $this->addBreadcrumb('Create new bill', '#', 'active');

        $lastBillNumber     =   Bill::latest()->value('bill_no');
        $latestBillNumber   =   0;
        $latestBillNumber   =   ($lastBillNumber) ? $lastBillNumber+1 : 1001;
        $data   =   [
            'title'             =>  'Create new bill',
            'breadCrumbs'       =>  $this->breadcrumbs,
            'latestBillNumber'  =>  $latestBillNumber
        ];

        return view('createBill.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BillCreateFormRequest $request)
    {
        try {
            $inputs =   $request->except('_token');
            $inputs['billing_date']     =   Carbon::parse($request->billing_date);

            $lastBillNumber     =   Bill::latest()->value('bill_no');
            $latestBillNumber   =   0;
            $latestBillNumber   =   ($lastBillNumber) ? $lastBillNumber+1 : 1001;

            $inputs['bill_no']  =   $latestBillNumber;
            Bill::create($inputs);
        } catch (\Throwable $th) {
            Log::channel('billCreation')->debug('Error creating a bill. Cause: '.$th->getMessage());
            return redirect()->back()->with('internalError', "Unable to create the Bill. Please try again later.");
        }

        return redirect()->route('bill.index')->with('success', 'Bill created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
