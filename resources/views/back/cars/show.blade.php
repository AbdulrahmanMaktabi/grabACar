@extends('back.master')
@php
    $user = $car->user; // Assuming you have a relationship set up
    $marker = $car->marker; // Assuming you have a relationship set up
    $fuel = $car->fuel; // Assuming you have a relationship set up
    $model = $car->model; // Assuming you have a relationship set up
    $carType = $car->carType; // Assuming you have a relationship set up
@endphp
@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">{{ $car->name }}</h5>
            <div class="card-body">


                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Car Name</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $car->name }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Owner</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $user->name }}" />
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Marker</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $marker->name }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Model</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $model->name }}" />
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Type</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $carType->name }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Year</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $car->year }}" />
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Fuel</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $fuel->name }}" />
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <img src="{{ $car->getFirstMediaUrl('images') }}" alt="{{ $car->name }}"
                                style="max-width: 180px">
                        </div>
                    </div>
                </div>

                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Price</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $car->price }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">VIN</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $car->vin }}" />
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Mileage</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $car->mileage }}" />
                    </div>
                    <div class="col-md-6">
                        <label for="defaultFormControlInput" class="form-label">Address</label>
                        <input disabled type="text" class="form-control" id="defaultFormControlInput"
                            aria-describedby="defaultFormControlHelp" value="{{ $car->address }}" />
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description</label>
                        <textarea disabled name="description" id="description" class="form-control" rows="3">{{ $car->description }}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="specifications" class="form-label">Specifications</label>
                        <textarea disabled name="car_specifications" id="specifications" class="form-control" rows="3">{{ $car->car_specifications }}</textarea>
                    </div>
                </div>
                <!-- Rest of the form -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>


@endsection
