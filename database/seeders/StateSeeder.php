<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;
use Carbon\Carbon;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::truncate();
        $states =   array(
            array('state' =>  "Andhra Pradesh", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Arunachal Pradesh", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Assam", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Bihar", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Chhattisgarh", 'status'    =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Goa", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Gujarat", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Haryana", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Himachal Pradesh", 'status'    =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Jammu and Kashmir", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Jharkhand", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Karnataka", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Kerala", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Madhya Pradesh", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Maharashtra", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Manipur", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Meghalaya", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Mizoram", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Nagaland", 'status'    =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Odisha", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Punjab", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Rajasthan", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Sikkim", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Tamil Nadu", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Telangana", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Tripura", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Uttarakhand", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Uttar Pradesh", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "West Bengal", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Andaman and Nicobar Islands", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Chandigarh", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Dadra and Nagar Haveli", 'status'  =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Daman and Diu", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Delhi", 'status'   =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Lakshadweep", 'status' =>  'active', 'created_at'    =>  Carbon::now(), 'updated_at' =>  Carbon::now()),
            array('state' =>  "Puducherry", 'status'   =>  'active', 'created_at'   =>  Carbon::now(), 'updated_at' =>  Carbon::now())
        );

        State::insert($states);
    }
}
