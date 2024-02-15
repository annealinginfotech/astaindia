@if(session('loginError'))
    <div class="alert alert-danger text-center" role="alert">
        {{ session('loginError') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('internalError'))
    <div class="alert alert-danger" role="alert">
        <strong>Opps!</strong> {{ session('internalError') }}
    </div>
@endif

