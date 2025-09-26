<x-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8U0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/DataManager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/FlightDetails.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Flights.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SmartChat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SmartDataChat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jordanian-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simplified-flights.css') }}">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success mb-4">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger mb-4">
                        <i class="fas fa-exclamation-circle me-2"></i> Please fix the following errors:
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Create Trip Form -->
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="fas fa-plus me-2"></i> Create New Flight
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('trips.store') }}" id="flightForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Flight Number *</label>
                                    <input type="text" class="form-control @error('flight_number') is-invalid @enderror" name="flight_number" value="{{ old('flight_number') }}" placeholder="e.g., RJ123" required>
                                    @error('flight_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Airline *</label>
                                    <select class="form-select @error('airline_id') is-invalid @enderror" name="airline_id" required>
                                        <option value="">Select Airline</option>
                                        @forelse ($airlines ?? [] as $airline)
                                            <option value="{{ $airline->id }}" {{ old('airline_id') == $airline->id ? 'selected' : '' }}>{{ $airline->name }} ({{ $airline->code }})</option>
                                        @empty
                                            <option value="" disabled>No airlines available</option>
                                        @endforelse
                                    </select>
                                    @error('airline_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Departure City *</label>
                                    <select class="form-select @error('origin') is-invalid @enderror" name="origin" required>
                                        <option value="">Select Departure City</option>
                                        @foreach (['Amman', 'Aqaba', 'Irbid', 'Zarqa', 'Salt', 'Dubai', 'Doha', 'Kuwait', 'Riyadh', 'Cairo', 'Beirut', 'Damascus', 'Baghdad', 'Istanbul', 'Tehran', 'London', 'Paris', 'Frankfurt', 'Rome', 'Vienna', 'Amsterdam', 'Brussels', 'Madrid', 'Athens', 'Zurich'] as $city)
                                            <option {{ old('origin') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    @error('origin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Arrival City *</label>
                                    <select class="form-select @error('destination') is-invalid @enderror" name="destination" required>
                                        <option value="">Select Arrival City</option>
                                        @foreach (['Amman', 'Aqaba', 'Irbid', 'Zarqa', 'Salt', 'Dubai', 'Doha', 'Kuwait', 'Riyadh', 'Cairo', 'Beirut', 'Damascus', 'Baghdad', 'Istanbul', 'Tehran', 'London', 'Paris', 'Frankfurt', 'Rome', 'Vienna', 'Amsterdam', 'Brussels', 'Madrid', 'Athens', 'Zurich'] as $city)
                                            <option {{ old('destination') == $city ? 'selected' : '' }}>{{ $city }}</option>
                                        @endforeach
                                    </select>
                                    @error('destination')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Flight Date *</label>
                                    <input type="date" class="form-control @error('flight_date') is-invalid @enderror" name="flight_date" value="{{ old('flight_date') }}" required>
                                    @error('flight_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Flight Time *</label>
                                    <input type="time" class="form-control @error('flight_time') is-invalid @enderror" name="flight_time" value="{{ old('flight_time') }}" required>
                                    @error('flight_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Price (USD) *</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="e.g., 500" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Aircraft Capacity *</label>
                                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" name="capacity" value="{{ old('capacity') }}" placeholder="e.g., 180" required>
                                    @error('capacity')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Aircraft Type *</label>
                                    <select class="form-select @error('aircraft_type') is-invalid @enderror" name="aircraft_type" required>
                                        <option value="">Select Aircraft Type</option>
                                        @foreach (['Boeing 787', 'Airbus A330', 'Airbus A321', 'Airbus A320', 'Airbus A319', 'Boeing 737', 'Embraer E190'] as $aircraft)
                                            <option {{ old('aircraft_type') == $aircraft ? 'selected' : '' }}>{{ $aircraft }}</option>
                                        @endforeach
                                    </select>
                                    @error('aircraft_type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Flight Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        @foreach (['Available', 'Fully Booked', 'Cancelled', 'Delayed'] as $status)
                                            <option {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('trips.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                                <div>
                                    <button type="button" class="btn btn-info me-2" onclick="generateDemoFlight()">
                                        <i class="fas fa-magic me-2"></i> Generate Demo Flights
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i> Save Flight
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Tips Section -->
                <div class="card mt-4 border-0 bg-light">
                    <div class="card-body">
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-info-circle me-2"></i> Tips for Adding a Successful Flight
                        </h5>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Ensure the flight number is correct and not duplicated
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Choose a departure city different from the arrival city
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Set an appropriate price that matches the distance and service
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                Ensure aircraft availability on the specified date
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function generateDemoFlight() {
            document.querySelector('[name="flight_number"]').value = 'RJ' + Math.floor(100 + Math.random() * 900);
            @if ($airlines && $airlines->isNotEmpty())
                document.querySelector('[name="airline_id"]').value = '{{ $airlines->random()->id }}';
            @else
                document.querySelector('[name="airline_id"]').value = '';
            @endif
            document.querySelector('[name="origin"]').value = 'Amman';
            document.querySelector('[name="destination"]').value = 'Dubai';
            document.querySelector('[name="flight_date"]').value = '2025-10-10';
            document.querySelector('[name="flight_time"]').value = '14:30';
            document.querySelector('[name="price"]').value = 500;
            document.querySelector('[name="capacity"]').value = 180;
            document.querySelector('[name="aircraft_type"]').value = 'Boeing 787';
            document.querySelector('[name="status"]').value = 'Available';
        }
    </script>
</x-layout>