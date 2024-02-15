<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_no',
        'branch',
        'name',
        'billing_date',
        'cheque_no',
        'cheque_issue_date',
        'bank_of_cheque',
        'total_amount'
    ];

    protected $dates    =   ['billing_date'];
}
