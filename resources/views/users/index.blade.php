@extends('layouts')

@section('headerFiles')
<link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/scss/style.css') }}">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                @include('includes.alerts')
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title float-left">List of Users</strong>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered" id="userTable">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d-M-Y') }}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                            <button class="btn btn-danger btn-sm bill-delete-btn" data-token="{{ csrf_token() }}" data-url="{{ route('users.destroy', ['user'=>$user->id]) }}"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
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


<script src="{{ asset('assets/js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/js/lib/data-table/datatables-init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script type="text/javascript">
    $(document).ready(function() {

        $(document).on('click', '.bill-delete-btn', function() {

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        'url'   :   $(this).data('url'),
                        'method' : 'DELETE',
                        'data'  :   {"_token": $(this).data('token')},
                        success: function(resp) {
                            Swal.fire({
                                title: "Deleted!",
                                text: resp.message,
                                icon: "success"
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error: function(resp) {
                            Swal.fire({
                                title: "Opps! Delete Failed.",
                                text: "Please try again later.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });

    });
</script>
@endsection
