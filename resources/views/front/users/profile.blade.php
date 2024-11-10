@extends('front.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <span class="nav-link active"><i class="bx bx-user me-1"></i> Account</span>
                </li>
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">User Details</h5>
                <!-- Account -->
                <hr class="my-0" />
                <div class="card-body">
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
                        @if (count($user->getRoleNames('web')) > 0)
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Role</label>
                                <input disabled class="form-control" type="text" id="role" name="role"
                                    value="{{ $user->getRoleNames('web')->first() }}" placeholder="Role" />
                            </div>
                        @endif

                    </div>
                    {{-- </form> --}}
                    <div class="row mt-5" style="max-width:140px;">
                        <a href="{{ route('front.user.edit', ['user' => Auth::guard('web')->user()]) }}"
                            class="btn btn-primary">Edit</a>
                    </div>
                </div>
                <!-- /Account -->
            </div>
            <div class="card mb-4">
                <h5 class="card-header">Faveroite Cars</h5>
                <!-- Account -->
                <hr class="my-0" />
                <div class="card-body">
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
                        @if (count($user->getRoleNames('web')) > 0)
                            <div class="mb-3 col-md-6">
                                <label for="text" class="form-label">Role</label>
                                <input disabled class="form-control" type="text" id="role" name="role"
                                    value="{{ $user->getRoleNames('web')->first() }}" placeholder="Role" />
                            </div>
                        @endif

                    </div>
                    {{-- </form> --}}
                    <div class="row mt-5" style="max-width:140px;">
                        <a href="{{ route('front.user.edit', ['user' => Auth::guard('web')->user()]) }}"
                            class="btn btn-primary">Edit</a>
                    </div>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
