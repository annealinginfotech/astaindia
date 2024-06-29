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
                        Profile overview
                    </div>
                    <h2 class="page-title">
                        {{ $userDetails->name }}
                    </h2>
                </div>
                <!-- Page title actions -->
            </div>
            @include('includes.alerts')
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ $userDetails->dp }}" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="my-3">{{ $userDetails->name }}</h5>
                            <p class="text-muted mb-1">{{ $userDetails->roles[0]['name'] }}</p>
                            <p class="text-muted mb-4">{{ $userDetails->email }}</p>
                            <div class="d-flex justify-content-center mb-2">
                                <a href="{{ route('users.edit', encrypt($userDetails->id)) }}" data-mdb-button-init
                                    data-mdb-ripple-init class="btn btn-outline-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                    Edit
                                </a>
                                @if ($userDetails->status == 'active')
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#blockConfirmationBox"
                                        data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-danger ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-lock-access">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                            <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                            <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                            <path
                                                d="M8 11m0 1a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-6a1 1 0 0 1 -1 -1z" />
                                            <path d="M10 11v-2a2 2 0 1 1 4 0v2" />
                                        </svg>
                                        Block
                                    </button>
                                @else
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#unblockConfirmationBox"
                                        data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-success ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-lock-open">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 11m0 2a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2z" />
                                            <path d="M12 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                            <path d="M8 11v-5a4 4 0 0 1 8 0" />
                                        </svg>
                                        Unblock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                                <li class="nav-item">
                                    <a href="#tabs-personal-details" class="nav-link active"
                                        data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 9a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2" />
                                            <path d="M4 16v2a2 2 0 0 0 2 2h2" />
                                            <path d="M16 4h2a2 2 0 0 1 2 2v2" />
                                            <path d="M16 20h2a2 2 0 0 0 2 -2v-2" />
                                            <path d="M8 16a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2" />
                                        </svg>
                                        Profile</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-documents-details" class="nav-link"
                                        data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M15 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M18 17h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h4l5 5v7a2 2 0 0 1 -2 2z" />
                                            <path d="M16 17v2a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h2" />
                                        </svg>
                                        Documents</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-qualification-details" class="nav-link"
                                        data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                            <path
                                                d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                            <path d="M5 8h4" />
                                            <path d="M9 16h4" />
                                            <path
                                                d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" />
                                            <path d="M14 9l4 -1" />
                                            <path d="M16 16l3.923 -.98" />
                                        </svg>
                                        Qualification</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tabs-bank-details" class="nav-link"
                                        data-bs-toggle="tab"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 21l18 0" />
                                            <path d="M3 10l18 0" />
                                            <path d="M5 6l7 -3l7 3" />
                                            <path d="M4 10l0 11" />
                                            <path d="M20 10l0 11" />
                                            <path d="M8 14l0 3" />
                                            <path d="M12 14l0 3" />
                                            <path d="M16 14l0 3" />
                                        </svg>
                                        Bank Details</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="tabs-personal-details">
                                    <h4>Personal Details</h4>
                                    <div class="card-body">
                                        <div class="datagrid">
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Full name</div>
                                                <div class="datagrid-content">{{ $userDetails->name }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Gender</div>
                                                <div class="datagrid-content">
                                                    {{ ucfirst(str_replace('_', ' ', $userDetails->profile->gender)) }}
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Martial status</div>
                                                <div class="datagrid-content">
                                                    {{ ucfirst($userDetails->profile->martial_status) }}</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Hobby</div>
                                                <div class="datagrid-content">{{ ucfirst($userDetails->profile->hobby) }}
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Creator</div>
                                                <div class="datagrid-content">
                                                    <div class="d-flex align-items-center">
                                                        {{ $userDetails->added_by_name }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Age</div>
                                                <div class="datagrid-content">{{$userDetails->age}} Years</div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Status</div>
                                                <div class="datagrid-content">
                                                    <span class="status {{ $userDetails->getStatus()['color'] }}">
                                                        {{ $userDetails->getStatus()['status'] }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="datagrid-item">
                                                <div class="datagrid-title">Role</div>
                                                <div class="datagrid-content">
                                                    <span class="status status-green">
                                                        {{ $userDetails->roles[0]['name'] }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-documents-details">
                                    <h4>All documents tab</h4>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-status-start bg-primary"></div>
                                                <div class="card-body">
                                                    <h3 class="card-title">Identity proof</h3>
                                                    <a href="{{ asset('storage/' . $userDetails->documents->identity_proof) }}"
                                                        class="btn btn-azure btn-sm btn-pill" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                            <path d="M11 13l9 -9" />
                                                            <path d="M15 4h5v5" />
                                                        </svg>
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-status-start bg-primary"></div>
                                                <div class="card-body">
                                                    <h3 class="card-title">Photo</h3>
                                                    <a href="{{ asset('storage/' . $userDetails->documents->photo) }}"
                                                        class="btn btn-azure btn-sm btn-pill" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                            <path d="M11 13l9 -9" />
                                                            <path d="M15 4h5v5" />
                                                        </svg>
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-status-start bg-primary"></div>
                                                <div class="card-body">
                                                    <h3 class="card-title">Signature</h3>
                                                    <a href="{{ asset('storage/' . $userDetails->documents->signature) }}"
                                                        class="btn btn-azure btn-sm btn-pill" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                            <path d="M11 13l9 -9" />
                                                            <path d="M15 4h5v5" />
                                                        </svg>
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card">
                                                <div class="card-status-start bg-primary"></div>
                                                <div class="card-body">
                                                    <h3 class="card-title">Last qualification</h3>
                                                    <a href="{{ asset('storage/' . $userDetails->documents->last_qualification) }}"
                                                        class="btn btn-azure btn-sm btn-pill" target="_blank">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-external-link">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" />
                                                            <path d="M11 13l9 -9" />
                                                            <path d="M15 4h5v5" />
                                                        </svg>
                                                        View
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-qualification-details">
                                    <h4>Qualification details</h4>
                                    <div class="datagrid">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Qualification</div>
                                            <div class="datagrid-content">
                                                {{ $userDetails->qualifications->qualification }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Skills</div>
                                            <div class="datagrid-content">{{ $userDetails->qualifications->skills }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-bank-details">
                                    <h4>Bank details</h4>
                                    <div class="datagrid">
                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Bank name</div>
                                            <div class="datagrid-content">{{ $userDetails->bankDetails->bank_name }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Account number</div>
                                            <div class="datagrid-content">{{ $userDetails->bankDetails->account_number }}
                                            </div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">Account holder name</div>
                                            <div class="datagrid-content">
                                                {{ $userDetails->bankDetails->account_holder_name }}</div>
                                        </div>

                                        <div class="datagrid-item">
                                            <div class="datagrid-title">I.F.S.C code</div>
                                            <div class="datagrid-content">{{ $userDetails->bankDetails->ifsc_code }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal modal-blur fade" id="blockConfirmationBox" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-danger"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                        </svg>
                        <h3>Are you sure?</h3>
                        <div class="text-muted">Do you really want to block {{ $userDetails->name }}? What you've done
                            cannot be undone.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a>
                                </div>
                                <div class="col">
                                    <form action="{{ route('users.block') }}" id="confirmationForm" method="post">
                                        <input type="hidden" name="block_id" value="{{ encrypt($userDetails->id) }}" />
                                        @csrf
                                        <button class="btn btn-danger w-100" type="submit">
                                            Block
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal modal-blur fade" id="unblockConfirmationBox" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
                        <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-success icon-lg" width="24"
                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10.24 3.957l-8.422 14.06a1.989 1.989 0 0 0 1.7 2.983h16.845a1.989 1.989 0 0 0 1.7 -2.983l-8.423 -14.06a1.989 1.989 0 0 0 -3.4 0z" />
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                        </svg>
                        <h3>Are you sure?</h3>
                        <div class="text-muted">Do you really want to unblock {{ $userDetails->name }}?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="w-100">
                            <div class="row">
                                <div class="col">
                                    <a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                    </a>
                                </div>
                                <div class="col">
                                    <form action="{{ route('users.unblock') }}" id="unBlockConfirmationForm" method="post">
                                        <input type="hidden" name="block_id" value="{{ encrypt($userDetails->id) }}" />
                                        @csrf
                                        <button class="btn btn-success w-100" type="submit">
                                            Unblock
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('footerFiles')
    @endsection
