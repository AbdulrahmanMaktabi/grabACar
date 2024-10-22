@extends('front.master')

@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Edit User</h5>
            <div class="card-body">
                <form action="{{ route('front.user.update', ['user' => $user]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="John Doe"
                                aria-describedby="defaultFormControlHelp" name="name" value="{{ $user->name }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Email</label>
                            <input type="email" class="form-control" id="defaultFormControlInput"
                                placeholder="JohnDoe@admin.com" aria-describedby="defaultFormControlHelp" name="email"
                                value="{{ $user->email }}" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Password</label>
                            <input type="password" class="form-control" id="defaultFormControlInput" placeholder="******"
                                aria-describedby="defaultFormControlHelp" name="password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="defaultFormControlInput" placeholder="******"
                                aria-describedby="defaultFormControlHelp" name="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <div class="row my-5">
                        <div class="col-md-4">
                            <input type="submit" value="Edit" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
