<x-layout>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Flight Details - {{ $trip->flight_number }}</title>
<!-- Tailwind CSS -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="min-h-screen bg-gradient-to-br from-blue-50 to-gray-100">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-8 shadow-lg">
        <div class="container mx-auto px-4 max-w-7xl">
            <a href="{{ route('trips.index') }}" class="inline-flex items-center text-blue-100 hover:text-white mb-4 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Back to Flights
            </a>
            <h1 class="text-3xl font-bold">Flight Details: {{ $trip->flight_number }}</h1>
            <p class="text-blue-100 mt-2">{{ $trip->airline->name }} • {{ $trip->origin }} → {{ $trip->destination }}</p>
        </div>
    </div>

    <!-- Content -->
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Flight Details -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <!-- Flight Route -->
                    <div class="flex items-center justify-between mb-8">
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $trip->origin }}</h3>
                            <p class="text-lg text-gray-600 mt-1">{{ \Carbon\Carbon::parse($trip->flight_time)->format('H:i') }}</p>
                            <small class="text-gray-500">{{ \Carbon\Carbon::parse($trip->flight_date)->format('M d, Y') }}</small>
                        </div>
                        
                        <div class="flex flex-col items-center mx-4">
                            <div class="text-blue-500 text-2xl mb-2">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="text-center">
                                <small class="text-gray-500 block">Duration</small>
                                <strong class="text-gray-700">2h 30m</strong>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <h3 class="text-2xl font-bold text-gray-800">{{ $trip->destination }}</h3>
                            <p class="text-lg text-gray-600 mt-1">{{ \Carbon\Carbon::parse($trip->flight_time)->addHours(2)->format('H:i') }}</p>
                            <small class="text-gray-500">{{ \Carbon\Carbon::parse($trip->flight_date)->format('M d, Y') }}</small>
                        </div>
                    </div>

                    <!-- Flight Information Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-building text-blue-500 text-xl mr-3"></i>
                            <div>
                                <strong class="text-gray-700">Airline</strong>
                                <p class="text-gray-600">{{ $trip->airline->name }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-plane text-blue-500 text-xl mr-3"></i>
                            <div>
                                <strong class="text-gray-700">Flight Number</strong>
                                <p class="text-gray-600">{{ $trip->flight_number }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-chair text-blue-500 text-xl mr-3"></i>
                            <div>
                                <strong class="text-gray-700">Aircraft Type</strong>
                                <p class="text-gray-600">{{ $trip->aircraft_type }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-users text-blue-500 text-xl mr-3"></i>
                            <div>
                                <strong class="text-gray-700">Available Seats</strong>
                                <p class="text-gray-600">{{ $trip->capacity }} seats</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-suitcase text-blue-500 text-xl mr-3"></i>
                            <div>
                                <strong class="text-gray-700">Baggage</strong>
                                <p class="text-gray-600">23 kg included</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                            <i class="fas fa-utensils text-blue-500 text-xl mr-3"></i>
                            <div>
                                <strong class="text-gray-700">Meals</strong>
                                <p class="text-gray-600">Complimentary meal</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 sticky top-4">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Book This Flight</h3>
                        <div class="text-right">
                            <span class="text-2xl font-bold text-blue-600">{{ $trip->price }}</span>
                            <span class="text-gray-600">JOD</span>
                        </div>
                    </div>

                    <form id="bookingForm" method="POST">
                        @csrf
                        <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                        <!-- Passenger Information -->
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-700 mb-3">Passenger Information</h4>
                            <div class="space-y-3">
                                <div class="grid grid-cols-2 gap-3">
                                    <input type="text" name="first_name" placeholder="First Name" 
                                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <input type="text" name="last_name" placeholder="Last Name" 
                                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                </div>
                                <input type="email" name="email" placeholder="Email" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <input type="tel" name="phone" placeholder="Phone Number" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <input type="text" name="passport_number" placeholder="Passport Number" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <input type="date" name="date_of_birth" 
                                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                            </div>
                        </div>

                        <!-- Seat Selection -->
                        <div class="mb-6">
                            <h4 class="text-lg font-semibold text-gray-700 mb-3">Seat Selection</h4>
                            <select name="seat" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                <option value="">Select a Seat</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}A">{{ $i }}A</option>
                                    <option value="{{ $i }}B">{{ $i }}B</option>
                                    <option value="{{ $i }}C">{{ $i }}C</option>
                                @endfor
                            </select>
                            <p class="text-sm text-gray-500 mt-2">Seat availability will be confirmed</p>
                        </div>

                        <!-- Booking Summary -->
                        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                            <h4 class="text-lg font-semibold text-gray-700 mb-3">Booking Summary</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Passenger:</span>
                                    <span id="summaryPassenger" class="font-medium">-</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Seat:</span>
                                    <span id="summarySeat" class="font-medium">-</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Base Price:</span>
                                    <span>{{ $trip->price }} JOD</span>
                                </div>
                                <div class="flex justify-between text-green-600">
                                    <span>Discount (10%):</span>
                                    <span>-{{ number_format($trip->price * 0.1, 2) }} JOD</span>
                                </div>
                                <div class="flex justify-between border-t border-gray-200 pt-2 font-semibold">
                                    <span>Total:</span>
                                    <span>{{ number_format($trip->price * 0.9, 2) }} JOD</span>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-md">
                            <i class="fas fa-ticket-alt mr-2"></i>Confirm Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookingForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Update summary in real-time
    function updateSummary() {
        const firstName = document.querySelector('input[name="first_name"]').value.trim();
        const lastName = document.querySelector('input[name="last_name"]').value.trim();
        const seat = document.querySelector('select[name="seat"]').value;
        
        document.getElementById('summaryPassenger').textContent = 
            firstName && lastName ? `${firstName} ${lastName}` : '-';
        document.getElementById('summarySeat').textContent = seat || '-';
    }

    // Add event listeners for form changes
    form.querySelectorAll('input, select').forEach(element => {
        element.addEventListener('input', updateSummary);
        element.addEventListener('change', updateSummary);
    });

    // Handle form submission
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Basic validation
        const requiredFields = form.querySelectorAll('[required]');
        let allValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                allValid = false;
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        });

        if (!allValid) {
            alert('Please fill in all required fields.');
            return;
        }

        // Disable button and show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Booking...';
        submitBtn.disabled = true;

        try {
            const formData = new FormData(form);
            
            const response = await fetch('{{ route("trips.book") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (data.success) {
                alert(data.message);
                window.location.href = data.redirect;
            } else {
                alert('Booking failed: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while booking. Please try again.');
        } finally {
            // Restore button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });

    // Initial summary update
    updateSummary();
});
</script>
</x-layout>