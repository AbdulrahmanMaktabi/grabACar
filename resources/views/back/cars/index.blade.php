@extends('back.master')

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
                        {{-- @foreach ($cars as $car)
                            @php
                                use App\Models\fuel;
                                use App\Models\Marker;
                                use App\Models\User;

                                $user = User::where('id', $car->owner_id)->get();
                                $marker = Marker::where('id', $car->marker_id)->get();
                                $fuel = Fuel::where('id', $car->fuel_id)->get();
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
                                    <strong>{{ $user->name }}</strong>
                                </td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $marker->name }}</strong>
                                </td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $car->year }}</strong>
                                </td>
                                <td><i class="fab fa-angular fa-lg text-danger me-3"></i>
                                    <strong>{{ $fuel->name }}</strong>
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
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-show-alt me-1"></i>
                                                Show</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}
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
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-show-alt me-1"></i>
                                                Show</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i>
                                                Delete</a>
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
        </div>
    </div>
    <!--/  Table  -->
@endsection
