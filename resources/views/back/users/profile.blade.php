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
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <hr class="my-0" />
                <div class="card-body">
                    {{-- <form id="formAccountSettings" method="POST" onsubmit="return false"> --}}
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Full Name</label>
                            <input disabled class="form-control" type="text" id="firstName" name="firstName"
                                value="{{ $user->name }}" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input disabled class="form-control" type="text" id="email" name="email"
                                value="{{ $user->email }}" placeholder="john.doe@example.com" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="text" class="form-label">Role</label>
                            <input disabled class="form-control" type="text" id="role" name="role" value="Editor"
                                placeholder="Role" />
                        </div>
                    </div>
                    {{-- </form> --}}
                </div>
                <!-- /Account -->
            </div>
            {{-- @if (isSameUser('web', $user))
                <div class="card">
                    <h5 class="card-header">Delete Account</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.
                                </p>
                            </div>
                        </div>
                        <form id="formAccountDeactivation" method="POST"
                            action="{{ route('front.user.destroy', ['user' => $user]) }}">
                            @method('delete')
                            @csrf
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation"
                                    id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">I confirm my account
                                    deactivation</label>
                                <x-input-error :messages="$errors->get('accountActivation')" class="mt-2" />
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Deactivate Account</button>
                        </form>
                    </div>
                </div>
            @endif --}}
        </div>
    </div>
@endsection
