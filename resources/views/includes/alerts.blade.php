@if (session('loginError'))
    <div class="alert alert-danger" style='color: black'>
        <strong>Oops! </strong>{{ session('loginError') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" style='color: black'>
        <strong>Oops! </strong>{{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" style='color: black'>
        <strong>Congratulations! </strong>{{ session('success') }}
    </div>
@endif

@if (session('edited'))
    <div class="alert alert-info" style='color: black'>
        <strong>Modified! </strong>{{ session('edited') }}
    </div>
@endif

@if (session('deleted'))
    <div class="alert alert-danger" style='color: black'>
        <strong>Done! </strong>{{ session('deleted') }}
    </div>
@endif

@if (session('blocked'))
    <div class="alert alert-danger" style='color: black'>
        <strong>Done! </strong>{{ session('blocked') }}
    </div>
@endif
