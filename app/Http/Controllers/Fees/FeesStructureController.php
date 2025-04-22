<?php

namespace App\Http\Controllers\Fees;

use DB;
use Log;
use Carbon\Carbon;
use App\Models\Center;
use App\Enums\FeesType;
use App\Models\BaseCourse;
use App\Models\MainCourse;
use Illuminate\Http\Request;
use App\Models\FeesStructure;
use App\Http\Controllers\Controller;

class FeesStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data   =   [
            'title'             =>  'Fees structure',
            'feesStructures'    =>  FeesStructure::monthly()->get()
        ];

        return view('Fees.Structure.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   [
            'title'             =>  'New Fees structure',
            'baseCourses'       =>  BaseCourse::all(),
            'units'             =>  Center::where('type', 'unit')->active()->get()
        ];

        return view('Fees.Structure.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'main_course_id'        =>  'required|exists:main_courses,id',
            'center_id'             =>  'required|exists:centers,id',
            'age_limit'             =>  'required',
            'admission_fees'        =>  'required',
            'monthly_fees'          =>  'required',
            'exam_fees'             =>  'required'
        ]);
        $inputPayload   =   [];

        $admissionPayload   =   [
            'main_course_id'    =>  $request->main_course_id,
            'center_id'         =>  $request->center_id,
            'age_limit'         =>  $request->age_limit,
            'fees_type'         =>  FeesType::ADMISSION,
            'amount'            =>  (double)$request->admission_fees,
            'created_at'        =>  Carbon::now(),
            'updated_at'        =>  Carbon::now()
        ];
        array_push($inputPayload, $admissionPayload);
        $monthlyPayload   =   [
            'main_course_id'    =>  $request->main_course_id,
            'center_id'         =>  $request->center_id,
            'age_limit'         =>  $request->age_limit,
            'fees_type'         =>  FeesType::MONTHLY,
            'amount'            =>  (double)$request->monthly_fees,
            'created_at'        =>  Carbon::now(),
            'updated_at'        =>  Carbon::now()
        ];
        array_push($inputPayload, $monthlyPayload);
        $examPayload   =   [
            'main_course_id'    =>  $request->main_course_id,
            'center_id'         =>  $request->center_id,
            'age_limit'         =>  $request->age_limit,
            'fees_type'         =>  FeesType::EXAM,
            'amount'            =>  (double)$request->exam_fees,
            'created_at'        =>  Carbon::now(),
            'updated_at'        =>  Carbon::now()
        ];
        array_push($inputPayload, $examPayload);

        try {
            FeesStructure::insert($inputPayload);
        } catch (\Throwable $th) {
            Log::channel('feesStructureCreateLog')->info('Error while creating fees strucure. Reason'.$th);
            return $th;
        }

        return redirect()->route('fees-structure.index')->with('success', 'New Fees structure added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editID             =   decrypt($id);

        $feesDetailsRaw     =   FeesStructure::with('mainCourse.baseCourse')->whereMainCourseId($editID)->get();

        $feesDetails            =   collect([
                                        'base_course_name'      =>  $feesDetailsRaw->first()?->mainCourse->baseCourse->name,
                                        'main_course_id'        =>  $feesDetailsRaw->first()->main_course_id,
                                        'main_course_name'      =>  $feesDetailsRaw->first()->mainCourse->name,
                                        'center_id'             =>  $feesDetailsRaw->first()->center_id,
                                        'age_limit'             =>  $feesDetailsRaw->first()->age_limit,
                                        'admission_fees'        =>  $feesDetailsRaw->where('fees_type', FeesType::ADMISSION)->value('amount'),
                                        'monthly_fees'          =>  $feesDetailsRaw->where('fees_type', FeesType::MONTHLY)->value('amount'),
                                        'exam_fees'             =>  $feesDetailsRaw->where('fees_type', FeesType::EXAM)->value('amount'),
                                    ]);

        $data               =   [
                                    'title'         =>  'Edit Fees structure',
                                    'feesDetails'   =>  $feesDetails,
                                    'units'         =>  Center::where('type', 'unit')->active()->get()
                                ];

        return view('Fees.Structure.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'center_id'             =>  'required|exists:centers,id',
            'age_limit'             =>  'required',
            'admission_fees'        =>  'required',
            'monthly_fees'          =>  'required',
            'exam_fees'             =>  'required'
        ]);
        $mainCourseID       =   decrypt($id);

        try {
            DB::beginTransaction();
            FeesStructure::where(['main_course_id'   =>  $mainCourseID, 'fees_type'  =>  FeesType::ADMISSION])->update(['amount' =>  $request->admission_fees, 'center_id'  =>  $request->center_id, 'age_limit'    =>  $request->age_limit]);
            FeesStructure::where(['main_course_id'   =>  $mainCourseID, 'fees_type'  =>  FeesType::MONTHLY])->update(['amount' =>  $request->monthly_fees, 'center_id'  =>  $request->center_id, 'age_limit'    =>  $request->age_limit]);
            FeesStructure::where(['main_course_id'   =>  $mainCourseID, 'fees_type'  =>  FeesType::EXAM])->update(['amount' =>  $request->exam_fees, 'center_id'    =>  $request->center_id, 'age_limit'    =>  $request->age_limit]);
            DB::commit();
        } catch (\Throwable $th) {
            Log::channel('feesStructureUpdateLog')->info('Error while updating fees strucure. Reason'.$th);
            DB::rollback();
            return $th;
        }

        return redirect()->route('fees-structure.index')->with('edited', 'Fees structure updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteID   =   decrypt($id);
        try {
            FeesStructure::where('main_course_id', $deleteID)->delete();
        } catch (\Throwable $th) {
            Log::channel('mainCourseDeleteLog')->info('Error while deletion Fees structure. Reason: '.$th);
            return $th;
        }
        return redirect()->route('fees-structure.index')->with('deleted', 'Fees structure deleted successfully. ');
    }
}
