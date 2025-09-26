<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>{{ config('app.name', 'Education Space') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,700|roboto:400,500&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>


        /* Global Box Sizing */
        *, *:before, *:after {
            box-sizing: border-box;
        }

        /* Particle Background */
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
            background: rgba(131, 51, 166, 0.5);
            border-radius: 50%;
            opacity: 0.3;
            animation: float 15s infinite linear;
        }
        @keyframes float {
            0% { transform: translateY(100%); opacity: 0.3; }
            50% { opacity: 0.7; }
            100% { transform: translateY(-100%); opacity: 0.3; }
        }

        /* Responsive Adjustments */
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
    <div class="min-h-screen flex flex-col">
        <!-- Mobile Menu Backdrop -->
        <div id="mobile-menu-bg" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden opacity-0 transition-all duration-300"></div>

        <!-- Header (Navbar) -->
        <header class="bg-gray-900 shadow-lg sticky top-0 z-50 border-b-2 border-[#8333A6]">
            <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button id="mobile-menu-button" class="focus:outline-none text-white hover:text-[#8333A6] transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            </svg>
                        </button>
                    </div>
                     
                    <!-- User Section -->
                    <div class="flex items-center">
                        <div class="relative" id="user-menu-container">
                            <button id="user-menu-button" class="flex items-center space-x-reverse space-x-2 group">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-[#8333A6] to-[#8333A6] flex items-center justify-center text-white font-medium text-sm">
                                 @auth   {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}  @endauth
                                </div>
                                <span class="text-white font-medium text-sm group-hover:text-[#8333A6] transition duration-200">
                                  @auth  {{ auth()->user()->name }}   @endauth
                                </span>
                                <svg class="w-4 h-4 text-[#8333A6] transition-transform duration-200 transform group-[.dropdown-open]:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="user-menu" class="hidden absolute right-0 mt-2 w-56 bg-gray-900 rounded-lg shadow-xl py-2 z-50 border border-gray-700 transition-all duration-200 origin-top">
                                <a href="/account" class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 transition duration-200 group">
                                    <i class="fas fa-user-circle text-[#8333A6] group-hover:text-[#8333A6] transition duration-200"></i>
                                     <span class="ml-3">حسابي</span>
                                </a>
                                <a href="/my-lectures" class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 transition duration-200 group">
                                    <i class="fas fa-chalkboard-teacher text-[#8333A6] group-hover:text-[#8333A6] transition duration-200"></i>
                                     <span class="ml-3">محاضراتي</span>
                                </a>
                                <a href="/my-attended-lectures" class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 transition duration-200 group">
                                    <i class="fas fa-users text-[#8333A6] group-hover:text-[#8333A6] transition duration-200"></i>
                                     <span class="ml-3">محاضرات حضرتها</span>
                                </a>
                                <a href="/my-courses" class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 transition duration-200 group">
                                    <i class="fas fa-graduation-cap text-[#8333A6] group-hover:text-[#8333A6] transition duration-200"></i>
                                     <span class="ml-3">دوراتي</span>
                                </a>
                                <a href="/my-halls" class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 transition duration-200 group">
                                    <i class="fas fa-door-open text-[#8333A6] group-hover:text-[#8333A6] transition duration-200"></i>
                                     <span class="ml-3">قاعتي</span>
                                </a>
                                <a href="/my-reservations" class="flex items-center px-4 py-3 text-gray-200 hover:bg-gray-700 transition duration-200 group">
                                    <i class="fas fa-calendar-check text-[#8333A6] group-hover:text-[#8333A6] transition duration-200"></i>
                                     <span class="ml-3">حجوزاتي</span>
                                </a>
                                <div class="border-t border-gray-700 my-1"></div>
                                <form method="POST" action="/logout">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-gray-200 hover:bg-gray-700 transition duration-200 group">
                                        <i class="fas fa-sign-out-alt text-red-400 group-hover:text-red-300 transition duration-200"></i>
                                         <span class="ml-3">تسجيل الخروج</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Main Navigation (Centered) -->
                    <div class="hidden md:flex flex-1 justify-center items-center space-x-8 space-x-reverse mx-8">
                        <x-nav-link href="/home" :active="request()->is('home')">
                            <i class="fas fa-home mr-3 text-[#8333A6] w-5 text-center"></i>الرئيسية
                        </x-nav-link>
                        <x-nav-link href="/all-halls" :active="request()->is('all-halls')">
                            <i class="fas fa-door-open mr-3 text-[#8333A6] w-5 text-center"></i>قاعات
                        </x-nav-link>
                        <x-nav-link href="/trainers" :active="request()->is('trainers')">
                            <i class="fas fa-chalkboard-teacher mr-3 text-[#8333A6] w-5 text-center"></i>المدربين
                        </x-nav-link>
                        <x-nav-link href="/lectures" :active="request()->is('lectures')">
                            <i class="fas fa-book mr-3 text-[#8333A6] w-5 text-center"></i>المحاضرات
                        </x-nav-link>
                        <x-nav-link href="/courses" :active="request()->is('courses')">
                            <i class="fas fa-graduation-cap mr-3 text-[#8333A6] w-5 text-center"></i>الدورات
                        </x-nav-link>
                        <x-nav-link id="security-button" :active="request()->is('security*')">
                            <i class="fas fa-shield-alt mr-3 text-[#8333A6] w-5 text-center"></i>الأمان
                            <x-slot name="dropdown">
                                <div id="security-dropdown" class="hidden absolute right-0 mt-2 w-56 bg-gray-900 rounded-lg shadow-xl py-2 z-50 border border-gray-700 transition-all duration-200 origin-top">
                                    <a href="/system-module" class="block px-4 py-3 text-sm text-gray-200 hover:bg-gray-700 hover:text-[#8333A6] transition duration-200 group rounded-t-lg text-right">
                                        <i class="fas fa-cogs ml-2 text-[#8333A6] group-hover:text-[#8333A6]"></i>وحدة النظام
                                    </a>
                                    <a href="/role-rights" class="block px-4 py-3 text-sm text-gray-200 hover:bg-gray-700 hover:text-[#8333A6] transition duration-200 group text-right">
                                        <i class="fas fa-user-shield ml-2 text-[#8333A6] group-hover:text-[#8333A6]"></i>الأدوار والصلاحيات
                                    </a>
                                    <a href="/users" class="block px-4 py-3 text-sm text-gray-200 hover:bg-gray-700 hover:text-[#8333A6] transition duration-200 group rounded-b-lg text-right">
                                        <i class="fas fa-users ml-2 text-[#8333A6] group-hover:text-[#8333A6]"></i>المستخدمون
                                    </a>
                                </div>
                            </x-slot>
                        </x-nav-link>
                    </div>

                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="/">
                            <img src="{{ asset('images/Logo.png') }}" alt="Education Space Logo" class="w-20 h-20 mb-3">
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="fixed top-0 right-0 w-72 h-full bg-gray-900 text-gray-200 shadow-2xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out overflow-y-auto">
                    <div class="sticky top-0 bg-gray-800 flex justify-between items-center p-5 border-b border-gray-700 z-10">
                        <span class="text-xl font-poppins font-semibold text-[#8333A6]">القائمة الرئيسية</span>
                        <button id="mobile-menu-close" class="p-1 rounded-full hover:bg-gray-700 transition duration-200">
                            <svg class="w-6 h-6 text-gray-400 hover:text-[#8333A6]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="p-5 space-y-3">
                        <a href="/home" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-gray-700 text-gray-300">
                            <i class="fas fa-home mr-3 text-[#8333A6] w-5 text-center"></i> الرئيسية
                        </a>
                        <a href="/all-halls" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-gray-700 text-gray-300">
                            <i class="fas fa-door-open mr-3 text-[#8333A6] w-5 text-center"></i> قاعات
                        </a>
                        <a href="/trainers" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-gray-700 text-gray-300">
                            <i class="fas fa-chalkboard-teacher mr-3 text-[#8333A6] w-5 text-center"></i> المدربين
                        </a>
                        <a href="/lectures" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-gray-700 text-gray-300">
                            <i class="fas fa-book mr-3 text-[#8333A6] w-5 text-center"></i> المحاضرات
                        </a>
                        <a href="/courses" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-gray-700 text-gray-300">
                            <i class="fas fa-graduation-cap mr-3 text-[#8333A6] w-5 text-center"></i> الدورات
                        </a>
                        <div class="relative">
                            <button id="mobile-security-button" class="flex items-center py-3 px-4 text-lg font-medium rounded-lg transition duration-200 hover:bg-gray-700 text-gray-300 w-full text-right">
                                <i class="fas fa-shield-alt mr-3 text-[#8333A6] w-5 text-center"></i> الأمان
                                <svg class="mr-auto h-4 w-4 text-[#8333A6] transition-transform duration-200 transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="mobile-security-dropdown" class="hidden mt-1">
                                <a href="/system-module" class="block py-2 px-4 text-base font-medium rounded-lg transition duration-200 hover:bg-gray-700 hover:text-[#8333A6] text-gray-300">وحدة النظام</a>
                                <a href="/role-rights" class="block py-2 px-4 text-base font-medium rounded-lg transition duration-200 hover:bg-gray-700 hover:text-[#8333A6] text-gray-300">الأدوار والصلاحيات</a>
                                <a href="/users" class="block py-2 px-4 text-base font-medium rounded-lg transition duration-200 hover:bg-gray-700 hover:text-[#8333A6] text-gray-300">المستخدمون</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Page Content -->
        <main class="relative flex-grow px-4 sm:px-6 lg:px-8 py-6 bg-gray-900 overflow-x-hidden">
            <div class="max-w-full sm:max-w-lg md:max-w-2xl lg:max-w-4xl xl:max-w-7xl mx-auto w-full box-border break-words whitespace-normal relative z-10">
                <div id="particles"></div>
             
              
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-0 min-h-screen" dir="rtl">
        <div class="gradient-overlay rounded-2xl shadow-2xl p-6 sm:p-8 relative overflow-hidden">
            <!-- Decorative Background Element -->
            <div class="absolute inset-0 bg-gradient-to-r from-[#8333A6]/10 to-gray-500/10 opacity-50 pointer-events-none"></div>

            <!-- Hero Banner (Unchanged) -->
            <div class="relative bg-gradient-to-r from-[#8333A6] to-[#6b2a87] rounded-2xl p-8 mb-10 shadow-xl text-center animate-fade-in z-10">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-white mb-4 animate-pulse">
                    اكتشف أفضل المدربين 
                </h1>
                <p class="text-lg text-white/80 max-w-2xl mx-auto">
                  ابحث عن افضل المدربين لتواصل معهم لاعطاء محاضرات او الحصول على نصائح قيمة 
                </p>
            </div>

            <!-- Updated Search Section -->
            <section class="mb-10 bg-gradient-to-r from-[#8333A6] to-[#6b2a87] rounded-2xl shadow-md p-6 animate-slide-in border border-white/20">
                <h2 class="text-3xl font-bold text-white mb-6 flex items-center space-x-2 space-x-reverse">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>ابحث عن قاعات مثالية</span>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                  
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">الأسم</label>
                        
                       <input type="text" id="coachName" class="w-full border border-[#a855f7] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#a855f7] bg-white/10 text-white placeholder-white/50">
                    </div>
                   
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">التخصص</label>
                        <select id="price" class="w-full border border-[#a855f7] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#a855f7] bg-white/10 text-white placeholder-white/50">
                            <option value="" class="text-black">جميع التخصصات</option>
                            <option value="program"  class="text-black">برمجة</option>
                            <option value="arshd"  class="text-black">ارشاد نفسي</option>
                            <option value="langeg"  class="text-black">لغات</option>
                        </select>
                    </div>
                    
                     <div>
                        <label class="block text-sm font-medium text-white mb-1">البلد</label>
                        <input type="text" id="natnal" class="w-full border border-[#a855f7] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#a855f7] bg-white/10 text-white">
                    </div>
                  
                    <div>
                        <label class="block text-sm font-medium text-white mb-1">ترتيب حسب</label>
                        <select id="sort-by" class="w-full border border-[#a855f7] rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[#a855f7] bg-white/10 text-white placeholder-white/50">
                            <option value="price-asc"  class="text-black">السعر: من الأقل</option>
                            <option value="price-desc"  class="text-black">السعر: من الأعلى</option>
                            <option value="capacity-asc"  class="text-black">السعة: من الأقل</option>
                            <option value="capacity-desc"  class="text-black">السعة: من الأعلى</option>
                            <option value="name"  class="text-black">الاسم</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button id="apply-search" class="w-full bg-[#8333A6] text-white rounded-lg px-4 py-2 hover:bg-[#6b2a87] transition-all duration-200 transform hover:scale-105">
                            بحث
                        </button>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button id="reset-search" class="px-4 py-2 bg-white/20 text-white rounded-lg hover:bg-white/30 transition-all duration-200 transform hover:scale-105">
                        إعادة تعيين
                    </button>
                </div>
            </section>

        

                <!-- Results Count -->
                <div class="mb-6 text-gray-700">
                    <span id="results-count">6</span> نتيجة
                </div>

                <!-- profiles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 " id="halls-container">
                    <!-- profile Card 1 -->
                    <div class="hall-card bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-2xl overflow-x-auto transition-all duration-300  hover:shadow-2xl hover:shadow-[#8333A6]/50 hover:transform hover:scale-105 border-2 border-[#8333A6]/30 max-w-sm sm:max-w-md md:max-w-lg mx-auto" data-status="featured" data-capacity="50" data-price="150" data-location="riyadh" data-amenities="wifi,projector">
                        <div class="relative h-40 sm:h-48 md:h-56 bg-gray-200">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="قاعة المؤتمرات A" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                           
                        </div>
                        <div class="p-4 sm:p-6 md:p-8">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-3">م.محمد طارق</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">مهندس في مجال علوم الفلك والبيئة وخصوبة التربة و دكتوراة في علم النفس </p>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-[#8333A6] ml-1 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3m-2-2H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v7m-5 4a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                    <span class="text-sm sm:text-base font-medium text-gray-900"><span class="text-[#8333A6]">التخصص:</span>الارشاد التربوي </span>
                                </div>
                             
  
                            </div>
                            <button class="view-details bg-gradient-to-r from-[#8333A6] to-[#a855f7] hover:from-[#6a2985] hover:to-[#9333ea] text-white px-4 py-2.5 rounded-full text-sm font-semibold w-full mt-6 flex items-center justify-center space-x-2 space-x-reverse transition-all duration-300" onclick="window.location.href='trianes.html'">
                                <span>عرض الملف الشخصي </span>
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>


                     <!-- profile Card 2 -->
                    <div class="hall-card bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-2xl overflow-x-auto transition-all duration-300  hover:shadow-2xl hover:shadow-[#8333A6]/50 hover:transform hover:scale-105 border-2 border-[#8333A6]/30 max-w-sm sm:max-w-md md:max-w-lg mx-auto" data-status="featured" data-capacity="50" data-price="150" data-location="riyadh" data-amenities="wifi,projector">
                        <div class="relative h-40 sm:h-48 md:h-56 bg-gray-200">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="قاعة المؤتمرات A" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                           
                        </div>
                        <div class="p-4 sm:p-6 md:p-8">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-3">م.محمد طارق</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">مهندس في مجال علوم الفلك والبيئة وخصوبة التربة و دكتوراة في علم النفس </p>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-[#8333A6] ml-1 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3m-2-2H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v7m-5 4a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                    <span class="text-sm sm:text-base font-medium text-gray-900"><span class="text-[#8333A6]">التخصص:</span>الارشاد التربوي </span>
                                </div>
                             
  
                            </div>
                            <button class="view-details bg-gradient-to-r from-[#8333A6] to-[#a855f7] hover:from-[#6a2985] hover:to-[#9333ea] text-white px-4 py-2.5 rounded-full text-sm font-semibold w-full mt-6 flex items-center justify-center space-x-2 space-x-reverse transition-all duration-300" onclick="window.location.href='trianes.html'">
                                <span>عرض الملف الشخصي </span>
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>


                     <!-- profile Card 3 -->
                    <div class="hall-card bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-2xl overflow-x-auto transition-all duration-300  hover:shadow-2xl hover:shadow-[#8333A6]/50 hover:transform hover:scale-105 border-2 border-[#8333A6]/30 max-w-sm sm:max-w-md md:max-w-lg mx-auto" data-status="featured" data-capacity="50" data-price="150" data-location="riyadh" data-amenities="wifi,projector">
                        <div class="relative h-40 sm:h-48 md:h-56 bg-gray-200">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="قاعة المؤتمرات A" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                           
                        </div>
                        <div class="p-4 sm:p-6 md:p-8">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-3">م.محمد طارق</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">مهندس في مجال علوم الفلك والبيئة وخصوبة التربة و دكتوراة في علم النفس </p>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-[#8333A6] ml-1 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3m-2-2H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v7m-5 4a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                    <span class="text-sm sm:text-base font-medium text-gray-900"><span class="text-[#8333A6]">التخصص:</span>الارشاد التربوي </span>
                                </div>
                             
  
                            </div>
                            <button class="view-details bg-gradient-to-r from-[#8333A6] to-[#a855f7] hover:from-[#6a2985] hover:to-[#9333ea] text-white px-4 py-2.5 rounded-full text-sm font-semibold w-full mt-6 flex items-center justify-center space-x-2 space-x-reverse transition-all duration-300" onclick="window.location.href='trianes.html'">
                                <span>عرض الملف الشخصي </span>
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>


                     <!-- profile Card 4 -->
                    <div class="hall-card bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-2xl overflow-x-auto transition-all duration-300  hover:shadow-2xl hover:shadow-[#8333A6]/50 hover:transform hover:scale-105 border-2 border-[#8333A6]/30 max-w-sm sm:max-w-md md:max-w-lg mx-auto" data-status="featured" data-capacity="50" data-price="150" data-location="riyadh" data-amenities="wifi,projector">
                        <div class="relative h-40 sm:h-48 md:h-56 bg-gray-200">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="قاعة المؤتمرات A" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                           
                        </div>
                        <div class="p-4 sm:p-6 md:p-8">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-3">م.محمد طارق</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">مهندس في مجال علوم الفلك والبيئة وخصوبة التربة و دكتوراة في علم النفس </p>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-[#8333A6] ml-1 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3m-2-2H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v7m-5 4a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                    <span class="text-sm sm:text-base font-medium text-gray-900"><span class="text-[#8333A6]">التخصص:</span>الارشاد التربوي </span>
                                </div>
                             
  
                            </div>
                            <button class="view-details bg-gradient-to-r from-[#8333A6] to-[#a855f7] hover:from-[#6a2985] hover:to-[#9333ea] text-white px-4 py-2.5 rounded-full text-sm font-semibold w-full mt-6 flex items-center justify-center space-x-2 space-x-reverse transition-all duration-300" onclick="window.location.href='trianes.html'">
                                <span>عرض الملف الشخصي </span>
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>

                     <!-- profile Card 5 -->
                    <div class="hall-card bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-2xl overflow-x-auto transition-all duration-300  hover:shadow-2xl hover:shadow-[#8333A6]/50 hover:transform hover:scale-105 border-2 border-[#8333A6]/30 max-w-sm sm:max-w-md md:max-w-lg mx-auto" data-status="featured" data-capacity="50" data-price="150" data-location="riyadh" data-amenities="wifi,projector">
                        <div class="relative h-40 sm:h-48 md:h-56 bg-gray-200">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="قاعة المؤتمرات A" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                           
                        </div>
                        <div class="p-4 sm:p-6 md:p-8">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-3">م.محمد طارق</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">مهندس في مجال علوم الفلك والبيئة وخصوبة التربة و دكتوراة في علم النفس </p>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-[#8333A6] ml-1 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3m-2-2H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v7m-5 4a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                    <span class="text-sm sm:text-base font-medium text-gray-900"><span class="text-[#8333A6]">التخصص:</span>الارشاد التربوي </span>
                                </div>
                             
  
                            </div>
                            <button class="view-details bg-gradient-to-r from-[#8333A6] to-[#a855f7] hover:from-[#6a2985] hover:to-[#9333ea] text-white px-4 py-2.5 rounded-full text-sm font-semibold w-full mt-6 flex items-center justify-center space-x-2 space-x-reverse transition-all duration-300" onclick="window.location.href='trianes.html'">
                                <span>عرض الملف الشخصي </span>
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div>


                     <!-- profile Card 6 -->
                    <div class="hall-card bg-gradient-to-b from-white to-gray-100 shadow-lg rounded-2xl overflow-x-auto transition-all duration-300  hover:shadow-2xl hover:shadow-[#8333A6]/50 hover:transform hover:scale-105 border-2 border-[#8333A6]/30 max-w-sm sm:max-w-md md:max-w-lg mx-auto" data-status="featured" data-capacity="50" data-price="150" data-location="riyadh" data-amenities="wifi,projector">
                        <div class="relative h-40 sm:h-48 md:h-56 bg-gray-200">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="قاعة المؤتمرات A" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                           
                        </div>
                        <div class="p-4 sm:p-6 md:p-8">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-900 mb-3">م.محمد طارق</h3>
                            <p class="text-sm sm:text-base text-gray-600 mb-4">مهندس في مجال علوم الفلك والبيئة وخصوبة التربة و دكتوراة في علم النفس </p>
                            <div class="space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-5 sm:w-6 h-5 sm:h-6 text-[#8333A6] ml-1 sm:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a2 2 0 00-2-2h-3m-2-2H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v7m-5 4a5 5 0 11-10 0 5 5 0 0110 0z"></path></svg>
                                    <span class="text-sm sm:text-base font-medium text-gray-900"><span class="text-[#8333A6]">التخصص:</span>الارشاد التربوي </span>
                                </div>
                             
  
                            </div>
                            <button class="view-details bg-gradient-to-r from-[#8333A6] to-[#a855f7] hover:from-[#6a2985] hover:to-[#9333ea] text-white px-4 py-2.5 rounded-full text-sm font-semibold w-full mt-6 flex items-center justify-center space-x-2 space-x-reverse transition-all duration-300" onclick="window.location.href='trianes.html'">
                                <span>عرض الملف الشخصي </span>
                                <i class="fas fa-info-circle"></i>
                            </button>
                        </div>
                    </div> 
                </div>

                <!-- Load More Button -->
                <div class="mt-8 text-center">
                    <button id="load-more" class="bg-gradient-to-r from-[#8333A6] to-[#a855f7] hover:from-[#6a2985] hover:to-[#9333ea] text-white px-6 py-3 rounded-full text-sm font-semibold transition-all duration-300 transform hover:scale-105">
                        تحميل المزيد
                    </button>
                </div>
            </section>

            
            

            <!-- Repeat similar modals for other halls as needed -->
        </div>
    </main>

    <style>
        /* Custom Animations */
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
        @keyframes scaleIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        .animate-fade-in { animation: fadeIn 0.5s ease-out forwards; }
        .animate-slide-in { animation: slideIn 0.5s ease-out forwards; }
        .animate-scale-in { animation: scaleIn 0.3s ease-out forwards; }
        [dir="rtl"] .animate-slide-in { animation: slideInRTL 0.5s ease-out forwards; }
        @keyframes slideInRTL { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }

        /* Gradient Overlay */
        .gradient-overlay {
            background: linear-gradient(135deg, rgba(131, 51, 166, 0.2), rgba(255, 255, 255, 0.1));
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
        }

        /* Status Badge */
        .status-badge {
            position: absolute;
            top: 12px;
            right: 12px;
            font-size: 11px;
            padding: 3px 10px;
            border-radius: 20px;
            z-index: 10;
        }
        .status-badge.bg-green-600 { background-color: #10B981; }
        .status-badge.bg-yellow-400 { background-color: #FBBF24; }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .text-5xl { font-size: 2.5rem; }
            .text-4xl { font-size: 2rem; }
            .text-3xl { font-size: 1.75rem; }
            .text-2xl { font-size: 1.5rem; }
            .p-8 { padding: 1.5rem; }
            .py-10 { padding-top: 2rem; padding-bottom: 2rem; }
            .space-y-10 > * + * { margin-top: 2rem; }
            .grid-cols-3 { grid-template-columns: 1fr; }
            .grid-cols-4 { grid-template-columns: 1fr; }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.hall-card');
            const resultsCount = document.getElementById('results-count');
            const loadMoreBtn = document.getElementById('load-more');

            // Toggle Modal
            const toggleModal = (modalId, show) => {
                const modal = document.getElementById(modalId);
                if (modal) {
                    modal.classList.toggle('hidden', !show);
                }
            };

            document.querySelectorAll('[data-modal-toggle]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalId = btn.getAttribute('data-modal-toggle');
                    toggleModal(modalId, true);
                });
            });

            document.querySelectorAll('[data-modal-close]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const modalId = btn.getAttribute('data-modal-close');
                    toggleModal(modalId, false);
                });
            });

            document.querySelectorAll('.fixed.inset-0').forEach(modal => {
                modal.addEventListener('click', e => {
                    if (e.target === modal) {
                        toggleModal(modal.id, false);
                    }
                });
            });

            // Filter Halls
            const filterHalls = filter => {
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    const isActive = btn.dataset.filter === filter;
                    btn.classList.toggle('bg-[#8333A6]', isActive);
                    btn.classList.toggle('text-white', isActive);
                    btn.classList.toggle('bg-gray-200', !isActive);
                    btn.classList.toggle('text-gray-800', !isActive);
                    btn.classList.toggle('active', isActive);
                });

                const visibleCards = Array.from(cards).filter(card => {
                    let shouldShow = true;
                    if (filter === 'featured') {
                        shouldShow = card.dataset.status === 'featured';
                    } else if (filter === 'low-price') {
                        shouldShow = parseFloat(card.dataset.price) <= 150;
                    } else if (filter === 'high-capacity') {
                        shouldShow = parseInt(card.dataset.capacity) >= 50;
                    }
                    card.style.display = shouldShow ? 'block' : 'none';
                    return shouldShow;
                });

                if (resultsCount) {
                    resultsCount.textContent = visibleCards.length;
                }
            };

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', () => filterHalls(btn.dataset.filter));
            });

            // Search Halls
            const applySearch = () => {
                const location = document.getElementById('location').value;
                const capacity = document.getElementById('capacity').value;
                const date = document.getElementById('date').value;
                const price = document.getElementById('price').value;
                const amenities = document.getElementById('amenities').value;
                const time = document.getElementById('time').value;
                const sortBy = document.getElementById('sort-by').value;

                let filteredCards = Array.from(cards);

                if (location) {
                    filteredCards = filteredCards.filter(card => card.dataset.location === location);
                }

                if (capacity) {
                    filteredCards = filteredCards.filter(card => {
                        const [min, max] = capacity.split('-').map(Number);
                        const cardCapacity = parseInt(card.dataset.capacity);
                        return max ? cardCapacity >= min && cardCapacity <= max : cardCapacity >= min;
                    });
                }

                if (price) {
                    filteredCards = filteredCards.filter(card => {
                        const [min, max] = price.split('-').map(Number);
                        const cardPrice = parseFloat(card.dataset.price);
                        return max ? cardPrice >= min && cardPrice <= max : cardPrice >= min;
                    });
                }

                if (amenities) {
                    filteredCards = filteredCards.filter(card => card.dataset.amenities.includes(amenities));
                }

                // Placeholder for date and time filtering (requires backend integration)
                if (date || time) {
                    console.log('Date/Time filtering requires backend availability check');
                }

                if (sortBy === 'price-asc') {
                    filteredCards.sort((a, b) => parseFloat(a.dataset.price) - parseFloat(b.dataset.price));
                } else if (sortBy === 'price-desc') {
                    filteredCards.sort((a, b) => parseFloat(b.dataset.price) - parseFloat(a.dataset.price));
                } else if (sortBy === 'capacity-asc') {
                    filteredCards.sort((a, b) => parseInt(a.dataset.capacity) - parseInt(b.dataset.capacity));
                } else if (sortBy === 'capacity-desc') {
                    filteredCards.sort((a, b) => parseInt(b.dataset.capacity) - parseInt(a.dataset.capacity));
                } else if (sortBy === 'name') {
                    filteredCards.sort((a, b) => a.querySelector('h3').textContent.localeCompare(b.querySelector('h3').textContent));
                }

                cards.forEach(card => {
                    card.style.display = 'none';
                });

                filteredCards.forEach(card => {
                    card.style.display = 'block';
                });

                resultsCount.textContent = filteredCards.length;
            };

            const resetSearch = () => {
                document.getElementById('location').value = '';
                document.getElementById('capacity').value = '';
                document.getElementById('date').value = '';
                document.getElementById('price').value = '';
                document.getElementById('amenities').value = '';
                document.getElementById('time').value = '';
                document.getElementById('sort-by').value = 'price-asc';
                cards.forEach(card => {
                    card.style.display = 'block';
                });
                resultsCount.textContent = cards.length;
            };

            document.getElementById('apply-search').addEventListener('click', applySearch);
            document.getElementById('reset-search').addEventListener('click', resetSearch);

            // Load More (Placeholder)
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', () => {
                    console.log('Load more halls (requires backend integration)');
                    // Backend call to fetch more halls and append to #halls-container
                });
            }
        });
    </script>
