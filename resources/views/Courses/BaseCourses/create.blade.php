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
                        New Base course
                    </h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
        @include('includes.alerts')
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards justify-content-center">
                <div class="col-6">
                    <form action="{{route('base-course.store')}}" method="post" class="card">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Create new Base course</h4>
                        </div>
                        <div class="card-body">
                            @include('Courses.BaseCourses._fields')
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-auto">Create Base course</button>
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
