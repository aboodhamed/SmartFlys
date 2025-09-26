<x-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartFly - Your Gateway to the Stars</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-indigo-900 via-blue-800 to-purple-900 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-10 left-10 w-20 h-20 bg-yellow-400 rounded-full opacity-20 animate-pulse"></div>
            <div class="absolute top-40 right-20 w-16 h-16 bg-orange-400 rounded-full opacity-30 animate-bounce"></div>
            <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-blue-400 rounded-full opacity-25 animate-pulse delay-1000"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8 lg:py-28">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 animate-fade-in">
                    Welcome to <span class="text-orange-400">SmartFly</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto animate-fade-in delay-200">
                    Your gateway to interstellar exploration. Book flights to amazing destinations across Jordan and beyond.
                </p>
                <div class="animate-fade-in delay-400">
                    <a href="{{ route('trips.index') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-8 py-4 rounded-full text-lg font-semibold hover:from-orange-600 hover:to-yellow-600 transform hover:scale-105 transition-all duration-300 shadow-2xl">
                        <i class="fas fa-rocket mr-3"></i>
                        Explore All Flights
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <!-- Site Introduction -->
        <section class="mb-16">
            <div class="bg-gradient-to-r from-indigo-900 to-blue-700 rounded-3xl shadow-2xl p-8 sm:p-12 overflow-hidden border-2 border-orange-400/50 relative">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-400/10 to-yellow-400/5 pointer-events-none"></div>
                
                <div class="relative z-10 text-center">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6 flex items-center justify-center space-x-3">
                        <i class="fas fa-globe-americas text-orange-400 text-4xl"></i>
                        <span>About SmartFly</span>
                    </h2>
                    <p class="text-blue-100 text-lg md:text-xl leading-relaxed max-w-4xl mx-auto">
                        SmartFly is Jordan's premier flight booking platform, connecting travelers with the best airlines 
                        and destinations. Whether you're traveling for business or pleasure, we make your journey seamless 
                        and memorable with our easy-to-use booking system and exceptional customer service.
                    </p>
                </div>
            </div>
        </section>

        <!-- Site Statistics -->
        <section class="mb-16">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center flex items-center justify-center space-x-3">
                    <i class="fas fa-chart-line text-orange-400 text-3xl"></i>
                    <span>SmartFly Statistics</span>
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-orange-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-plane-departure text-white text-2xl"></i>
                        </div>
                        <p class="text-4xl font-bold text-gray-800 mb-2">{{ $dailyTrips }}</p>
                        <p class="text-gray-600 font-semibold">Daily Flights</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                        <p class="text-4xl font-bold text-gray-800 mb-2">{{ $airlinesCount }}</p>
                        <p class="text-gray-600 font-semibold">Partner Airlines</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl text-center transform hover:scale-105 transition-transform duration-300">
                        <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                        <p class="text-4xl font-bold text-gray-800 mb-2">{{ $destinationsCount }}</p>
                        <p class="text-gray-600 font-semibold">Destinations</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Featured Trips -->
        <section class="mb-16">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 flex items-center space-x-3">
                        <i class="fas fa-star text-orange-400 text-3xl"></i>
                        <span>Featured Flights</span>
                    </h2>
                    <a href="{{ route('trips.index') }}" 
                       class="inline-flex items-center bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 mt-4 md:mt-0">
                        View All Flights
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                
                @if($featuredTrips->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($featuredTrips as $trip)
                            <x-flight-card
                                :id="$trip->id"
                                :airline="$trip->airline->name"
                                :number="$trip->flight_number"
                                :departure="$trip->origin"
                                :departure-time="\Carbon\Carbon::parse($trip->flight_time)->format('H:i')"
                                :arrival="$trip->destination"
                                :arrival-time="\Carbon\Carbon::parse($trip->flight_time)->addHours(2)->format('H:i')"
                                :price="$trip->price . ' JOD'"
                            />
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-plane-slash text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-xl">No featured flights available at the moment.</p>
                        <a href="{{ route('trips.create') }}" class="inline-flex items-center text-blue-600 hover:text-blue-700 mt-4">
                            <i class="fas fa-plus mr-2"></i>
                            Add New Flight
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Features Section -->
        <section class="mb-16">
            <div class="bg-gradient-to-r from-indigo-900 to-blue-700 rounded-2xl shadow-2xl p-8 text-white">
                <h2 class="text-3xl font-bold text-center mb-12">Why Choose SmartFly?</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-orange-400 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Secure Booking</h3>
                        <p class="text-blue-100">Your transactions are protected with industry-leading security measures.</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-headset text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">24/7 Support</h3>
                        <p class="text-blue-100">Our customer service team is available around the clock to assist you.</p>
                    </div>
                    
                    <div class="text-center">
                        <div class="w-20 h-20 bg-purple-500 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-tag text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-3">Best Prices</h3>
                        <p class="text-blue-100">We guarantee the most competitive prices for all your travel needs.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
        .delay-200 { animation-delay: 0.2s; opacity: 0; }
        .delay-400 { animation-delay: 0.4s; opacity: 0; }
        
        .flight-card {
            transition: all 0.3s ease;
        }
        .flight-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
    </style>

    <script>
        // Simple animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            });

            document.querySelectorAll('section').forEach(section => {
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                section.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(section);
            });
        });
    </script>
</x-layout>