<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Requests\BillCreateFormRequest;
use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use App\Exports\BillExport;
use Maatwebsite\Excel\Facades\Excel;
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

        $bills  =   Bill::with('generatedBy')->when(auth()->user()->email != 'info@astaindia.org', fn($q) => $q->where('added_by', auth()->user()->id))
                        ->orderBy('bill_no', 'DESC')->get();
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
        $billingYearRange   =   range(2024, 2034);
        $billingMonthRange  =   array_reduce(range(1,12),function($rslt,$m){ $rslt[$m] = date('F',mktime(0,0,0,$m,10)); return $rslt; });
        $data   =   [
            'title'             =>  'Create new bill',
            'breadCrumbs'       =>  $this->breadcrumbs,
            'latestBillNumber'  =>  $latestBillNumber,
            'billingYearRange'  =>  $billingYearRange,
            'billingMonthRange' =>  $billingMonthRange
        ];

        return view('createBill.index')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( BillCreateFormRequest $request)
    {
        if(auth()->user()->can_generate_bill) {
            try {
                $inputs =   $request->except('_token');
                $inputs['billing_date']     =   Carbon::parse($request->billing_date);

                $lastBillNumber     =   Bill::withTrashed()->latest()->value('bill_no');
                $latestBillNumber   =   0;
                $latestBillNumber   =   ($lastBillNumber) ? $lastBillNumber+1 : 1001;

                $inputs['bill_no']  =   $latestBillNumber;
                $inputs['added_by'] =   auth()->user()->id;

                $lateFine                       =   ($request->late_fine) ?? 0;
                $inputs['late_fine']            =   $lateFine;
                $inputs['total_bill_amount']    =   $request->total_amount + $lateFine;

                $billInformation                =   Bill::create($inputs);



            } catch (\Throwable $th) {
                Log::channel('billCreation')->debug('Error creating a bill. Cause: '.$th->getMessage());
                return redirect()->back()->with('internalError', "Unable to create the Bill. Please try again later.");
            }

            switch ($request->action) {
                case 'save':
                    Helper::genereatePaySlipPDF($billInformation);
                    return redirect()->route('billing.index')->with('success', 'Bill created successfully. Bill No. is: <strong>'.$latestBillNumber.'</strong>');
                    break;
                case 'save_and_print':
                    Helper::genereatePaySlipPDF($billInformation);
                    return redirect()->route('billing.index')->with('success', 'Bill created successfully. Bill No. is: <strong>'.$latestBillNumber.'</strong>');
                    break;

                default:
                    # code...
                    break;
            }
        } else {
            return redirect()->route('billing.index')->with('smartMove', 'Wow!! Smart move, but not this time.');
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
        if(auth()->user()->can_edit_bill)
        {
            $this->addBreadcrumb('Dashboard', '/', '');
            $this->addBreadcrumb('Create new bill', '#', 'active');

            $billInformation    =   Bill::findOrFail($id);
            $billingYearRange   =   range(2024, 2034);
            $billingMonthRange  =   array_reduce(range(1,12),function($rslt,$m){ $rslt[$m] = date('F',mktime(0,0,0,$m,10)); return $rslt; });

            $data               =   [
                'title'             =>  $billInformation->bill_no,
                'breadCrumbs'       =>  $this->breadcrumbs,
                'billInformation'   =>  $billInformation,
                'latestBillNumber'  =>  $billInformation->bill_no,
                'billingYearRange'  =>  $billingYearRange,
                'billingMonthRange' =>  $billingMonthRange

            ];

            return view('createBill.edit')->with($data);
        } else {
            return redirect()->route('billing.index')->with('smartMove', 'Wow!! Smart move, but not this time.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BillCreateFormRequest $request, string $id)
    {
        if(auth()->user()->can_edit_bill) {
            $billInformation    =   Bill::findOrFail($id);

            try {

                $updateBill                        =   $request->except('_token');

                $lateFine                          =   ($request->late_fine) ?? 0;
                $updateBill['late_fine']           =   $lateFine;
                $updateBill['total_bill_amount']   =   $request->total_amount + $lateFine;


                $billInformation->update($updateBill);

                //$updatedBill        =   Bill::where('id', $id)->first();
                Helper::genereatePaySlipPDF($billInformation);

            } catch (\Throwable $th) {
                Log::channel('billUpdate')->debug('Error while updating Bill record id: '.$id.' Cause: '.$th->getMessage());
                return redirect()->back()->with('internalError', 'Unable to update this bill. Please try again later.');
            }

            return redirect()->route('billing.index')->with('success', 'Bill no: <strong>'.$billInformation->bill_no.'</strong> updated successfully.');
        } else {
            return redirect()->route('billing.index')->with('smartMove', 'Wow!! Smart move, but not this time.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(auth()->user()->can_delete_bill) {
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
        } else {
            return response()->json([
                'message'   =>  'Wow! Smart move. But not this time'
            ]);
        }
    }

    public function downloadPayslip($id)
    {
        try {
            $billFile    =   Bill::where('id', $id)->first(['bill_no', 'receipt_file']);
            if($billFile) {
                $filepath   =   storage_path($billFile->receipt_file);
                $fileName   =   $billFile->bill_no.'.pdf';
                //return response()->download($filepath, $fileName);

                return Storage::download($filepath);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function export() {
        return Excel::download(new BillExport, 'users.xlsx');
    }


    public function savePrint($id) {
        $billInformation    =   Bill::where('id', $id)->first();

        return Helper::genereatePaySlipPDF($billInformation);
    }
}
