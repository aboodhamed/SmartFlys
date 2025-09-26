<x-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/DataManager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/FlightDetails.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Flights.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SmartChat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SmartDataChat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jordanian-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simplified-flights.css') }}">

    <div class="container py-5">
        <!-- Header -->
        {{-- <div class="row mb-5">
            <div class="col-12 text-center">
                <h1 class="display-5 fw-bold mb-3">
                    <span class="title-inline">
                        <i class="fas fa-plane text-warning"></i>
                        <span>Jordanian Airlines</span>
                    </span>
                </h1>
                <p class="lead text-muted">
                    Discover leading Jordanian airlines partnering with SmartFly
                </p>
            </div>
        </div> --}}

                <!-- Introduction -->
        <div class="intro mb-8 text-center bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-8 px-6 rounded-2xl shadow-lg">
                 <h1 class="display-5 fw-bold mb-3">
                    <span class="title-inline">
                        <i class="fas fa-plane text-warning"></i>
                        <span>Jordanian Airlines</span>
                    </span>
                </h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Discover leading Jordanian airlines partnering with SmartFly</p>
        </div>


        <!-- Airline Cards -->
        <div class="row g-4">
            @forelse ($airlines ?? [] as $airline)
                <div class="col-lg-6 col-xl-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="{{ $airline->flag_url ?? 'https://flagcdn.com/jo.svg' }}" alt="{{ $airline->name }} flag" class="me-3 flag-icon" style="width: 40px; height: 24px;">
                                <div>
                                    <h4 class="mb-1">{{ $airline->name }}</h4>
                                    <small class="text-muted">{{ $airline->short_name ?? $airline->name }}</small>
                                    <span class="badge bg-{{ $airline->badge_color ?? 'primary' }}">{{ $airline->code ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <p class="text-muted">{{ $airline->description ?? 'A leading Jordanian airline.' }}</p>
                            <div class="row text-center my-3">
                                <div class="col-6">
                                    <small class="text-muted">Founded</small>
                                    <div class="fw-bold">{{ $airline->founded ?? 'N/A' }}</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Headquarters</small>
                                    <div class="fw-bold">{{ $airline->headquarters ?? 'Amman, Jordan' }}</div>
                                </div>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Fleet</small>
                                    <div class="fw-bold">{{ $airline->fleet_size ? $airline->fleet_size . ' aircraft' : 'N/A' }}</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Destinations</small>
                                    <div class="fw-bold">{{ $airline->destinations ?? 'N/A' }}</div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="{{ $airline->website ?? route('airlines.show', $airline->id) }}" 
                                   class="btn btn-custom" 
                                   {{ $airline->website ? 'target="_blank"' : '' }}>
                                    <i class="fas fa-external-link-alt me-2"></i> 
                                    {{ $airline->website ? 'Official Website' : 'View Details' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Fallback Static Data -->
                <div class="col-lg-6 col-xl-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://flagcdn.com/jo.svg" alt="Jordan flag" class="me-3 flag-icon" style="width: 40px; height: 24px;">
                                <div>
                                    <h4 class="mb-1">Royal Jordanian Airlines</h4>
                                    <small class="text-muted">Royal Jordanian</small>
                                    <span class="badge bg-primary">RJ</span>
                                </div>
                            </div>
                            <p class="text-muted">The national carrier of the Hashemite Kingdom of Jordan</p>
                            <div class="row text-center my-3">
                                <div class="col-6">
                                    <small class="text-muted">Founded</small>
                                    <div class="fw-bold">1963</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Headquarters</small>
                                    <div class="fw-bold">Amman, Jordan</div>
                                </div>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Fleet</small>
                                    <div class="fw-bold">26 aircraft</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Destinations</small>
                                    <div class="fw-bold">40+ destinations</div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="https://www.rj.com" target="_blank" class="btn btn-custom">
                                    <i class="fas fa-external-link-alt me-2"></i> Official Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://flagcdn.com/jo.svg" alt="Jordan flag" class="me-3 flag-icon" style="width: 40px; height: 24px;">
                                <div>
                                    <h4 class="mb-1">Jordan Aviation</h4>
                                    <small class="text-muted">Jordan Aviation</small>
                                    <span class="badge bg-success">R5</span>
                                </div>
                            </div>
                            <p class="text-muted">A private Jordanian airline specialized in scheduled and charter flights</p>
                            <div class="row text-center my-3">
                                <div class="col-6">
                                    <small class="text-muted">Founded</small>
                                    <div class="fw-bold">1998</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Headquarters</small>
                                    <div class="fw-bold">Amman, Jordan</div>
                                </div>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Fleet</small>
                                    <div class="fw-bold">12 aircraft</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Destinations</small>
                                    <div class="fw-bold">25+ destinations</div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="https://www.jordanaviation.jo" target="_blank" class="btn btn-custom">
                                    <i class="fas fa-external-link-alt me-2"></i> Official Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://flagcdn.com/jo.svg" alt="Jordan flag" class="me-3 flag-icon" style="width: 40px; height: 24px;">
                                <div>
                                    <h4 class="mb-1">Arab Wings</h4>
                                    <small class="text-muted">Arab Wings</small>
                                    <span class="badge bg-warning">AW</span>
                                </div>
                            </div>
                            <p class="text-muted">A Jordanian airline offering domestic and regional services</p>
                            <div class="row text-center my-3">
                                <div class="col-6">
                                    <small class="text-muted">Founded</small>
                                    <div class="fw-bold">1975</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Headquarters</small>
                                    <div class="fw-bold">Amman, Jordan</div>
                                </div>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Fleet</small>
                                    <div class="fw-bold">8 aircraft</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Destinations</small>
                                    <div class="fw-bold">15+ destinations</div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="https://www.arabwings.com.jo" target="_blank" class="btn btn-custom">
                                    <i class="fas fa-external-link-alt me-2"></i> Official Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://flagcdn.com/jo.svg" alt="Jordan flag" class="me-3 flag-icon" style="width: 40px; height: 24px;">
                                <div>
                                    <h4 class="mb-1">Jazeera Airways Jordan</h4>
                                    <small class="text-muted">Jazeera Airways Jordan</small>
                                    <span class="badge bg-info">J9</span>
                                </div>
                            </div>
                            <p class="text-muted">Jordanian branch of the Kuwaiti Jazeera Airways</p>
                            <div class="row text-center my-3">
                                <div class="col-6">
                                    <small class="text-muted">Founded</small>
                                    <div class="fw-bold">2019</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Headquarters</small>
                                    <div class="fw-bold">Amman, Jordan</div>
                                </div>
                            </div>
                            <div class="row text-center mb-3">
                                <div class="col-6">
                                    <small class="text-muted">Fleet</small>
                                    <div class="fw-bold">6 aircraft</div>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted">Destinations</small>
                                    <div class="fw-bold">12+ destinations</div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <a href="https://www.jazeeraairways.com" target="_blank" class="btn btn-custom">
                                    <i class="fas fa-external-link-alt me-2"></i> Official Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Why Choose SmartFly Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-white shadow-sm p-5 rounded text-center">
                    <h3 class="mb-4">
                        <i class="fas fa-star me-2 text-warning"></i> Why choose SmartFly?
                    </h3>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <i class="fas fa-shield-alt mb-3 fs-2 text-primary"></i>
                            <h5>Safety and Reliability</h5>
                            <p class="text-muted">Our partnerships with top Jordanian airlines ensure safe and reliable journeys</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <i class="fas fa-tags mb-3 fs-2 text-success"></i>
                            <h5>Best Prices</h5>
                            <p class="text-muted">We bring you the best deals and fares from all Jordanian airlines</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <i class="fas fa-headset mb-3 fs-2 text-info"></i>
                            <h5>24/7 Support</h5>
                            <p class="text-muted">Our support team is available around the clock to assist you anytime</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</x-layout>