<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Travel Space') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,700|roboto:400,500&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/halls.css'])

    <style>
        *, *:before, *:after {
            box-sizing: border-box;
        }
        #particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }
        .particle {
            position: absolute;
            background: rgba(255, 167, 38, 0.2); /* Orange-400 */
            border-radius: 50%;
            opacity: 0.3;
            animation: float 15s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(100%); opacity: 0.3; }
            50% { opacity: 0.7; }
            100% { transform: translateY(-100%); opacity: 0.3; }
        }
        @media (max-width: 640px) {
            .particle {
                width: 3px !important;
                height: 3px !important;
                animation-duration: 10s !important;
            }
            main {
                padding: 1rem !important;
            }
            footer .text-lg {
                font-size: 1rem;
            }
            footer .text-base {
                font-size: 0.875rem;
            }
            footer .space-y-3 > * + * {
                margin-top: 0.5rem;
            }
        }
        @media (min-width: 641px) and (max-width: 1024px) {
            .particle {
                width: 4px !important;
                height: 4px !important;
                animation-duration: 12s !important;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col bg-gradient-to-r from-indigo-900 to-blue-700">
        <!-- Mobile Menu Backdrop -->
        <div id="mobile-menu-bg" class="fixed inset-0 bg-black bg-opacity-75 z-40 hidden opacity-0 transition-all duration-300"></div>

        <!-- Header (Navbar) -->
        <header class="bg-gradient-to-r from-indigo-900 to-blue-700 shadow-lg sticky top-0 z-50 border-b-2 border-indigo-800">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="focus:outline-none text-white hover:text-orange-400 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- User Section -->
                    <div class="flex items-center">
                        <div class="relative" id="user-menu-container">
                            <button id="user-menu-button" class="flex items-center space-x-2 group">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-900 to-blue-700 flex items-center justify-center text-white font-medium text-sm">
                                    @auth {{ strtoupper(substr(auth()->user()->name, 0, 1)) }} @endauth
                                </div>
                                <span class="text-white font-medium text-sm group-hover:text-orange-400 transition duration-200">
                                    @auth {{ auth()->user()->name }} @endauth
                                </span>
                                <svg class="w-4 h-4 text-orange-400 transition-transform duration-200 transform group-[.dropdown-open]:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="user-menu" class="hidden absolute left-0 mt-2 w-56 bg-gradient-to-r from-indigo-900 to-blue-700 rounded-lg shadow-xl py-2 z-50 border border-indigo-800 transition-all duration-200 origin-top">
                                <a href="/account" class="flex items-center px-4 py-3 text-white hover:bg-indigo-800 transition duration-200 group">
                                    <i class="fas fa-user-circle text-orange-400 group-hover:text-orange-400 transition duration-200"></i>
                                    <span class="ml-3">My Account</span>
                                </a>
                                <a href="/trips/my-trips" class="flex items-center px-4 py-3 text-white hover:bg-indigo-800 transition duration-200 group">
                                    <i class="fas fa-plane text-orange-400 group-hover:text-orange-400 transition duration-200"></i>
                                    <span class="ml-3">My Trips</span>
                                </a>
                                <a href="/reservations" class="flex items-center px-4 py-3 text-white hover:bg-indigo-800 transition duration-200 group">
                                    <i class="fas fa-calendar-check text-orange-400 group-hover:text-orange-400 transition duration-200"></i>
                                    <span class="ml-3">My Reservations</span>
                                </a>
                                <div class="border-t border-indigo-800 my-1"></div>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-white hover:bg-indigo-800 transition duration-200 group">
                                        <i class="fas fa-sign-out-alt text-red-400 group-hover:text-red-300 transition duration-200"></i>
                                        <span class="ml-3">Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Main Navigation (Centered) -->
                    <div class="hidden md:flex flex-1 justify-center items-center space-x-8 mx-8">
                        <x-nav-link href="/home" :active="request()->is('home')">
                            <i class="fas fa-home ml-3 text-orange-400 w-5 text-center"></i>
                            <span class="text-white hover:text-orange-400">Home</span>
                        </x-nav-link>
                        <x-nav-link href="/airlines" :active="request()->is('airlines')">
                            <i class="fas fa-plane ml-3 text-orange-400 w-5 text-center"></i>
                            <span class="text-white hover:text-orange-400">Airlines</span>
                        </x-nav-link>
                        <x-nav-link href="/trips" :active="request()->is('trips')">
                            <i class="fas fa-suitcase ml-3 text-orange-400 w-5 text-center"></i>
                            <span class="text-white hover:text-orange-400">Trips</span>
                        </x-nav-link>
                        <x-nav-link href="/trips/create" :active="request()->is('trips/create')">
                            <i class="fas fa-plus-circle ml-3 text-orange-400 w-5 text-center"></i>
                            <span class="text-white hover:text-orange-400">Add a Trip</span>
                        </x-nav-link>
                
                        <x-nav-link href="/chat" :active="request()->is('chat')">
                            <i class="fas fa-robot ml-3 text-orange-400 w-5 text-center"></i>
                            <span class="text-white hover:text-orange-400">Smart Chat</span>
                        </x-nav-link>
                                <x-nav-link id="data-management-button" :active="request()->is('security*')">
                            <i class="fas fa-database ml-3 text-orange-400 w-5 text-center"></i>
                            <span class="text-white hover:text-orange-400">Security</span>
                            <x-slot name="dropdown">
                                <div id="data-management-dropdown" class="hidden absolute left-0 mt-2 w-56 bg-gradient-to-r from-indigo-900 to-blue-700 rounded-lg shadow-xl py-2 z-50 border border-indigo-800 transition-all duration-200 origin-top">
                                    <a href="/system-module" class="block px-4 py-3 text-sm text-white hover:bg-indigo-800 hover:text-orange-400 transition duration-200 group">
                                        <i class="fas fa-cogs mr-2 text-orange-400 group-hover:text-orange-400"></i>System Module
                                    </a>
                                    <a href="/role-rights" class="block px-4 py-3 text-sm text-white hover:bg-indigo-800 hover:text-orange-400 transition duration-200 group">
                                        <i class="fas fa-user-shield mr-2 text-orange-400 group-hover:text-orange-400"></i>Roles & Permissions
                                    </a>
                                    <a href="/users" class="block px-4 py-3 text-sm text-white hover:bg-indigo-800 hover:text-orange-400 transition duration-200 group">
                                        <i class="fas fa-users mr-2 text-orange-400 group-hover:text-orange-400"></i>Users
                                    </a>
                                </div>
                            </x-slot>
                        </x-nav-link>
                    </div>

                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="/">
                                  <div class="w-14 h-14 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto  shadow-2xl animate-float">
                                   <i class="fas fa-plane-departure text-orange-400 text-3xl"></i>
                                   </div>
                            {{-- <img src="{{ asset('images/Logo.png') }}" alt="Travel Space Logo" class="w-16 h-16 mb-3"> --}}
                        </a>
                          

                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="fixed top-0 left-0 w-72 h-full bg-gradient-to-r from-indigo-900 to-blue-700 text-white shadow-2xl z-50 transform -translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
                    <div class="sticky top-0 bg-indigo-800 flex justify-between items-center p-5 border-b border-indigo-800 z-10">
                        <span class="text-xl font-poppins font-semibold text-orange-400">Main Menu</span>
                        <button id="mobile-menu-close" class="p-1 rounded-full hover:bg-indigo-800 transition duration-200">
                            <svg class="w-6 h-6 text-white hover:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-5 space-y-3">
                        <a href="/home" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-indigo-800 text-white">
                            <i class="fas fa-home ml-3 text-orange-400 w-5 text-center"></i>Home
                        </a>
                        <a href="/airlines" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-indigo-800 text-white">
                            <i class="fas fa-plane ml-3 text-orange-400 w-5 text-center"></i>Airlines
                        </a>
                        <a href="/trips" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-indigo-800 text-white">
                            <i class="fas fa-suitcase ml-3 text-orange-400 w-5 text-center"></i>Trips
                        </a>
                        <a href="/trips/create" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-indigo-800 text-white">
                            <i class="fas fa-plus-circle ml-3 text-orange-400 w-5 text-center"></i>Add a Trip
                        </a>
                     
                        <a href="/chat" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-indigo-800 text-white">
                            <i class="fas fa-robot ml-3 text-orange-400 w-5 text-center"></i>Smart Chat
                        </a>

                           <div class="relative">
                            <button id="mobile-data-management-button" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-indigo-800 text-white w-full">
                                <i class="fas fa-database ml-3 text-orange-400 w-5 text-center"></i>Security
                                <svg class="ml-auto h-4 w-4 text-orange-400 transition-transform duration-200 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="mobile-data-management-dropdown" class="hidden mt-1">
                                <a href="/system-module" class="block py-2 px-4 text-base font-medium rounded-lg transition duration-200 hover:bg-indigo-800 hover:text-orange-400 text-white">System Module</a>
                                <a href="/role-rights" class="block py-2 px-4 text-base font-medium rounded-lg transition duration-200 hover:bg-indigo-800 hover:text-orange-400 text-white">Roles & Permissions</a>
                                <a href="/users" class="block py-2 px-4 text-base font-medium rounded-lg transition duration-200 hover:bg-indigo-800 hover:text-orange-400 text-white">Users</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
  
        <!-- Page Content -->
        <main class="relative flex-grow px-0 sm:px-0 lg:px-0 py-0 bg-[#e2e8f0] overflow-x-hidden">
            <div class="max-w-full sm:max-w-full md:max-w-full lg:max-w-full xl:max-w-full mx-auto w-full box-border break-words whitespace-normal relative z-10 rounded-lg transition-all duration-500 hover:shadow-2xl bg-white text-white">
                <div id="particles"></div>
                {{ $slot }}
            </div>
        </main>
               
        <!-- Footer -->
        <footer class="bg-gradient-to-r from-indigo-900 to-blue-700 text-white pt-12 pb-6 border-t-2 border-indigo-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-poppins font-semibold mb-4 text-orange-400 relative inline-block">
                            Quick Links
                            <span class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-orange-400 rounded-full"></span>
                        </h3>
                        <div class="space-y-3">
                            <a href="/home" class="block text-white hover:text-orange-400 transition duration-200 font-roboto">
                                <i class="fas fa-arrow-right ml-2 text-sm text-orange-400"></i>Home
                            </a>
                            <a href="/airlines" class="block text-white hover:text-orange-400 transition duration-200 font-roboto">
                                <i class="fas fa-arrow-right ml-2 text-sm text-orange-400"></i>Airlines
                            </a>
                            <a href="/trips" class="block text-white hover:text-orange-400 transition duration-200 font-roboto">
                                <i class="fas fa-arrow-right ml-2 text-sm text-orange-400"></i>Trips
                            </a>
                            <a href="/trips/create" class="block text-white hover:text-orange-400 transition duration-200 font-roboto">
                                <i class="fas fa-arrow-right ml-2 text-sm text-orange-400"></i>Add a Trip
                            </a>
                            {{-- <a href="/security" class="block text-white hover:text-orange-400 transition duration-200 font-roboto">
                                <i class="fas fa-arrow-right ml-2 text-sm text-orange-400"></i>Security
                            </a> --}}
                            <a href="/chat" class="block text-white hover:text-orange-400 transition duration-200 font-roboto">
                                <i class="fas fa-arrow-right ml-2 text-sm text-orange-400"></i>Smart Chat
                            </a>
                        </div>
                    </div>

                    <!-- Development Team -->
                    <div>
                        <h3 class="text-lg font-poppins font-semibold mb-4 text-orange-400 relative inline-block">
                            Development Team
                            <span class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-orange-400 rounded-full"></span>
                        </h3>
                        <div class="space-y-3 text-white font-roboto text-base">
                            <div class="flex justify-center items-start">
                                <span class="font-medium text-white min-w-[100px]">Project Manager & Back-end: </span>
                                <span class="text-orange-400 hover:text-orange-400 transition duration-200">Team Member 1</span>
                            </div>
                            <div class="flex justify-center items-start">
                                <span class="font-medium text-white min-w-[100px]">Project Supervisor: </span>
                                <span class="text-orange-400 hover:text-orange-400 transition duration-200">Team Member 2</span>
                            </div>
                            <div class="flex justify-center items-start">
                                <span class="font-medium text-white min-w-[100px]">UI & UX: </span>
                                <span class="text-orange-400 hover:text-orange-400 transition duration-200">Team Member 3</span>
                            </div>
                            <div class="flex justify-center items-start">
                                <span class="font-medium text-white min-w-[100px]">Front-end: </span>
                                <div>
                                    <span class="text-orange-400 hover:text-orange-400 transition duration-200 block">Team Member 4</span>
                                    <span class="text-orange-400 hover:text-orange-400 transition duration-200 block">Team Member 5</span>
                                </div>
                            </div>
                        </div>
                    </div>

            
                    <!-- About Section -->
                    <div>
                        <h3 class="text-lg font-poppins font-semibold mb-4 text-orange-400 relative inline-block">
                            About the Project
                            <span class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 w-12 h-1 bg-orange-400 rounded-full"></span>
                        </h3>
                        <p class="text-white font-roboto text-sm leading-relaxed mb-4">
                            "Travel Space" is an intelligent platform that connects travelers, airlines, and space travel providers, leveraging NASA's open data to facilitate seamless trip planning and reservations for space tourism and exploration.
                        </p>
                        <div class="flex justify-center space-x-4 mt-4">
                            <a href="#" class="text-white hover:text-orange-400 transition duration-200">
                                <i class="fab fa-instagram text-lg text-orange-400"></i>
                            </a>
                            <a href="#" class="text-white hover:text-orange-400 transition duration-200">
                                <i class="fab fa-github text-lg text-orange-400"></i>
                            </a>
                            <a href="#" class="text-white hover:text-orange-400 transition duration-200">
                                <i class="fab fa-youtube text-lg text-orange-400"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="border-t border-indigo-800 mt-8 pt-8 text-center text-white font-roboto text-sm">
                    <p>© 2025 Travel Space - All Rights Reserved</p>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript -->
    <script>
        // Particle Background
        function createParticles() {
            const particleContainer = document.getElementById('particles');
            if (!particleContainer) {
                console.error('Particle container not found!');
                return;
            }
            const particleCount = window.innerWidth < 640 ? 15 : 30;
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const size = Math.random() * 5 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.animationDelay = `${Math.random() * 10}s`;
                particle.style.animationDuration = `${Math.random() * 10 + 5}s`;
                particleContainer.appendChild(particle);
            }
        }

        // Ensure particles are created after the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', () => {
            createParticles();
        });

        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenuClose = document.getElementById('mobile-menu-close');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuBg = document.getElementById('mobile-menu-bg');

        function toggleMobileMenu() {
            mobileMenu.classList.toggle('-translate-x-full');
            mobileMenu.classList.toggle('translate-x-0');
            mobileMenuBg.classList.toggle('hidden');
            mobileMenuBg.classList.toggle('opacity-0');
            mobileMenuBg.classList.toggle('opacity-100');
            document.body.classList.toggle('overflow-hidden');
        }

        mobileMenuButton.addEventListener('click', toggleMobileMenu);
        mobileMenuClose.addEventListener('click', toggleMobileMenu);
        mobileMenuBg.addEventListener('click', toggleMobileMenu);

        // Dropdown Toggle Function
        function setupDropdown(buttonId, dropdownId) {
            const button = document.getElementById(buttonId);
            const dropdown = document.getElementById(dropdownId);
            if (button && dropdown) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    dropdown.classList.toggle('hidden');
                    button.setAttribute('aria-expanded', dropdown.classList.contains('hidden') ? 'false' : 'true');
                });
                window.addEventListener('click', function(event) {
                    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.add('hidden');
                        button.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        }

        // Initialize Dropdowns
        setupDropdown('user-menu-button', 'user-menu');
        setupDropdown('data-management-button', 'data-management-dropdown');
        setupDropdown('mobile-data-management-button', 'mobile-data-management-dropdown');

        // Highlight current page link
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('a[href]');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('text-orange-400', 'bg-indigo-800');
                    link.querySelector('span')?.classList.add('text-orange-400');
                    const underline = link.querySelector('span:last-child');
                    if (underline) underline.classList.add('w-1/2');
                }
            });
        });
    </script>

    @livewireScripts
    @stack('scripts')
</body>
</html>