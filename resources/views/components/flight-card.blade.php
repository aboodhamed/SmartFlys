<div class="flight-card bg-white rounded-xl p-5 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 hover:border-blue-200" 
     data-id="{{ $id }}" data-airline="{{ $airline }}" data-departure="{{ $departure }}" data-arrival="{{ $arrival }}">
    <div class="flight-header flex justify-between items-start mb-4">
        <div>
            <h5 class="text-lg font-bold text-gray-800">{{ $airline }}</h5>
            <span class="flight-number text-sm text-gray-500">Flight {{ $number }}</span>
        </div>
        <div class="bg-blue-50 text-blue-700 px-2 py-1 rounded-full text-xs font-semibold">
            <i class="fas fa-plane mr-1"></i> Direct
        </div>
    </div>
    
    <div class="flight-route flex justify-between items-center my-5">
        <div class="departure text-center">
            <strong class="block text-gray-800 text-lg">{{ $departure }}</strong>
            <small class="text-gray-500 text-sm">{{ $departureTime }}</small>
        </div>
        <div class="route-arrow text-blue-500 text-xl mx-2">
            <i class="fas fa-long-arrow-alt-right"></i>
        </div>
        <div class="arrival text-center">
            <strong class="block text-gray-800 text-lg">{{ $arrival }}</strong>
            <small class="text-gray-500 text-sm">{{ $arrivalTime }}</small>
        </div>
    </div>
    
    <div class="flight-footer flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
        <div class="price font-bold text-blue-600 text-xl">
            {{ $price }}
        </div>
        <div class="space-x-2">
            <a href="{{ route('trips.show', $id) }}" 
               class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-2 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 shadow-sm hover:shadow-md">
                <i class="fas fa-ticket mr-2"></i> Book Now
            </a>
        </div>
    </div>
</div>