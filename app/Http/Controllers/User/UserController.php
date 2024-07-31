<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Enums\UserStatus;
use App\Models\User;
use Carbon\Carbon;
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
                'password'              =>  Hash::make($request->password),
                'added_by'              =>  auth()->user()->id
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
                'father_name'           =>  $request->father_name,
                'gender'                =>  $request->gender,
                'date_of_birth'         =>  Carbon::parse($request->date_of_birth),
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
            return redirect()->route('users.index')->with('error', 'Something went wrong. Please try again later.');
        }

        return redirect()->route('users.index')->with('success', $request->name.' is now a User of A.S.T.A India.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $showID         =   decrypt($id);
        $userDetails    =   User::with(['profile', 'bankDetails', 'documents', 'qualifications', 'contactDetails'])->findOrFail($showID);

        $data           =   [
            'title'         =>  $userDetails->name.' - details',
            'userDetails'   =>  $userDetails
        ];

        return view('Users.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editID         =   decrypt($id);
        $userDetails    =   User::with(['profile', 'bankDetails', 'documents', 'qualifications', 'contactDetails'])->findOrFail($editID);

        $data           =   [
            'title'         =>  $userDetails->name.' - edit',
            'userDetails'   =>  $userDetails,
            'roles'         =>  Role::pluck('name','name')->all()
        ];

        return view('Users.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {
        try {
            $userLoginPayload   =   [
                'name'                  =>  $request->name,
                'email'                 =>  $request->email,
                'added_by'              =>  auth()->user()->id
            ];

            if($request->password) {
                $userLoginPayload['password']   =   Hash::make($request->password);
            }

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
                'father_name'           =>  $request->father_name,
                'gender'                =>  $request->gender,
                'date_of_birth'         =>  Carbon::parse($request->date_of_birth),
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


            DB::transaction(function() use($request, $id, $userLoginPayload, $profileDetailsPayload, $contactDetailsPayload, $bankDetailsPayload, $qualificationDetailsPayload){
                /* creating the user login */
                $updateID                                       =   decrypt($id);
                $user                                           =   User::findOrFail($updateID);
                /* user login */
                $user->update($userLoginPayload);
                DB::table('model_has_roles')->where('model_id',$updateID)->delete();

                $user->assignRole($request->roles);

                /* creating profile */
                $userProfile                                    =   $user->profile->update($profileDetailsPayload);
                /* creating contact */
                $userContact                                    =   $user->contactDetails->update($contactDetailsPayload);
                /* qualfication */
                $userQualification                              =   $user->qualifications->update($qualificationDetailsPayload);
                /* bank details */
                $userBankDetails                                =   $user->bankDetails->update($bankDetailsPayload);

                /* documents upload */
                $documentsPayload       =   [];

                if($request->hasFile('identity_proof')) {
                    $documentsPayload['identity_proof']         =   $request->identity_proof->store('management_personel_identity_proof', 'public');
                }

                if($request->hasFile('photo')) {
                    $documentsPayload['photo']                  =   $request->photo->store('management_personel_photo', 'public');
                }

                if($request->hasFile('signature')) {
                    $documentsPayload['signature']              =   $request->signature->store('management_personel_signature','public');
                }

                if($request->hasFile('last_qualification')) {
                    $documentsPayload['last_qualification']     =   $request->last_qualification->store('management_personel_last_qualification_certificate', 'public');
                }
                if(count($documentsPayload))
                    $userDocuments       =   $user->documents->update($documentsPayload);
            });


        } catch (\Throwable $th) {
            Log::channel('userUpdateLog')->info('Error creation on Management personel. Reason: '.$th);
            return $th;
        }

        return redirect()->route('users.index')->with('edited', 'Data modified successfully for '.$request->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteID   =   decrypt($id);

        try {
            User::findOrFail($deleteID)->delete();
        } catch (\Throwable $th) {
            Log::channel('userCreationLog')->info('Error creation on Management personel. Reason: '.$th);
            return $th;
        }

        return redirect()->route('users.index')->with('deleted', 'User deleted successfully.');
    }

    public function block(Request $request) {
        $blockID    =   decrypt($request->block_id);

        try {
            User::findOrFail($blockID)->update(['status'    =>  UserStatus::BLOCK]);
        } catch (\Throwable $th) {
            Log::channel('userBlockLog')->info('Error block the Management personel. Reason: '.$th);
            return $th;
        }

        return redirect()->back()->with('blocked', 'Blocked successfully');
    }

    public function unblock(Request $request) {
        $blockID    =   decrypt($request->block_id);

        try {
            User::findOrFail($blockID)->update(['status'    =>  UserStatus::ACTIVE]);
        } catch (\Throwable $th) {
            Log::channel('userBlockLog')->info('Error unblock the Management personel. Reason: '.$th);
            return $th;
        }

        return redirect()->back()->with('edited', 'Unblocked successfully');
    }
}
