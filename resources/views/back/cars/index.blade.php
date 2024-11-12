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
                        @foreach ($cars as $car)
                            @php
                                $user = $car->user; // Assuming you have a relationship set up
                                $marker = $car->marker; // Assuming you have a relationship set up
                                $fuel = $car->fuel; // Assuming you have a relationship set up
                            @endphp
                            @if ($car->deleted_at)
                                <tr style="background-color: #ffd0c6">
                                @else
                                <tr>
                            @endif
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
                                        <a class="dropdown-item" href="{{ route('back.car.show', ['car' => $car]) }}"><i
                                                class="bx bx-show-alt me-1"></i>
                                            Show</a>
                                        <a class="dropdown-item" href="{{ route('back.car.edit', ['car' => $car]) }}"><i
                                                class="bx bx-edit-alt me-1"></i>
                                            Edit</a>
                                        <form action="{{ route('back.car.destroy', ['car' => $car]) }}" method="post"
                                            id="deleteForm-{{ $car->name }}">
                                            @csrf
                                            @method('delete')
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="document.getElementById('deleteForm-{{ $car->name }}').submit();">
                                                <i class="bx bx-trash me-1"></i>
                                                Delete
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
    </div>
    <!--/  Table  -->
@endsection
