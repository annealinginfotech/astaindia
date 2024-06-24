@if (session('loginError'))
    <div class="alert alert-danger" style='font-family: "Times New Roman"'>
        <strong>Oops! </strong>{{ session('loginError') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" style='font-family: "Times New Roman"'>
        <strong>Oops! </strong>{{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success" style='font-family: "Times New Roman"'>
        <strong>Congratulations! </strong>{{ session('success') }}
    </div>
@endif

@if (session('edited'))
    <div class="alert alert-info" style='font-family: "Times New Roman"'>
        <strong>Successful! </strong>{{ session('edited') }}
    </div>
@endif

@if (session('deleted'))
    <div class="alert alert-danger" style='font-family: "Times New Roman"'>
        <strong>Done! </strong>{{ session('deleted') }}
    </div>
@endif
