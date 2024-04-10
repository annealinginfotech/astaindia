<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
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
        $allUsers   =   User::get();
        $this->addBreadcrumb('Dashboard', '/', '');
        $this->addBreadcrumb('All Users', '#', 'active');

        $data   =   [
            'title'         =>  'All Users',
            'breadCrumbs'   =>  $this->breadcrumbs,
            'users'         =>  $allUsers
        ];

        return view('users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->addBreadcrumb('Dashboard', '/', '');
        $this->addBreadcrumb('Create new user', '#', 'active');

        $data   =   [
            'title'             =>  'New user',
            'breadCrumbs'       =>  $this->breadcrumbs,
        ];

        return view('users.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|string|email|max:255|unique:users,email',
            'password'  =>  'required|min:8'
        ]);

        $inputFields                =   $request->except('_token');

        $inputFields['password']    =   Hash::make($inputFields['password']);

        try {
            DB::transaction(function() use($inputFields) {
                User::create($inputFields);
            });
        } catch (\Throwable $th) {
            Log::channel('userOperationLog')->info('Error during user related operation. Error: '.$th);
        }

        return redirect()->route('users.index')->with('success', 'Account created successfully for '.$request->name);
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
        $user   =   User::where('id', '=', $id)->firstOrFail();

        if($user) {
            $this->addBreadcrumb('Dashboard', '/', '');
            $this->addBreadcrumb('All users', route('users.index'), '');
            $this->addBreadcrumb('Create new user', '#', 'active');

            $data   =   [
                'title'         =>  'Edit user',
                'breadCrumbs'   =>  $this->breadcrumbs,
                'user'          =>  $user
            ];

            return view('users.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'      =>  'required',
            'email'     =>  'required|string|email|max:255|unique:users,email,'.$id,
            'password'  =>  'nullable|min:8'
        ]);

        $user   =   User::where('id', '=', $id)->firstOrFail();

        if($user) {
            $updatingFields =   $request->except('_token');

            if(!empty($updatingFields['password'])){
                $updatingFields['password']  =   Hash::make($updatingFields['password']);
            }else{
                $updatingFields = Arr::except($updatingFields,array('password'));
            }

            DB::transaction(function() use($user, $updatingFields) {
                $user->update($updatingFields);
            });

            return redirect()->route('users.index')->with('success','User updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user   =   User::where('id', '=', $id)->firstOrFail();
        if($user) {
            try {
                DB::transaction(function() use($user) {
                    $user->delete();
                });
            } catch (\Throwable $th) {
                Log::channel('userOperationLog')->debug('Error while deleting user '.$id.' Cause: '.$th->getMessage());
                return response()->json([
                    'message'    => 'Unable to delete the user. Please try again.'
                ],500);
            }
            return response()->json([
                'message'    => 'User is deleted.'
            ],200);
        }

    }
}
