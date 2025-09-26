<x-layout>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Flights - Travel Space</title>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8U0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100">
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg shadow-sm mb-6" role="alert">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-500"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                    <button type="button" class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        @endif

        <!-- Introduction -->
        <div class="intro mb-8 text-center bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-8 px-6 rounded-2xl shadow-lg">
            <h1 class="text-4xl font-bold mb-3">Jordanian Flights Booking</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Search your preferred flight, choose an airline, and select your destination easily and quickly.</p>
        </div>

        <!-- Airline Selector -->
        <div class="airline-selector bg-white rounded-xl p-6 shadow-sm mb-6 border border-gray-100" id="airlineSelector">
            <div class="selector-header mb-6">
                <h5 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-building mr-3 text-blue-500"></i> Jordanian Airlines
                </h5>
                <p class="text-gray-600 mt-2">Select an airline to view its flights only</p>
            </div>
            <div class="airlines-grid">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                    <button class="airline-card w-full bg-gradient-to-br from-blue-50 to-blue-100 border-2 border-blue-200 rounded-xl p-5 transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col items-center selected" data-airline="">
                        <div class="airline-icon mb-3 text-blue-500">
                            <i class="fas fa-globe text-2xl"></i>
                        </div>
                        <div class="airline-name font-bold text-gray-800">All Airlines</div>
                        <div class="flight-count text-sm text-blue-600 font-medium mt-1" id="count-total">{{ count($trips) }} flights</div>
                    </button>
                    @forelse ($airlines as $airline)
                        <button class="airline-card w-full bg-gray-50 border-2 border-gray-200 rounded-xl p-5 transition-all duration-300 hover:shadow-lg hover:scale-[1.02] flex flex-col items-center" data-airline="{{ $airline->id }}">
                            <div class="airline-icon mb-3 text-gray-600">
                                <i class="fas fa-plane text-2xl"></i>
                            </div>
                            <div class="airline-name font-bold text-gray-800">{{ $airline->name }}</div>
                            <div class="flight-count text-sm text-gray-500 mt-1" data-count-for="{{ $airline->id }}">
                                {{ $trips->where('airline_id', $airline->id)->count() }} flights
                            </div>
                        </button>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-4">
                            No airlines available.
                        </div>
                    @endforelse
                </div>
            </div>
            <div id="selectedAirlineInfo" class="selected-airline-info mt-4 bg-blue-50 rounded-lg p-3 border-l-4 border-blue-500 text-sm text-blue-700 hidden">
                <i class="fas fa-filter mr-2"></i> Showing flights for <strong id="selectedAirlineName">—</strong> only
            </div>
        </div>

        <!-- Simplified Filters -->
        <form id="filterForm" action="{{ route('trips.index') }}" method="GET" class="simplified-filters bg-white rounded-xl p-6 shadow-sm mb-6 border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5 items-end">
                <div>
                    <label for="airline" class="block text-sm font-semibold text-gray-700 mb-2">Airline</label>
                    <select id="airline" name="airline" class="form-select w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        <option value="">All Airlines</option>
                        @foreach ($airlines as $airline)
                            <option value="{{ $airline->id }}" {{ request('airline') == $airline->id ? 'selected' : '' }}>{{ $airline->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="origin" class="block text-sm font-semibold text-gray-700 mb-2">From</label>
                    <input type="text" id="origin" name="origin" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" value="{{ request('origin') }}" placeholder="Enter departure city">
                </div>
                <div>
                    <label for="destination" class="block text-sm font-semibold text-gray-700 mb-2">To</label>
                    <input type="text" id="destination" name="destination" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors" value="{{ request('destination') }}" placeholder="Enter arrival city">
                </div>
                <div class="space-y-3">
                    <button type="submit" class="btn w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-search mr-2"></i> Apply Filters
                    </button>
                    <button type="button" id="clearFilters" class="btn w-full bg-gray-100 text-gray-700 p-3 rounded-lg border border-gray-300 hover:bg-gray-200 transition-all duration-300">
                        <i class="fas fa-times mr-2"></i> Clear Filters
                    </button>
                </div>
            </div>
        </form>

        <!-- Flights Results -->
        <div id="flightsResults" class="flights-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @if ($trips->isEmpty())
                <div class="no-flights text-center p-8 bg-white rounded-xl shadow-sm border border-gray-100 col-span-full">
                    <i class="fas fa-plane-slash text-blue-500 text-5xl mb-4"></i>
                    <h4 class="text-xl font-bold text-gray-800 mb-2">No Flights Found</h4>
                    <p class="text-gray-600 mb-6">No flights match your search criteria. Try adjusting the filters or adding new flights.</p>
                    <a href="{{ route('trips.create') }}" class="btn inline-block bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-md hover:shadow-lg">
                        <i class="fas fa-plus mr-2"></i> Add New Flight
                    </a>
                </div>
            @else
                @foreach ($trips as $trip)
                    <x-flight-card
                        :id="$trip->id"
                        :airline="$trip->airline->name"
                        :number="$trip->flight_number"
                        :departure="$trip->origin"
                        :departure-time="$trip->flight_time"
                        :arrival="$trip->destination"
                        :arrival-time="$trip->flight_time"
                        :price="$trip->price . ' JOD'"
                        :details="'Flight ' . $trip->status . ', Aircraft Type: ' . $trip->aircraft_type . ', Capacity: ' . $trip->capacity"
                    />
                @endforeach
            @endif
        </div>
    </div>

    <!-- Modal Overlay and Content -->
    <div class="modal-overlay fixed top-0 left-0 w-full h-full bg-black bg-opacity-60 backdrop-blur-sm z-50 hidden" id="modalOverlay"></div>
    <div class="modal-content fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white p-6 rounded-2xl shadow-xl z-50 hidden max-w-md w-11/12" id="modalContent">
        <h3 id="modalTitle" class="text-xl font-bold text-gray-800 mb-4">Flight Details</h3>
        <p id="modalDetails" class="text-gray-600"></p>
        <button class="btn w-full bg-gray-100 text-gray-800 p-3 rounded-lg mt-6 hover:bg-gray-200 transition-colors duration-300" onclick="closeModal()">Close</button>
    </div>
</div>

<script>
    // CSRF token for POST requests
    window.csrfToken = "{{ csrf_token() }}";

    // Airline selection
    document.getElementById('airlineSelector').addEventListener('click', (e) => {
        const btn = e.target.closest('.airline-card');
        if (!btn) return;
        
        // Remove selected styles from all cards
        document.querySelectorAll('.airline-card').forEach(b => {
            b.classList.remove('selected', 'bg-gradient-to-br', 'from-blue-50', 'to-blue-100', 'border-blue-200');
            b.classList.add('bg-gray-50', 'border-gray-200');
            
            // Reset icon and text colors
            const icon = b.querySelector('.airline-icon');
            const name = b.querySelector('.airline-name');
            const count = b.querySelector('.flight-count');
            
            if (icon) icon.classList.remove('text-blue-500');
            if (name) name.classList.remove('text-blue-700');
            if (count) count.classList.remove('text-blue-600');
        });
        
        // Add selected styles to clicked card
        btn.classList.remove('bg-gray-50', 'border-gray-200');
        btn.classList.add('selected', 'bg-gradient-to-br', 'from-blue-50', 'to-blue-100', 'border-blue-200');
        
        // Update icon and text colors for selected card
        const icon = btn.querySelector('.airline-icon');
        const name = btn.querySelector('.airline-name');
        const count = btn.querySelector('.flight-count');
        
        if (icon) icon.classList.add('text-blue-500');
        if (name) name.classList.add('text-blue-700');
        if (count) count.classList.add('text-blue-600');
        
        const airlineId = btn.getAttribute('data-airline');
        document.getElementById('airline').value = airlineId;
        document.getElementById('filterForm').submit();
    });

    // Clear filters
    document.getElementById('clearFilters').addEventListener('click', () => {
        document.getElementById('airline').value = '';
        document.getElementById('origin').value = '';
        document.getElementById('destination').value = '';
        document.getElementById('filterForm').submit();
    });

    // Modal handling
    function openModal(title, details) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDetails').textContent = details;
        document.getElementById('modalOverlay').classList.remove('hidden');
        document.getElementById('modalContent').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('modalOverlay').classList.add('hidden');
        document.getElementById('modalContent').classList.add('hidden');
    }

    document.getElementById('modalOverlay').addEventListener('click', closeModal);

    // Booking function
    document.querySelectorAll('.book-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const tripId = e.target.closest('.flight-card').getAttribute('data-id');
            fetch('{{ route("trips.book") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken
                },
                body: JSON.stringify({ trip_id: tripId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Flight booked successfully!');
                    window.location.reload();
                } else {
                    alert('Booking error: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => alert('Booking error: ' + error.message));
        });
    });

    // Details function
    document.querySelectorAll('.details-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const details = e.target.closest('.flight-card').getAttribute('data-details');
            openModal('Flight Details', details);
        });
    });
</script>
</x-layout>