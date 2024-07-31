<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZoneRequest extends FormRequest
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
            'zone_name'     =>  'required',
            'type'          =>  'required',
            'parent_zone'   =>  'required_unless:type,headquarters',
            'status'        =>  'required',
            'address'       =>  'required',
            'phone_no'      =>  'required'
        ];
    }

    public function messages() {
        return [
            'zone_name.required'            =>  'Zone name is required',
            'type.required'                 =>  'Please choose valid zone type',
            'parent_zone.required_unless'       =>  'Please choose parent zone if type is selected apart from Head quarters',
            'status.required'               =>  'Please choose valid status',
            'address.required'              =>  'Please provide the zone address',
            'phone_no.required'             =>  'Pleas enter the valid phone number'
        ];
    }
}
