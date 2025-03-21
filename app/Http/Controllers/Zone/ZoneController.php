<?php

namespace App\Http\Controllers\Zone;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ZoneRequest;
use App\Enums\ZoneType;
use App\Models\Zone;
use App\Models\State;
use App\Models\Center;
use Log;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones  =   Zone::all();

        $data   =   [
            'title'     =>  'Zone List',
            'zones'     =>  $zones
        ];

        return view('Zone.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   [
            'title'     =>  'Create zone',
        ];

        return view('Zone.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ZoneRequest $request)
    {
        try {
            $inputFields    =   $request->except('_token');
            $inputFields['parent_zone']    =   (!empty($inputFields['parent_zone'])) ?? 0;
            Zone::create($inputFields);
            return redirect()->route('zone.index')->with('success', $request->name.' is now registed as '.ucfirst($request->type).' on A.S.T.A');
        } catch (\Throwable $th) {
            Log::channel('zoneCreateLog')->info('Error while creating zone. Reason: '.$th);
            return redirect()->route('zone.index')->with('error', 'Something went wrong. Please try again later.');
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

    public function getParentZone($type, $state = null) {
        $zone   =   Zone::with('parent:id,zone_name,zone_type')->active()->where('zone_type', $type)->first();
        if($zone->parent->zone_type == ZoneType::STATE) {
            $states                 =   Center::active()->where('type', ZoneType::STATE)->get(['id', 'name AS zone_name']);
            return response()->json(['zones'    =>  $states]);
        } else if($zone->parent->zone_type == ZoneType::DISTRICT) {
            $availableDistrict  =   Center::active()->where('state_id', $state)->where('type', ZoneType::DISTRICT)->get(['id', 'code', 'name AS zone_name']);
            return response()->json(['zones'    =>  $availableDistrict]);
        } else if($zone->parent->zone_type  ==  ZoneType::BRANCH) {
            $availableBranch    =   Center::active()->where('state_id', $state)->where('type', ZoneType::BRANCH)->get(['id', 'code', 'name AS zone_name']);
            return response()->json(['zones'    =>  $availableBranch]);
        }
        return response()->json(['zones'    =>  $zone->parent]);
    }
}
