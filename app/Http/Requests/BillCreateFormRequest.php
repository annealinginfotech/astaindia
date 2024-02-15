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
            'description'       =>  'required',
            'total_amount'      =>  'required',
            'cheque_no'         =>  'nullable',
            'cheque_issue_date' =>  'nullable',
            'bank_of_cheque'    =>  'nullable'
        ];
    }

    public function messages()
    {
        return [
            'branch.required'           =>  'Branch name is requried',
            'billing_date.required'     =>  'Billing date is required',
            'name.required'             =>  'Name is required',
            'description.required'      =>  'Description is required',
            'total_amount.required'     =>  'Amount is required',
        ];
    }
}
