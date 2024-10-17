@extends('back.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <span class="nav-link active"><i class="bx bx-user me-1"></i> Account</span>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Role Details</h5>
                <!-- Account -->
                <hr class="my-0" />
                <div class="card-body">
                    {{-- <form id="formAccountSettings" method="POST" onsubmit="return false"> --}}
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Role Name</label>
                            <input disabled class="form-control" type="text" id="firstName" name="firstName"
                                value="{{ $role->name }}" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Guard Name</label>
                            <input disabled class="form-control" type="text" id="email" name="email"
                                value="{{ $role->guard_name }}" />
                        </div>
                    </div>
                    {{-- </form> --}}
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