</x-layout>
                    
            </div>
        </main>
               
        <!-- Footer -->
        <footer class="bg-gray-900 text-white pt-12 pb-6 border-t-2 border-[#8333A6]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-poppins font-semibold mb-4 text-[#8333A6] relative inline-block">
                            روابط سريعة
                            <span class="absolute -bottom-1 right-1/2 transform translate-x-1/2 w-12 h-1 bg-gradient-to-r from-[#8333A6] to-[#8333A6] rounded-full"></span>
                        </h3>
                        <div class="space-y-3">
                            <a href="/home" class="block text-gray-300 hover:text-[#8333A6] transition duration-200 font-roboto">
                                <i class="fas fa-arrow-left mr-2 text-sm"></i>الصفحة الرئيسية
                            </a>
                            <a href="/all-halls" class="block text-gray-300 hover:text-[#8333A6] transition duration-200 font-roboto">
                                <i class="fas fa-arrow-left mr-2 text-sm"></i>قاعات
                            </a>
                            <a href="/trainers" class="block text-gray-300 hover:text-[#8333A6] transition duration-200 font-roboto">
                                <i class="fas fa-arrow-left mr-2 text-sm"></i>المدربين
                            </a>
                            <a href="/lectures" class="block text-gray-300 hover:text-[#8333A6] transition duration-200 font-roboto">
                                <i class="fas fa-arrow-left mr-2 text-sm"></i>المحاضرات
                            </a>
                            <a href="/courses" class="block text-gray-300 hover:text-[#8333A6] transition duration-200 font-roboto">
                                <i class="fas fa-arrow-left mr-2 text-sm"></i>الدورات
                            </a>
                        </div>
                    </div>

                    <!-- Development Team -->
                    <div>
                        <h3 class="text-lg font-poppins font-semibold mb-4 text-[#8333A6] relative inline-block">
                            فريق التطوير
                            <span class="absolute -bottom-1 right-1/2 transform translate-x-1/2 w-12 h-1 bg-gradient-to-r from-[#8333A6] to-[#8333A6] rounded-full"></span>
                        </h3>
                        <div class="space-y-3 text-gray-300 font-roboto text-base">
                            <div class="flex justify-center items-start">
                                <span class="text-[#8333A6] hover:text-[#8333A6] transition duration-200">عبدالرحمن حامد</span>
                                <span class="font-medium text-white min-w-[100px]"><span class="font-medium text-white min-w-[100px]"> :Project Manger & Back-end</span>
                            </div>
                            <div class="flex justify-center items-start">
                                <span class="text-[#8333A6] hover:text-[#8333A6] transition duration-200">د.محمد الشرعة</span>
                                <span class="font-medium text-white min-w-[100px]"><span class="font-medium text-white min-w-[100px]"> :Project Supervisor</span>
                            </div>
                            <div class="flex justify-center items-start">
                                <span class="text-[#8333A6] hover:text-[#8333A6] transition duration-200">محمد طارق</span>
                                <span class="font-medium text-white min-w-[100px]"><span class="font-medium text-white min-w-[100px]"> :UI & UX</span>
                            </div>
                            <div class="flex justify-center items-start">
                                <div>
                                    <span class="text-[#8333A6] hover:text-[#8333A6] transition duration-200 block">اية خالد</span>
                                    <span class="text-[#8333A6] hover:text-[#8333A6] transition duration-200 block">مرح الجمال</span>
                                </div>
                                <span class="font-medium text-white min-w-[100px]"><span class="font-medium text-white min-w-[100px]"> :Front-end</span>
                            </div>
                        </div>
                    </div>

                    <!-- About Section -->
                    <div>
                        <h3 class="text-lg font-poppins font-semibold mb-4 text-[#8333A6] relative inline-block">
                            عن المشروع
                            <span class="absolute -bottom-1 right-1/2 transform translate-x-1/2 w-12 h-1 bg-gradient-to-r from-[#8333A6] to-[#8333A6] rounded-full"></span>
                        </h3>
                        <p class="text-gray-300 font-roboto text-sm leading-relaxed mb-4">
                            "Education Space" هو منصة إلكترونية ذكية تربط بين أصحاب القاعات، المدربين، والطلاب، بهدف تسهيل حجز القاعات وتنظيم المحاضرات والدورات التدريبية بطريقة احترافية وسلسة. الموقع يهدف لدعم التعليم.
                        </p>
                        <div class="flex justify-center space-x-4 space-x-reverse mt-4">
                            <a href="#" class="text-gray-300 hover:text-[#8333A6] transition duration-200">
                                <i class="fab fa-instagram text-lg"></i>
                            </a>
                            <a href="#" class="text-gray-300 hover:text-[#8333A6] transition duration-200">
                                <i class="fab fa-github text-lg"></i>
                            </a>
                            <a href="#" class="text-gray-300 hover:text-[#8333A6] transition duration-200">
                                <i class="fab fa-youtube text-lg"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400 font-roboto text-sm">
                    <p>© 2025 Education Space - جميع الحقوق محفوظة</p>
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
            const particleCount = window.innerWidth < 640 ? 15 : 30; // Fewer particles on small s .,mcreens
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle'); cv xxqwws
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
            mobileMenu.classList.toggle('translate-x-full');
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
        setupDropdown('security-button', 'security-dropdown');
        setupDropdown('mobile-security-button', 'mobile-security-dropdown');

        // Highlight current page link
        document.addEventListener('DOMContentLoaded', () => {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('a[href]');
            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('text-[#8333A6]', 'bg-white/10');
                    link.querySelector('span')?.classList.add('text-[#8333A6]');
                    const underline = link.querySelector('span:last-child');
                    if (underline) underline.classList.add('w-1/2');
                }
            });
        });
    </script>

    @livewireScripts
</body>
</html>