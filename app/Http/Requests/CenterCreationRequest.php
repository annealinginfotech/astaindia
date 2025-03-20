<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CenterCreationRequest extends FormRequest
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
            'code'          =>  'required',
            'name'          =>  'required',
            'type'          =>  'required',
            'parent_zone'   =>  'required_unless:type,headquarters',
            'status'        =>  'required',
            'address'       =>  'required',
            'email'         =>  'required',
            'phone'      =>  'required'
        ];
    }

    public function messages() {
        return [
            'code.required'                 =>  'Center code is required',
            'name.required'                 =>  'Center name is required',
            'type.required'                 =>  'Please choose valid center type',
            'parent_zone.required_unless'   =>  'Please choose parent zone if type is selected apart from Head quarters',
            'status.required'               =>  'Please choose valid status',
            'address.required'              =>  'Please provide the center address',
            'email.required'                =>  'Please  provide valid email address',
            'phone.required'             =>  'Pleas enter the valid phone number'
        ];
    }
}
