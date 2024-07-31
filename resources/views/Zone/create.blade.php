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
                        New Zone
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
                <div class="col-md-12">
                    <form action="{{route('zone.store')}}" method="post" class="card">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Create new Zone</h4>
                        </div>
                        <div class="card-body">
                            @include('Zone._fields')
                        </div>
                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="#" class="btn btn-link">Cancel</a>
                                <button type="submit" class="btn btn-primary ms-auto">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
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
        $('#type').on('change', function() {
            var selectedType    =   $(this).val();

            if(selectedType != 'headquarters') {
                $('#parent_zone_section').css('opacity', 0).slideDown('slow').animate({ opacity: 1 },{ queue: false, duration: 'slow' });
                var fetchUrl    =   "{{route('zone.get-parent', ['id'   =>  ':id'])}}";
                fetchUrl        =   fetchUrl.replace(':id', selectedType);
                $.ajax({
                    type    :   'GET',
                    url     :   fetchUrl,
                    success :   function(resp) {
                        console.log(resp);
                    }
                });
            } else {
                $('#parent_zone_section').css('opacity', 0).slideUp('slow').animate({ opacity: 1 },{ queue: false, duration: 'slow' });
            }
        });
    </script>
@endsection
