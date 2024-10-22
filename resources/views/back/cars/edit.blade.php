@extends('back.master')

@section('content')
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Update Car</h5>
            <div class="card-body">
                <form action="{{ route('back.car.update', ['car' => $car]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Car Name</label>
                            <input type="text" class="form-control" id="defaultFormControlInput" placeholder="BMW x5"
                                aria-describedby="defaultFormControlHelp" name="name" value="{{ $car->name }}" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlSelect1" class="form-label">Owner</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                                name="owner_id">
                                <option></option>
                                @foreach ($users as $user)
                                    <option {{ $car->owner_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('owner_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="markerSelect" class="form-label">Marker</label>
                            <select class="form-select" id="markerSelect" aria-label="Default select example"
                                name="marker_id">
                                <option></option>
                                @foreach ($markers as $marker)
                                    <option {{ $car->marker_id == $marker->id ? 'selected' : '' }}
                                        value="{{ $marker->id }}">
                                        {{ $marker->name }}</option>
                                @endforeach
                            </select>
                            @error('marker_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="modelSelect" class="form-label">Models</label>
                            <select class="form-select" id="modelSelect" aria-label="Default select example"
                                name="model_id">
                                <option></option>
                                <!-- Models will be populated dynamically -->
                            </select>
                            @error('model_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="exampleFormControlSelect1" class="form-label">Type</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                                name="carType_id">
                                <option></option>
                                @foreach ($carTypes as $type)
                                    <option {{ $car->carType_id == $type->id ? 'selected' : '' }}
                                        value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            @error('carType_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="defaultFormControlInput" class="form-label">Year</label>
                            <input type="number" class="form-control" id="defaultFormControlInput" placeholder="2012"
                                aria-describedby="defaultFormControlHelp" name="year" value="{{ $car->year }}" />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="exampleFormControlSelect1" class="form-label">Fuel</label>
                            <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example"
                                name="fuel_id">
                                <option></option>
                                @foreach ($fuels as $fuel)
                                    <option {{ $car->fuel_id == $fuel->id ? 'selected' : '' }}
                                        value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                @endforeach
                            </select>
                            @error('fuel_id')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Image</label>
                                <input class="form-control" type="file" id="formFile" name="image" />
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" placeholder="900 $"
                                aria-describedby="defaultFormControlHelp" name="price" value="{{ $car->price }}" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="vin" class="form-label">Vin</label>
                            <input type="number" class="form-control" id="vin" placeholder="938874584884"
                                aria-describedby="defaultFormControlHelp" name="vin" value="{{ $car->vin }}" />
                            <x-input-error :messages="$errors->get('vin')" class="mt-2" />
                        </div>
                    </div>
                    <div class="row my-4">
                        <div class="col-md-6">
                            <label for="mileage" class="form-label">Mileage</label>
                            <input type="number" class="form-control" id="mileage" placeholder="60000 km"
                                aria-describedby="defaultFormControlHelp" name="mileage" value="{{ $car->mileage }}" />
                            <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3">{{ $car->address }}</textarea>
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
                            <input type="submit" value="Create" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add JavaScript to handle marker selection and fetch models -->
    <script>
        document.getElementById('markerSelect').addEventListener('change', function() {
            var markerId = this.value;
            var modelSelect = document.getElementById('modelSelect');
            var selectedModelId = "{{ $car->model_id ?? null }}"; // Pass the selected model ID

            // Clear previous models
            modelSelect.innerHTML = '<option></option>';

            if (markerId) {
                // Fetch models based on the selected marker
                fetch(`/get-models/${markerId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function(model) {
                            var option = document.createElement('option');
                            option.value = model.id;
                            option.text = model.name;

                            // Check if model.id matches the selectedModelId
                            if (model.id == selectedModelId) {
                                option.selected = true; // Mark the option as selected
                            }

                            modelSelect.add(option);
                        });
                    })
                    .catch(error => console.error('Error fetching models:', error));
            }
        });

        // Trigger the change event if marker is pre-selected (to load models if a marker is already selected)
        document.getElementById('markerSelect').dispatchEvent(new Event('change'));
    </script>

@endsection
