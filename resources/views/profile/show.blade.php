<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile | TLMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    screens: {
                        'lg': '1000px',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'custom': '0 2px 10px rgba(0, 0, 0, 0.05)', // Reduced intensity
                        'custom-hover': '0 4px 15px rgba(0, 0, 0, 0.1)', // Simplified hover shadow
                    },
                    backgroundImage: {
                        'profile-gradient': 'linear-gradient(to bottom, #DBEAFE 0%, #D1D5DB 100%)',
                        'profile-gradient-dark': 'linear-gradient(to bottom, #1E293B 0%, #374151 100%)',
                    },
                    colors: {
                        'dark-accent': '#000000', // Black for dark mode hover
                        'dark-border': '#4B5563', // Subtle border for dark mode
                    },
                }
            }
        };
    </script>
</head>
<body class="bg-white dark:bg-gray-950 font-sans antialiased min-h-screen flex items-center justify-center p-4 sm:p-6 lg:p-8">
    <!-- Back Button -->
    <button onclick="history.back()" class="fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-dark-accent text-gray-800 dark:text-gray-200 rounded-full shadow-custom hover:shadow-custom-hover transition-all duration-200" aria-label="Go back">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>

    <!-- Main Profile Card -->
    <div class="w-full bg-white dark:bg-gray-900 rounded-2xl shadow-custom p-6 sm:p-8 lg:p-10 transition-all duration-200 relative">
        <!-- Theme Toggle -->
        <button id="theme-toggle" class="absolute top-4 right-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-dark-accent text-gray-800 dark:text-gray-200 rounded-full shadow-custom hover:shadow-custom-hover transition-all duration-200" aria-label="Toggle theme">
            <svg id="sun-icon" class="w-6 h-6 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg id="moon-icon" class="w-6 h-6 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9 9 0 0020.354 15.354z"></path>
            </svg>
        </button>

        <!-- Profile Header -->
        <div class="flex items-center gap-6 bg-profile-gradient dark:bg-profile-gradient-dark p-6 sm:p-8 rounded-2xl mb-6 sm:mb-8 shadow-custom hover:shadow-custom-hover transition-all duration-200">
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-20 h-20 rounded-full border-4 border-white dark:border-dark-border shadow-custom transition-transform duration-200 hover:scale-105" />
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h1>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ ucfirst(strtolower(Auth::user()->role)) }}</p>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6 sm:mb-8">
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Name</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
            </div>
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Date of Birth</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->user_dob }}</p>
            </div>
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Address</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->user_address_no }}, {{ Auth::user()->user_address_street }}, {{ Auth::user()->user_address_city }}</p>
            </div>
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Contact Number</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->user_phone }}</p>
            </div>
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Email</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->user_email }}</p>
            </div>
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">NIC</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->user_nic }}</p>
            </div>
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">School Index</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->school_index }}</p>
            </div>
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Role</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ ucfirst(strtolower(Auth::user()->role)) }}</p>
            </div>
            @if (Auth::user()->section)
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Section</p>
                <p class="text-base text-gray-600 dark:text-gray-400">{{ Auth::user()->section }}</p>
            </div>
            @endif
            @if (!empty($user->subjects) && is_array($user->subjects))
            <div class="p-5 bg-blue-100 dark:bg-gray-800 rounded-2xl hover:bg-gray-200 dark:hover:bg-dark-accent dark:border dark:border-dark-border transition-all duration-200">
                <p class="text-base font-semibold text-gray-700 dark:text-gray-200">Subjects</p>
                <div class="flex flex-wrap gap-3">
                    @foreach ($user->subjects as $subject)
                    <span class="text-sm bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-3 py-1 rounded-full">{{ $subject }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Change Password -->
        <div class="border-t border-gray-200 dark:border-dark-border pt-8 mb-6 sm:mb-8">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Change Password</h2>
            @if (session('success'))
            <div class="bg-green-100 dark:bg-green-900 border-l-4 border-green-500 dark:border-green-600 text-green-700 dark:text-green-200 p-4 mb-6 rounded-2xl shadow-custom" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
            <div class="bg-red-100 dark:bg-red-900 border-l-4 border-red-500 dark:border-red-600 text-red-700 dark:text-red-200 p-4 mb-6 rounded-2xl shadow-custom" role="alert">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-2">Current Password</label>
                    <input type="password" name="current_password" required class="w-full border border-gray-300 dark:border-dark-border rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-dark-accent transition-all duration-200" />
                </div>
                <div>
                    <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-2">New Password</label>
                    <input type="password" name="new_password" required class="w-full border border-gray-300 dark:border-dark-border rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-dark-accent transition-all duration-200" />
                </div>
                <div>
                    <label class="block text-base font-semibold text-gray-700 dark:text-gray-200 mb-2">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" required class="w-full border border-gray-300 dark:border-dark-border rounded-lg px-4 py-3 text-base bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:focus:ring-dark-accent transition-all duration-200" />
                </div>
                <button type="submit" class="w-full bg-gray-200 hover:bg-gray-300 dark:bg-gray-800 dark:hover:bg-dark-accent text-gray-800 dark:text-gray-200 text-base font-semibold py-3 rounded-lg shadow-custom hover:shadow-custom-hover transition-all duration-200">
                    Update Password
                </button>
            </form>
        </div>

        <!-- Duty Status -->
        <div class="bg-profile-gradient dark:bg-profile-gradient-dark p-6 sm:p-8 rounded-2xl shadow-custom hover:shadow-custom-hover transition-all duration-200">
            <h2 class="text-xl sm:text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-6">Duty Status Today</h2>
            @php
                $attendance = Auth::user()->attendances->where('date', today()->toDateString())->first();
            @endphp
            @if ($attendance)
            <div class="flex flex-wrap gap-6">
                <p class="text-base text-gray-700 dark:text-gray-200">Status: <span class="inline-block bg-blue-100 dark:bg-gray-700 text-blue-700 dark:text-dark-accent px-3 py-1 rounded-full text-sm">{{ $attendance->status }}</span></p>
                <p class="text-base text-gray-700 dark:text-gray-200">Check-In: <span class="text-gray-600 dark:text-gray-400">{{ $attendance->check_in_time ?? '—' }}</span></p>
                <p class="text-base text-gray-700 dark:text-gray-200">Check-Out: <span class="text-gray-600 dark:text-gray-400">{{ $attendance->check_out_time ?? '—' }}</span></p>
            </div>
            @else
            <p class="text-base bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400 px-4 py-3 rounded-lg font-semibold">Attendance not marked yet today.</p>
            @endif
        </div>
    </div>

    <script>
        // Theme Toggle Logic
        const htmlElement = document.documentElement;
        const themeToggle = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');

        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        if (savedTheme === 'dark') {
            htmlElement.classList.add('dark');
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            htmlElement.classList.remove('dark');
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }

        // Toggle theme
        themeToggle.addEventListener('click', () => {
            if (htmlElement.classList.contains('dark')) {
                htmlElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                sunIcon.classList.add('hidden');
                moonIcon.classList.remove('hidden');
            } else {
                htmlElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                sunIcon.classList.remove('hidden');
                moonIcon.classList.add('hidden');
            }
        });
    </script>
</body>
</html>