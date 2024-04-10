<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillCreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'branch'            =>  'required',
            'billing_date'      =>  'required',
            'name'              =>  'required',
            'fees_type'         =>  'required',
            'month'             =>  'required_if:fees_type,admission,monthly',
            'year'              =>  'required_if:fees_type,admission,monthly',
            'remarks'           =>  'required_if:fees_type,others',
            'payment_mode'      =>  'required',
            'total_amount'      =>  'required',
            'cheque_no'         =>  'nullable',
            'cheque_issue_date' =>  'nullable',
            'bank_of_cheque'    =>  'nullable'
        ];
    }

    public function messages()
    {
        return [
            'branch.required'           =>  'Branch name is required',
            'billing_date.required'     =>  'Billing date is required',
            'name.required'             =>  'Name is required',
            'fees_type'                 =>  'Fees type is required',
            'month'                     =>  'Month is required',
            'year'                      =>  'Year is required',
            'payment_mode'              =>  'Payment mode is required',
            'total_amount.required'     =>  'Amount is required',
            'remarks_required_if'          =>  'Remarks is required'
        ];
    }
}
