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
        $fpdf->SetFont('ARIAL', 'BU', 12);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->Image('images/logo.jpg',10,10, 30,30);
        $fpdf->SetXY('40', '10');
        $fpdf->Cell('155', '5', 'RECEIPT', 0, 1, 'C');
        $fpdf->SetFont('Arial', 'B', 16);
        $fpdf->SetXY('40', '15');
        $fpdf->Cell('155', '5', 'ADVANCE SPORTS AND TRAINING ACADEMY', 0, 0, 'C');
        $fpdf->SetFont('Arial', 'B', 10);
        $fpdf->SetXY('40', '20');
        $fpdf->Cell('155', '5', 'H.O. : Sikhalaya Apartment, Natagarh, Sodepur, Kolkata - 700 113', 0, 0, 'C');
        $fpdf->SetXY('40', '25');
        $fpdf->Cell('155', '5', 'Mob. : 7980112359 / 9062894076', 0, 0, 'C');
        $fpdf->SetXY('40', '30');
        $fpdf->Cell('155', '5', 'E-mail: info@astaindia.org website : www.astaindia.org', 0, 1, 'C');

        $fpdf->Ln(10);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell('18', '5', 'Branch: ', 0, 0, 'L');
        $fpdf->SetFont('Arial', '', 12);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->SetXY('30', '45');
        $fpdf->Cell('170', '5', $billInformation->branch, 'B',1,'L');
        $fpdf->Ln(2);

        $fpdf->SetFont('ARIAL', 'B', 13);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->Cell('190', '45', '', 1,0,'L');
        $fpdf->SetXY('10', '52');
        $fpdf->Cell('140', '15', '', 'BR',0,'L');
        $fpdf->Cell('50', '15', '', 'BL',0,'L');

        $fpdf->SetXY('10', '57');
        $fpdf->Cell('18', '5', 'Name', 0,0,'L');
        $fpdf->Cell('120', '5', '', 'B',0,'L');
        $fpdf->SetXY('28', '57');

        $fpdf->SetFont('ARIAL', '', 12);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('120', '5', $billInformation->name, 0,0,'L');

        $fpdf->SetTextColor(0,71,171);
        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->SetXY('10', '67');
        $fpdf->Cell('16', '5', 'Sl. No.', 'B',0,'C');
        $fpdf->Cell('124', '5', 'D E S C R I P T I O N', 'BL',0,'C');
        $fpdf->Cell('50', '5', 'AMOUNT Rs.', 1,1,'C');

        $fpdf->Cell('16', '25', '', 'R',0,'C');
        $fpdf->Cell('124', '25', '', '',0,'C');
        $fpdf->Cell('50', '25', '', 'L',1,'C');

        $fpdf->SetXY('10', '97');
        $fpdf->Cell('140', '15', '', 1,0,'L');
        $fpdf->Cell('50', '15', '', 1,0,'C');

        $fpdf->SetXY('10', '98');
        //$fpdf->Ln(2);
        $fpdf->Cell('30', '5', 'Cheque No. :', 0,0,'L');
        $fpdf->Cell('60', '5', '', 'B',0,'C');
        $fpdf->Cell('15', '5', 'Date :', 0,0,'L');
        $fpdf->Cell('33', '5', '', 'B',1,'L');
        $fpdf->Ln(2);
        $fpdf->Cell('15', '5', 'Bank :',0,0,'L');
        $fpdf->Cell('123', '5', '','B',0,'L');

        $fpdf->SetXY('10', '112');
        $fpdf->Cell('140', '16', '', 0,0,'L');
        $fpdf->Cell('50', '16', '', 0,0,'L');

        $fpdf->SetXY('10', '123');
        $fpdf->Cell('20', '5', '(Rupees ', 0,0,'L');
        $fpdf->Cell('115', '5', '', 'B',0,'L');
        $fpdf->Cell('5', '5', ')', 0,0,'R');
        $fpdf->SetFont('ARIAL', 'BI', 12);
        $fpdf->Cell('50', '5', 'Authorised Signatory', 0, 0, 'C');
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
