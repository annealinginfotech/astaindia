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
                        New Fees structure
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
            <div class="row row-cards">
                <div class="col-12">
                    <form action="{{route('fees-structure.store')}}" method="post" class="card">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Create new Fees structure</h4>
                        </div>
                        <div class="card-body">
                            @include('Fees.Structure._fields')
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon me-2 icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerFiles')
    <script>
        $('#base_course').on('change', function(){
            var base_course_id =   $(this).val();
            var contextURL =   "{{ route('base-course.get-main-courses', ':id') }}";
            contextURL =   contextURL.replace(':id', base_course_id);
            $('#fetchingMainCourseLoader').toggleClass("d-none");
            $.ajax({
                type    :   'GET',
                url     :   contextURL,
                success :   function(resp) {
                    $('#fetchingMainCourseLoader').toggleClass("d-none");
                    $('#main_course').html('');
                    $('#main_course').append('<option value="" selected disabled>-- Choose Main course --</option>');
                    $.each(resp.data, function() {
                        $('#main_course').append('<option value="'+this.id+'">'+this.name+'</option>');
                    });
                }
            });
        });
    </script>
@endsection
