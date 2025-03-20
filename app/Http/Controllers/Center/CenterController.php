<?php

namespace App\Http\Controllers\Center;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\Zone;
use App\Models\State;
use App\Models\Center;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CenterCreationRequest;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data   =   [
            'title'     =>  'Centers',
            'centers'   =>  Center::get()
        ];

        return view('Centers.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   [
            'title'     =>  'Create zone',
            'states'    =>  State::active()->get(),
            'zones'     =>  Zone::active()->get()
        ];

        return view('Centers.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CenterCreationRequest $request)
    {
        $inputPayload                   =   $request->except('_token');
        $inputPayload['parent_zone']    =   ($inputPayload['parent_zone']) ?? 1;

        try {
            DB::beginTransaction();
            Center::create($inputPayload);
            DB::commit();
            return redirect()->route('zones.centers.index')->with('success', $request->name.' is now registed as '.ucfirst($request->type).' on A.S.T.A');
        } catch (\Throwable $th) {
            return $th;
            DB::rollback();
            Log::channel('centerCreateLog')->info('Error while creating center. Reason: '.$th);
            return redirect()->route('zones.centers.index')->with('error', 'Something went wrong. Please try again later.');
        }
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
        $centerID           =   decrypt($id);

        $centerInformation  =   Center::with('controlCenter.parentZone')->where('id', $centerID)->first();

        $data               =   [
                                    'title'     =>  'Edit zone',
                                    'states'    =>  State::active()->get(),
                                    'zones'     =>  Zone::active()->get(),
                                    'centerInformation' =>  $centerInformation
                                ];
        return view('Centers.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $centerID                       =   decrypt($id);
            $updatePayload                  =   $request->except('_token', '_method');
            $updatePayload['parent_zone']   =   ($updatePayload['parent_zone']) ?? 1;

            DB::beginTransaction();
            $centerInformation              =   Center::with('controlCenter.parentZone')->where('id', $centerID)->first();
            if($centerInformation) {
                $centerInformation->update($updatePayload);

                // Force an update if only control_center_id is changed
                if ($centerInformation->controlCenter->parentZone->id != $updatePayload['parent_zone']) {
                    $centerInformation->touch(); // Updates timestamps
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::channel('centerEditLog')->info('Error while updating center information. Reason: '.$th);
            return redirect()->route('zones.centers.index')->with('error', 'Something went wrong. Please try again later.');
        }

        return redirect()->route('zones.centers.index')->with('edited', 'Data of '.$request->name.' is modified.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $centerID   =   decrypt($id);
            DB::beginTransaction();
            $centerData =   Center::where('id', $centerID)->first();
            $centerName =   $centerData->name;
            $centerData->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::channel('centerDeleteLog')->info('Error while deleting center. Reason: '.$th);
            return redirect()->route('zones.centers.index')->with('error', 'Something went wrong. Please try again later.');
        }

        return redirect()->route('zones.centers.index')->with('deleted', 'Center '.$centerName.' is deleted.');
    }
}
