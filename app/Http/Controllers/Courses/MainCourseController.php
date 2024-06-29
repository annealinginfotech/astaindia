<?php

namespace App\Http\Controllers\Courses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaseCourse;
use App\Models\MainCourse;
use Log;

class MainCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course     =   MainCourse::all();

        $data       =   [
            'title'         =>  'Main Course',
            'courseData'    =>  $course,
        ];

        return view('Courses.MainCourses.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data       =   [
            'title'         =>  'Create new Main course',
            'baseCourses'   =>  BaseCourse::all()
        ];

        return view('Courses.MainCourses.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'base_course_id'    =>  'required|exists:base_courses,id',
            'name'              =>  'required',
            'course_code'       =>  'required|unique:main_courses,course_code',
            'min_qualification' =>  'required'
        ]);

        try {
            MainCourse::create($request->only(['base_course_id', 'name', 'course_code', 'min_qualification']));
        } catch (\Throwable $th) {
            Log::channel('mainCourseCreateLog')->info('Error in creation Main course. Reason: '.$th);
            return $th;
        }

        return redirect()->route('main-course.index')->with('success', $request->name.' is now enrolled as a Main course in A.S.T.A India');
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
        $mainCourse         =   MainCourse::findOrFail($editID);
        $baseCourses        =   BaseCourse::all();

        $data               =   [
            'title'         =>  'Edit Base course',
            'baseCourses'   =>   $baseCourses,
            'mainCourse'    =>  $mainCourse
        ];

        return view('Courses.MainCourses.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updateID       =   decrypt($id);
        $this->validate($request, [
            'base_course_id'    =>  'required|exists:base_courses,id',
            'name'              =>  'required',
            'course_code'       =>  'required|unique:main_courses,course_code,'.$updateID,
            'min_qualification' =>  'required'
        ]);

        try {
            MainCourse::findOrFail($updateID)->update($request->only(['base_course_id', 'name', 'course_code', 'min_qualification']));
        } catch (\Throwable $th) {
            Log::channel('mainCourseUpdateLog')->info('Error in creation Main course. Reason: '.$th);
            return $th;
        }

        return redirect()->route('main-course.index')->with('edited', 'Data modified successfully for '.$request->name);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteID   =   decrypt($id);
        try {
            MainCourse::findOrFail($deleteID)->delete();
        } catch (\Throwable $th) {
            Log::channel('mainCourseDeleteLog')->info('Error while deletion Main course. Reason: '.$th);
            return $th;
        }
        return redirect()->route('main-course.index')->with('deleted', 'Main Course deleted successfully. ');
    }
}
