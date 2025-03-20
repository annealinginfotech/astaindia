<?php

namespace App\Observers;

use DB;
use Log;
use App\Models\Zone;
use App\Models\Center;
use Illuminate\Http\Request;
use App\Models\ControlCenter;

class CenterObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the Center "created" event.
     */
    public function created(Center $center): void
    {
        try {
            $zone               =   Zone::with('parent:id,zone_name,zone_type')->active()->where('zone_type', $center->type)->first();
            $controlCenterID    =   ($this->request->parent_zone) ?? 1;
            $insertPayload      =   [
                'center_id'             =>  $center->id,
                'state_id'              =>  $this->request->state_id,
                'control_type'          =>  $zone->parent->zone_type,
                'control_center_id'     =>  $controlCenterID
            ];
            DB::beginTransaction();
            ControlCenter::create($insertPayload);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::channel('centerCreateLog')->info('Observer error detected. Reason: '.$th.' Zone: ==============> '.$zone.' Data: '.json_encode($insertPayload));
        }
    }

    /**
     * Handle the Center "updated" event.
     */
    public function updated(Center $center): void
    {
        Log::info($center);
        try {
            $zone               =   Zone::with('parent:id,zone_name,zone_type')->active()->where('zone_type', $center->type)->first();
            $controlCenterID    =   ($this->request->parent_zone) ?? 1;
            $updatePayload      =   [
                'state_id'              =>  $this->request->state_id,
                'control_type'          =>  $zone->parent->zone_type,
                'control_center_id'     =>  $controlCenterID
            ];
            DB::beginTransaction();
            $controlCenterInformation   =   ControlCenter::where('center_id', $center->id)->first();
            $controlCenterInformation->update($updatePayload);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::channel('centerCreateLog')->info('Observer error detected. Reason: '.$th.' Zone: ==============> '.$zone.' Data: '.json_encode($insertPayload));
        }
    }

    /**
     * Handle the Center "deleted" event.
     */
    public function deleted(Center $center): void
    {
        //
    }

    /**
     * Handle the Center "restored" event.
     */
    public function restored(Center $center): void
    {
        //
    }

    /**
     * Handle the Center "force deleted" event.
     */
    public function forceDeleted(Center $center): void
    {
        //
    }
}
