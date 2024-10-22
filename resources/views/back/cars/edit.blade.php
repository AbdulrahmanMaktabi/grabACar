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

                <form action="{{ route('back.car.update', ['car' => $car]) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Car Name</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $car->name }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Owner</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $user->name }}" />
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Marker</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $marker->name }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Model</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $model->name }}" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Type</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $carType->name }}" />
                            <x-input-error :messages="$errors->get('fuel')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Year</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $car->year }}" name="year" />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />

                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Fuel</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $fuel->name }}" name="fuel_id" />
                            <x-input-error :messages="$errors->get('fuel_id')" class="mt-2" />

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <img src="{{ $car->getFirstMediaUrl('images') }}" alt="{{ $car->name }}"
                                    style="max-width: 180px" name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />

                            </div>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Price</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $car->price }}" name="price" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />

                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">VIN</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $car->vin }}" name="vin" />
                            <x-input-error :messages="$errors->get('vin')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Mileage</label>
                            <input type="text" class="form-control" id="defaultFormControlInput" name="mileage"
                                aria-describedby="defaultFormControlHelp" value="{{ $car->mileage }}" />
                            <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Address</label>
                            <input type="text" class="form-control" id="defaultFormControlInput"
                                aria-describedby="defaultFormControlHelp" value="{{ $car->address }}" name="address" />
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3">{{ $car->description }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="specifications" class="form-label">Specifications</label>
                            <textarea name="car_specifications" id="specifications" class="form-control" rows="3">{{ $car->car_specifications }}</textarea>
                            <x-input-error :messages="$errors->get('car_specifications')" class="mt-2" />
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
