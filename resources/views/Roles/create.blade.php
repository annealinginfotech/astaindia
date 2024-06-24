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
                        New role
                    </h2>
                </div>
                <!-- Page title actions -->

            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <form action="{{route('roles.store')}}" method="post" class="card">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Create new role</h4>
                        </div>
                        <div class="card-body">
                            @include('Roles._fields')
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-auto">Create Role</button>
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
