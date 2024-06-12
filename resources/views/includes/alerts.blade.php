@if (session('loginError'))
    <div class="alert alert-danger" style='font-family: "Times New Roman"'>
        <strong>Oops! </strong>{{ session('loginError') }}
    </div>
@endif
