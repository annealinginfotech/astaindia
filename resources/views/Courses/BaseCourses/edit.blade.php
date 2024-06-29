@extends('layout.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Wizard
                    </div>
                    <h2 class="page-title">
                        Edit Base course
                    </h2>
                </div>
                <!-- Page title actions -->

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards justify-content-center">
                <div class="col-6">
                    <form action="{{route('base-course.update', encrypt($baseCourse->id))}}" method="post" class="card">
                        @method('PATCH')
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Update Base course</h4>
                        </div>
                        <div class="card-body">
                            @include('Courses.BaseCourses._fields')
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-auto">Update Base course</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerFiles')
@endsection
