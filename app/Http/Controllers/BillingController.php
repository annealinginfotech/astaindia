<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Requests\BillCreateFormRequest;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Log;


class BillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->addBreadcrumb('Dashboard', '/', '');
        $this->addBreadcrumb('All bill', '#', 'active');
        $bills  =   Bill::all();
        $data   =   [
            'title'     =>  'All bills',
            'breadCrumbs'   =>  $this->breadcrumbs,
            'bills'         =>  $bills
        ];

        return view('allBills.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->addBreadcrumb('Dashboard', '/', '');
        $this->addBreadcrumb('Create new bill', '#', 'active');

        $lastBillNumber     =   Bill::withTrashed()->latest()->value('bill_no');
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
    public function store( BillCreateFormRequest $request)
    {
        try {
            $inputs =   $request->except('_token');
            $inputs['billing_date']     =   Carbon::parse($request->billing_date);

            $lastBillNumber     =   Bill::withTrashed()->latest()->value('bill_no');
            $latestBillNumber   =   0;
            $latestBillNumber   =   ($lastBillNumber) ? $lastBillNumber+1 : 1001;

            $inputs['bill_no']  =   $latestBillNumber;
            Bill::create($inputs);
        } catch (\Throwable $th) {
            Log::channel('billCreation')->debug('Error creating a bill. Cause: '.$th->getMessage());
            return redirect()->back()->with('internalError', "Unable to create the Bill. Please try again later.");
        }

        switch ($request->action) {
            case 'save':
                    return redirect()->route('billing.index')->with('success', 'Bill created successfully. Bill No. is: <strong>'.$latestBillNumber.'</strong>');
                break;
            case 'save_and_print':

                break;

            default:
                # code...
                break;
        }

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
        $this->addBreadcrumb('Dashboard', '/', '');
        $this->addBreadcrumb('Create new bill', '#', 'active');

        $billInformation    =   Bill::findOrFail($id);
        $fpdf   =   new Fpdf('L', 'mm', array(210, 148.5));
        $fpdf->AddPage();
        $fpdf->SetFont('Courier', 'B', 18);
        $fpdf->Cell(50, 25, 'Hello World!');
        $fpdf->Output();
        exit;

        /* $data               =   [
            'title'             =>  $billInformation->bill_no,
            'breadCrumbs'       =>  $this->breadcrumbs,
            'billInformation'   =>  $billInformation,
            'latestBillNumber'  =>  $billInformation->bill_no

        ];

        return view('createBill.edit')->with($data); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BillCreateFormRequest $request, string $id)
    {
        $billInformation    =   Bill::findOrFail($id);

        try {
            $billInformation->update($request->except('_token'));

        } catch (\Throwable $th) {
            Log::channel('billUpdate')->debug('Error while updating Bill record id: '.$id.' Cause: '.$th->getMessage());
            return redirect()->back()->with('internalError', 'Unable to update this bill. Please try again later.');
        }

        return redirect()->route('billing.index')->with('success', 'Bill no: <strong>'.$billInformation->bill_no.'</strong> updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $billInformation    =   Bill::where('id', $id)->first();
            $deleteID           =   $billInformation->bill_no;
            $billInformation->delete();

        } catch (\Throwable $th) {
            Log::channel('billDelete')->debug('Error while deleting bill '.$deleteID.' Cause: '.$th->getMessage());
            return response()->json([
                'message'    => 'Bill No: '.$deleteID.' unable to delete.'
            ],500);
        }


        return response()->json([
            'message'    => 'Bill No: '.$deleteID.' is deleted.'
        ],200);
    }
}
