<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaseCourse;
use Log;

class BaseCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course     =   BaseCourse::all();

        $data       =   [
            'title'         =>  'Base Course',
            'courseData'    =>  $course,
        ];

        return view('Courses.BaseCourses.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data   =   [
            'title'         =>  'Create new Base course'
        ];

        return view('Courses.BaseCourses.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'  =>  'required'
        ]);

        try {
            BaseCourse::create(['name'  =>  $request->name]);
        } catch (\Throwable $th) {
            Log::channel('baseCourseCreateLog')->info('Erorr creation on Base course. Reason:'.$th);
            return $th;
        }

        return redirect()->route('base-course.index')->with('success', $request->name.' is now enrolled as a Base course in A.S.T.A India.');
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
        $editID             =   decrypt($id);
        $baseCourse         =   BaseCourse::findOrFail($editID);
        $data               =   [
            'title'        =>  'Edit Base course',
            'baseCourse'   =>   $baseCourse
        ];

        return view('Courses.BaseCourses.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name'  =>  'required'
        ]);

        $updateID       =   decrypt($id);

        try {
            BaseCourse::findOrFail($updateID)->update(['name'   =>  $request->name]);
        } catch (\Throwable $th) {
            Log::channel('baseCourseUpdateLog')->info('Errow while updating base course. Reason: '.$th);
            return $th;
        }

        return redirect()->route('base-course.index')->with('edited', 'Base course data modified');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteID       =   decrypt($id);

        try {
            BaseCourse::findOrFail($deleteID)->delete();
        } catch (\Throwable $th) {
            Log::channel('baseCourseDeleteLog')->info('Errow while deleting base course. Reason: '.$th);
            return $th;
        }

        return redirect()->route('base-course.index')->with('deleted', 'Base course deleted.');
    }
}
