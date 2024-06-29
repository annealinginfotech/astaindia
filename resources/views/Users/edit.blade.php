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
                        Edit
                    </div>
                    <h2 class="page-title">
                        {{$userDetails->name}}
                    </h2>
                </div>
                <!-- Page title actions -->
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">

                <form class="card" action="{{route('users.update', encrypt($userDetails->id))}}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    @include('Users._fields')
                </form>
        </div>
    </div>
@endsection

@section('footerFiles')

@endsection
