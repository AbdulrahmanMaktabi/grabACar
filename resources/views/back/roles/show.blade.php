@extends('back.master')
@php
    use App\Models\Admin;
@endphp
@section('content')
    <div class="row">
        <div class="col-md-12">

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
                @if (count($role->permissions) > 0)
                    {{-- role permissions --}}
                    <h5 class="card-header">Permissions</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        {{-- <form id="formAccountSettings" method="POST" onsubmit="return false"> --}}
                        <div class="row">
                            <!-- List group Flush (Without main border) -->
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group list-group-flush">
                                        @foreach ($role->permissions as $permission)
                                            <span class="list-group-item list-group-item-action">
                                                {{ $loop->iteration }} {{ $permission->name }}
                                            </span>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!--/ List group Flush (Without main border) -->
                        </div>
                        {{-- </form> --}}
                    </div>
                    {{-- // role permissions // --}}
                @endif

                @if (checkIfRoleUsed($role->name, $role->guard_name))
                    {{-- users who use the role --}}
                    <h5 class="card-header">Who Use This Role?</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                        {{-- <form id="formAccountSettings" method="POST" onsubmit="return false"> --}}
                        <div class="row">
                            <!-- List group Flush (Without main border) -->
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group list-group-flush">
                                        @foreach (getUsersByRole($role->name, $role->guard_name) as $admin)
                                            <span class="list-group-item list-group-item-action">
                                                <i class='bx bx-user mx-2'></i>{{ $admin->name }}</span>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <!--/ List group Flush (Without main border) -->
                        </div>
                        {{-- </form> --}}
                    </div>
                    {{-- // users who use the role// --}}
                @endif
            </div>
        </div>
    </div>
@endsection
