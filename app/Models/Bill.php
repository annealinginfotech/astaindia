<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'bill_no',
        'branch',
        'name',
        'billing_date',
        'fees_type',
        'month',
        'year',
        'payment_mode',
        'cheque_no',
        'cheque_issue_date',
        'bank_of_cheque',
        'total_amount',
        'receipt_file',
        'remarks',
        'added_by',
        'other_information',
        'late_fine',
        'total_bill_amount'
    ];

    protected $casts    =   [
        'billing_date'  =>  'datetime',
        'cheque_issue_date' =>  'datetime'
    ];

    public function generatedBy() {
        return $this->belongsTo(User::class, 'added_by', 'id')->withTrashed()->select('id', 'name');
    }

    //protected $appends  =   ['generated_by'];
}
