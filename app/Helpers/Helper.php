<?php

namespace App\Helpers;
use App\Models\Bill;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Log;

class Helper {


    public static function numberToWord($num = '')
    {
        $num    = ( string ) ( ( int ) $num );

        if( ( int ) ( $num ) && ctype_digit( $num ) )
        {
            $words  = array( );

            $num    = str_replace( array( ',' , ' ' ) , '' , trim( $num ) );

            $list1  = array('','one','two','three','four','five','six','seven',
                'eight','nine','ten','eleven','twelve','thirteen','fourteen',
                'fifteen','sixteen','seventeen','eighteen','nineteen');

            $list2  = array('','ten','twenty','thirty','forty','fifty','sixty',
                'seventy','eighty','ninety','hundred');

            $list3  = array('','thousand','million','billion','trillion',
                'quadrillion','quintillion','sextillion','septillion',
                'octillion','nonillion','decillion','undecillion',
                'duodecillion','tredecillion','quattuordecillion',
                'quindecillion','sexdecillion','septendecillion',
                'octodecillion','novemdecillion','vigintillion');

            $num_length = strlen( $num );
            $levels = ( int ) ( ( $num_length + 2 ) / 3 );
            $max_length = $levels * 3;
            $num    = substr( '00'.$num , -$max_length );
            $num_levels = str_split( $num , 3 );

            foreach( $num_levels as $num_part )
            {
                $levels--;
                $hundreds   = ( int ) ( $num_part / 100 );
                $hundreds   = ( $hundreds ? ' ' . $list1[$hundreds] . ' Hundred' . ' ' : '' );
                $tens       = ( int ) ( $num_part % 100 );
                $singles    = '';

                if( $tens < 20 ) { $tens = ( $tens ? ' ' . $list1[$tens] . ' ' : '' ); } else { $tens = ( int ) ( $tens / 10 ); $tens = ' ' . $list2[$tens] . ' '; $singles = ( int ) ( $num_part % 10 ); $singles = ' ' . $list1[$singles] . ' '; } $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_part ) ) ? ' ' . $list3[$levels] . ' ' : '' ); } $commas = count( $words ); if( $commas > 1 )
            {
                $commas = $commas - 1;
            }

            $words  = implode( ', ' , $words );

            $words  = trim( str_replace( ' ,' , ',' , ucwords( $words ) )  , ', ' );
            if( $commas )
            {
                $words  = str_replace( ',' , '' , $words );
            }

            return $words;
        }
        else if( ! ( ( int ) $num ) )
        {
            return 'Zero';
        }
        return '';
    }

    public static function genereatePaySlipPDF($billInformation)
    {
        $fpdf   =   new Fpdf('P', 'mm', 'A4');
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
        $fpdf->Cell('155', '5', 'Mob. : +91 9433922339 / +91 7980112359', 0, 0, 'C');
        $fpdf->SetXY('40', '30');
        $fpdf->Cell('155', '5', 'E-mail: info@astaindia.org | Website: www.astaindia.org', 0, 1, 'C');

        $fpdf->Ln(10);
        $fpdf->SetFont('Arial', 'B', 12);
        $fpdf->Cell('18', '5', 'Branch: ', 0, 0, 'L');
        $fpdf->SetFont('Arial', 'B', 15);
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

        $fpdf->SetFont('ARIAL', '', 15);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('120', '5', $billInformation->name, 0,0,'L');

        $fpdf->SetFont('ARIAL', 'B', 13);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->SetXY('150', '53');
        $fpdf->Cell('15', '5', 'S. No.', 0, 0, 'L');
        $fpdf->SetFont('ARIAL', 'B', 15);
        $fpdf->SetTextColor(0,0,0);

        $fpdf->Cell('34', '5', $billInformation->bill_no, 'B', 1, 'L');
        $fpdf->SetXY('150', '60');
        $fpdf->SetFont('ARIAL', 'B', 13);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->Cell('15', '5', 'Date: ', 0, 0, 'L');

        $fpdf->SetFont('ARIAL', '', 15);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('34', '5', $billInformation->billing_date->format('d-M-Y'), 'B', 1, 'L');

        $fpdf->SetTextColor(0,71,171);
        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->SetXY('10', '67');
        $fpdf->Cell('16', '5', 'Sl. No.', 'B',0,'C');
        $fpdf->Cell('124', '5', 'D E S C R I P T I O N', 'BL',0,'C');
        $fpdf->Cell('50', '5', 'AMOUNT Rs.', 1,1,'C');

        $fpdf->SetFont('ARIAL', '', 12);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('16', '25', '1', 'R',0,'C');
        if($billInformation->fees_type == 'others')
        {
            $fpdf->Cell('124', '20', $billInformation->remarks, 0,2,'L');
            $fpdf->Cell('124', '5', 'Payment Mode: '.$billInformation->payment_mode, 0,0,'L');
        }
        else
        {
            $fpdf->Cell('124', '20', ucwords(str_replace('_', ' ', $billInformation->fees_type)).' fees for '.$billInformation->month.' - '.$billInformation->year, 0,2,'L');
            $fpdf->Cell('124', '5', 'Payment Mode: '.$billInformation->payment_mode, 0,0,'L');
        }
        $fpdf->SetXY('150', '67');
        $fpdf->Cell('50', '30', $billInformation->total_amount.'/-', 'L',1,'C');


        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->SetXY('10', '97');
        $fpdf->Cell('140', '15', '', 1,0,'L');
        $fpdf->SetFont('ARIAL', 'B', 15);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('50', '15', $billInformation->total_amount.'/-', 1,0,'C');

        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->SetXY('10', '98');
        //$fpdf->Ln(2);
        $fpdf->Cell('30', '5', 'Cheque No. :', 0,0,'L');
        $fpdf->SetFont('ARIAL', '', 12);
        $fpdf->SetTextColor(0,0,0);

        $fpdf->Cell('60', '5', ($billInformation->cheque_no) ?? 'N/A', 'B',0,'L');
        $fpdf->SetTextColor(0,71,171);
        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->Cell('15', '5', 'Date :', 0,0,'L');

        $fpdf->SetFont('ARIAL', '', 12);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('33', '5', ($billInformation->cheque_issue_date) ? $billInformation->cheque_issue_date->format('d-M-Y') : 'N/A', 'B',1,'L');
        $fpdf->Ln(2);
        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->Cell('15', '5', 'Bank :',0,0,'L');
        $fpdf->SetFont('ARIAL', '', 12);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('123', '5', ($billInformation->bank_of_cheque) ?? 'N/A','B',0,'L');

        $fpdf->SetXY('10', '112');
        $fpdf->Cell('140', '16', '', 0,0,'L');
        $fpdf->Cell('50', '16', '', 0,0,'L');


        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->SetXY('10', '123');
        $fpdf->Cell('20', '5', '(Rupees ', 0,0,'L');

        $fpdf->SetFont('ARIAL', '', 12);
        $fpdf->SetTextColor(0,0,0);
        $fpdf->Cell('115', '5', self::numberToWord($billInformation->total_amount).' only.', 'B',0,'L');
        $fpdf->SetFont('ARIAL', 'B', 12);
        $fpdf->SetTextColor(0,71,171);
        $fpdf->Cell('5', '5', ')', 0,0,'R');
        $fpdf->SetFont('ARIAL', 'BI', 12);
        $fpdf->Cell('50', '5', 'Authorised Signatory', 0, 0, 'C');
        /* return $fpdf->Output();
        exit(); */
        $paymentYear    =   $billInformation->billing_date->format('Y');
        $paymentMonth   =   $billInformation->billing_date->format('F');
        $filename       =   $billInformation->bill_no.str_replace(' ','', $billInformation->name).$paymentMonth.$paymentYear.'.pdf';
        $storingPath    =   'payslips/'.$paymentYear.'/'.$paymentMonth;
        try {
            Storage::disk('public')->makeDirectory($storingPath);
            $fpdf->Output('storage/'.$storingPath.'/'.$filename, 'F');

            /* Saving details to db */
            $billInformation->update(['receipt_file'    =>  $storingPath.'/'.$filename]);
            Log::channel('receiptGenerateLog')->info('Receipt generated. Receipt ID => '.$billInformation->bill_no);
            return redirect()->route('billing.index')->with('success', 'Receipt File generated. You can download now.');
        } catch (\Exception $e) {
            Log::channel('receiptGenerateLog')->info('Something went wrong to Generate receipt. DB Table ID => '.$billInformation->id.' Cause ===> '.$e);
            return redirect()->route('billing.index')->with('internalError', 'Some internal problem detected. Please contact owner.');
        }
    }
}
