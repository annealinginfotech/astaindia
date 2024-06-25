@extends('layout.app')
@section('headerFiles')

@endsection
@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        New Users
                    </h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

                <form class="card" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('Users._fields')
                </form>
        </div>
    </div>
@endsection

@section('footerFiles')

@endsection
