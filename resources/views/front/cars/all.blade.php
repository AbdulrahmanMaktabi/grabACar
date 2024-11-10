@extends('front.master')

@section('content')
    <!-- Table  -->
    <div class="card">
        <h5 class="card-header" style="font-size: 21px">Cars Table</h5>
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
                                    <strong>{{ $user->name ?? 'N/A' }}</strong> <!-- Use null coalescing operator -->
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
                                        @if (isAddedToFavorite(Auth::guard('web')->user(), $car))
                                            <div class="dropdown-menu">
                                                <form action="{{ route('front.favoriteDelete') }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ Auth::guard('web')->id() }}">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="this.closest('form').submit()">
                                                        <i class="bx bx-x me-1"></i> Unfavorite
                                                    </a>
                                                </form>

                                            </div>
                                        @else
                                            <div class="dropdown-menu">
                                                <form action="{{ route('front.favoriteStore') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="car_id" value="{{ $car->id }}">
                                                    <input type="hidden" name="user_id"
                                                        value="{{ Auth::guard('web')->id() }}">
                                                    <a class="dropdown-item" href="javascript:void(0)"
                                                        onclick="this.closest('form').submit()">
                                                        <i class="bx bx-heart me-1"></i> Favorite
                                                    </a>
                                                </form>

                                            </div>
                                        @endif

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
    </div>
    @if (session('favourit_message'))
        <div class="alert alert-success alert-dismissible" role="alert"
            style="position: fixed; top: 100px; right: 136px; width: fit-content;">
            {{ session('favourit_message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('favourit_existing'))
        <div class="alert alert-primary alert-dismissible" role="alert"
            style="position: fixed; top: 100px; right: 136px; width: fit-content;">
            {{ session('favourit_existing') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('favourit_delete'))
        <div class="alert alert-danger alert-dismissible" role="alert"
            style="position: fixed; top: 100px; right: 136px; width: fit-content;">
            {{ session('favourit_delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <!--/  Table  -->
@endsection
