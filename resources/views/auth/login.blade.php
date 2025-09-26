<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SmartFly</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .animate-fade-in { animation: fadeIn 0.8s ease-out forwards; }
        .animate-float { animation: float 5s ease-in-out infinite; }
        
        .glassmorphism {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-overlay {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.2), rgba(79, 70, 229, 0.1));
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }
        
        .particle {
            position: absolute;
            background: rgba(99, 102, 241, 0.5);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-900 via-blue-800 to-purple-900 font-sans">
    <!-- Particle Background -->
    <div id="particles"></div>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md">
            <!-- Logo and Header -->
            <div class="text-center mb-8 animate-fade-in">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-2xl animate-float">
                    <i class="fas fa-plane-departure text-white text-3xl"></i>
                </div>
                <h1 class="text-4xl font-bold text-white mb-2">SmartFly</h1>
                <p class="text-blue-200">Your gateway to seamless flight booking</p>
            </div>

            <!-- Login Card -->
            <div class="glassmorphism gradient-overlay p-8 rounded-2xl shadow-2xl animate-fade-in" style="animation-delay: 0.2s;">
                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        <i class="fas fa-check-circle mr-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-white mb-2">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-envelope text-blue-400"></i>
                            </div>
                            <input id="email" name="email" type="email" required
                                   class="block w-full pl-10 pr-4 py-3 bg-white/10 border border-gray-300/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('email') border-red-500 @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="Enter your email">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-300 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-white mb-2">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-blue-400"></i>
                            </div>
                            <input id="password" name="password" type="password" required
                                   class="block w-full pl-10 pr-10 py-3 bg-white/10 border border-gray-300/30 rounded-lg text-white placeholder-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 @error('password') border-red-500 @enderror"
                                   placeholder="Enter your password">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center" onclick="togglePassword()">
                                <i class="fas fa-eye text-blue-400 hover:text-blue-300 cursor-pointer" id="passwordToggle"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-300 flex items-center">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-white">
                                Remember me
                            </label>
                        </div>
                        <div class="text-sm">
                            <a href="#" class="text-blue-300 hover:text-blue-200 transition-colors">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105 transition-all duration-200">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Sign In
                        </button>
                    </div>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-sm text-blue-200">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="font-medium text-white hover:text-blue-200 transition-colors">
                                Sign up now
                            </a>
                        </p>
                    </div>
                </form>

                <!-- Social Login (Optional) -->
                <div class="mt-6 pt-6 border-t border-gray-300/30">
                    <div class="text-center">
                        <p class="text-sm text-blue-200 mb-3">Or continue with</p>
                        <div class="flex justify-center space-x-4">
                            <button type="button" class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition-colors">
                                <i class="fab fa-google text-red-400"></i>
                            </button>
                            <button type="button" class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition-colors">
                                <i class="fab fa-facebook-f text-blue-400"></i>
                            </button>
                            <button type="button" class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition-colors">
                                <i class="fab fa-twitter text-sky-400"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6 animate-fade-in" style="animation-delay: 0.4s;">
                <p class="text-sm text-blue-200">© 2025 SmartFly. All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordToggle = document.getElementById('passwordToggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }

        // Particle Background
        function createParticles() {
            const particleContainer = document.getElementById('particles');
            const particleCount = 20;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.width = `${Math.random() * 6 + 4}px`;
                particle.style.height = particle.style.width;
                particle.style.left = `${Math.random() * 100}vw`;
                particle.style.animationDelay = `${Math.random() * 10}s`;
                particle.style.background = `rgba(${Math.random() * 100 + 155}, ${Math.random() * 100 + 155}, 255, 0.4)`;
                particleContainer.appendChild(particle);
            }
        }

        // Initialize particles when page loads
        window.addEventListener('load', createParticles);
        
        // Add animation to form elements on focus
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('ring-2', 'ring-blue-500');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('ring-2', 'ring-blue-500');
            });
        });
    </script>
</body>
</html>