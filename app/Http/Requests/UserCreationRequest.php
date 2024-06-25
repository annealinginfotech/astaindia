<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreationRequest extends FormRequest
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
            'name'                  =>  'required',
            'father_name'           =>  'required',
            'gender'                =>  'required',
            'martial_status'        =>  'required',
            'hobby'                 =>  'required',
            'related_to_sports'     =>  'required',
            'address'               =>  'required',
            'primary_contact'       =>  'required|numeric',
            'whatsapp_number'       =>  'nullable|numeric',
            'emergency_contact'     =>  'required|numeric',
            'qualification'         =>  'required',
            'skills'                =>  'required',
            'bank_name'             =>  'required',
            'account_number'        =>  'required',
            'account_holder_name'   =>  'required',
            'ifsc_code'             =>  'required',
            'identity_proof'        =>  'required|mimes:pdf',
            'photo'                 =>  'required|mimes:image',
            'signature'             =>  'required|mimes:png',
            'last_qualification'    =>  'required|mimes:pdf',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:8|max:20',
            'roles'                 => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                  =>     'Name is required',
            'father_name.required'           =>     'Father name is required',
            'gender.required'                =>     'Gender is required',
            'martial_status.required'        =>     'Martial status is required',
            'hobby.required'                 =>     'Hobby is required',
            'related_to_sports.required'     =>     'Please specify whether the user is related to sports or not.',
            'address.required'               =>     'Address is required',
            'primary_contact.required'       =>     'Priamry contact number is required',
            'whatsapp_number'                =>     'Numeric requried',
            'emergency_contact.required'     =>     'Emergency contact number is required',
            'qualification.required'         =>     'Qualification is required',
            'skills.required'                =>     'Please specify the skill sets',
            'bank_name.required'             =>     'Bank name is required',
            'account_number.required'        =>     'Account number is required',
            'account_holder_name.required'   =>     'Account holder name is required',
            'ifsc_code.required'             =>     'I.F.S.C code is required',
            'identity_proof.required'        =>     'Please upload the identity proof',
            'photo.required'                 =>     'Photo is required',
            'signature.required'             =>     'Signature is required',
            'last_qualification.required'    =>     'Please upload the last qualification certificate',
            'email.required'                 =>     'Please enter the proper email address',
            'email.unique'                   =>     'This email is already taken',
            'password.required'              =>     'Password is required',
            'roles.required'                 =>     'Role is required'
        ];
    }
}
