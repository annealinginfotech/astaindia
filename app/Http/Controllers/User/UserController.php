<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UserCreationRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Log;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data   =   [
            'title' =>  'Users list',
            'users' =>  User::all()
        ];

        return view('Users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   [
            'title' =>  'New user',
            'roles' =>  Role::pluck('name','name')->all()
        ];

        return view('Users.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreationRequest $request)
    {
        try {
            $userLoginPayload   =   [
                'name'                  =>  $request->name,
                'email'                 =>  $request->email,
                'password'              =>  Hash::make($request->password)
            ];

            /* contact details */
            $contactDetailsPayload  =   [
                'address'               =>  $request->address,
                'primary_contact'       =>  $request->primary_contact,
                'secondary_contact'     =>  $request->secondary_contact,
                'whatsapp_number'       =>  $request->whatsapp_number,
                'emergency_contact'     =>  $request->emergency_contact
            ];

            /* profile details */
            $profileDetailsPayload  =   [
                'gender'                =>  $request->gender,
                'martial_status'        =>  $request->martial_status,
                'hobby'                 =>  $request->hobby,
                'related_to_sports'     =>  $request->related_to_sports
            ];

            /* qualification details */
            $qualificationDetailsPayload    =   [
                'qualification'         =>  $request->qualification,
                'skills'                =>  $request->skills
            ];

            /* bank details */
            $bankDetailsPayload =   [
                'bank_name'             =>  $request->bank_name,
                'account_number'        =>  $request->account_number,
                'account_holder_name'   =>  $request->account_holder_name,
                'ifsc_code'             =>  $request->ifsc_code
            ];


            DB::transaction(function() use($request, $userLoginPayload, $profileDetailsPayload, $contactDetailsPayload, $bankDetailsPayload, $qualificationDetailsPayload){
                /* creating the user login */
                $newUser                =   User::create($userLoginPayload);
                $newUser->assignRole($request->roles);

                /* creating profile */
                $newUserProfile         =   $newUser->profile()->create($profileDetailsPayload);
                /* creating contact */
                $newUserContact         =   $newUser->contactDetails()->create($contactDetailsPayload);
                /* qualfication */
                $newUserQualification   =   $newUser->qualifications()->create($qualificationDetailsPayload);
                /* bank details */
                $newUserBankDetails     =   $newUser->bankDetails()->create($bankDetailsPayload);

                /* documents upload */
                $documentsPayload       =   [
                    'identity_proof'        =>  $request->identity_proof->store('management_personel_identity_proof', 'public'),
                    'photo'                 =>  $request->photo->store('management_personel_photo', 'public'),
                    'signature'             =>  $request->signature->store('management_personel_signature','public'),
                    'last_qualification'    =>  $request->last_qualification->store('management_personel_last_qualification_certificate', 'public')
                ];

                $newUserDocuments       =   $newUser->documents()->create($documentsPayload);
            });


        } catch (\Throwable $th) {
            Log::channel('userCreationLog')->info('Error creation on Management personel. Reason: '.$th);
            return $th;
        }

        return redirect()->route('users.index')->with('success', $request->name.' is now a User of A.S.T.A India.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
