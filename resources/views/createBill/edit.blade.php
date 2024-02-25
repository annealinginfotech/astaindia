@extends('layouts')

@section('headerFiles')
<link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
<link rel="stylesheet" href="{{ asset('assets/scss/style.css') }}">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                @include('includes.alerts')
                <div class="card">
                    <div class="card-body card-block">
                        <form name="create-bill" method="POST" action="{{ route('billing.update', ['billing'    => $billInformation->id]) }}">
                            @method('PATCH')
                            @csrf
                            @include('createBill._fields')
                        </form>
                    </div>
                    {{-- <div class="card-footer">

                    </div> --}}
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

@section('footerFiles')
<script src="{{ asset('assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
@endsection
