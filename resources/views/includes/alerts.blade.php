@if(session('loginError'))
    <div class="alert alert-danger text-center" role="alert">
        {{ session('loginError') }}
    </div>
@endif
