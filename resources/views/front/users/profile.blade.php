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
            @if (isset($cars) && count($cars) > 0)
                <div class="card mb-4">
                    <h5 class="card-header">Faveroite Cars</h5>
                    <!-- Cars -->
                    <hr class="my-0" />
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="font-size: 16px">Name</th>
                                    <th style="font-size: 16px">Image</th>
                                    <th style="font-size: 16px">Owner</th>
                                    <th style="font-size: 16px">Marker</th>
                                    <th style="font-size: 16px">Year</th>
                                    <th style="font-size: 16px">Fuel</th>
                                    <th style="font-size: 16px">Price</th>
                                    <th style="font-size: 16px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @if (isset($cars))
                                    @foreach ($cars as $car)
                                        @php
                                            $user = $car->user; // Assuming you have a relationship set up
                                            $marker = $car->marker; // Assuming you have a relationship set up
                                            $fuel = $car->fuel; // Assuming you have a relationship set up
                                        @endphp
                                        <tr>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $car->name }}</strong>
                                            </td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <img src="{{ $car->getFirstMediaUrl('images') }}" alt="{{ $car->name }}"
                                                    style="max-width: 180px">
                                            </td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $user->name ?? 'N/A' }}</strong>
                                                <!-- Use null coalescing operator -->
                                            </td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $marker->name ?? 'N/A' }}</strong>
                                            </td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $car->year }}</strong>
                                            </td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $fuel->name ?? 'N/A' }}</strong>
                                            </td>
                                            <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                                <strong>{{ $car->price }}</strong>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <form action="{{ route('front.favoriteDelete') }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <input type="hidden" name="car_id"
                                                                value="{{ $car->id }}">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ Auth::guard('web')->id() }}">
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                onclick="this.closest('form').submit()">
                                                                <i class="bx bx-x me-1"></i> Unfavorite
                                                            </a>
                                                        </form>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>
                                            <h3 class="text-danger" style="padding-top: 10px">No Car Recordes!</h3>
                                        </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                        <div class="container mt-4">
                            {{ $cars->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                    <!-- /Cars -->
                </div>
            @endif

        </div>
    </div>

    @if (session('favourit_delete'))
        <div class="alert alert-danger alert-dismissible" role="alert"
            style="position: fixed; top: 100px; right: 136px; width: fit-content;">
            {{ session('favourit_delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection
