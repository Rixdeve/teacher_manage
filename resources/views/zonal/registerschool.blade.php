<?php
if (!session()->has('zone_office_id')) {
    return redirect('/login');
}
?>
<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    screens: {
                        'lg': '1000px',
                        'xl': '1280px',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'custom': '0 4px 20px rgba(0, 0, 0, 0.1)',
                        'custom-hover': '0 6px 30px rgba(0, 0, 0, 0.15)',
                    },
                    colors: {
                        'primary-blue': '#2563EB',
                        'primary-blue-dark': '#1E40AF',
                        'accent-green': '#10B981',
                        'accent-purple': '#8B5CF6',
                        'light-gray': '#F5F5F5',
                        'dark-gray': '#1F2937',
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                    },
                }
            }
        }
    </script>
    <title>Register School | TLMS</title>
</head>

<body class="bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 font-sans min-h-screen flex items-center justify-center">
    <!-- Top Navigation Bar -->
    <nav class="fixed top-0 left-0 w-full bg-light-gray dark:bg-dark-gray shadow-custom z-50">
        <div class="max-w-7xl mx-auto px-4 lg:px-6 py-3 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/photos/boy.png') }}" class="w-10 h-10 rounded-full border-2 border-white dark:border-gray-600 shadow-md transition-transform duration-300 hover:scale-110" alt="Profile" />
                @php
                $zoneOffice = \App\Models\ZoneOffice::find(session('zone_office_id'));
                @endphp
                @if($zoneOffice)
                <a href="{{ url('/show') }}" class="text-gray-800 dark:text-gray-200 font-semibold text-sm hover:text-primary-blue dark:hover:text-primary-blue">{{ $zoneOffice->zone_name }}</a>
                @endif
            </div>
            <div class="flex items-center space-x-4">
                <a href="{{ url('/zonalDashboard') }}" class="bg-primary-blue text-white font-semibold px-4 py-2 rounded-full shadow-md hover:bg-primary-blue-dark transition-colors duration-300">Dashboard</a>
                <a href="{{ url('/logout') }}" class="text-red-600 dark:text-red-400 font-semibold px-4 py-2 rounded-full hover:bg-red-600 hover:bg-opacity-10 transition-colors duration-300">Logout</a>
                <button id="theme-toggle" class="p-2 rounded-full bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-primary-blue hover:text-white dark:hover:bg-primary-blue transition-colors duration-300">
                    <svg id="sun-icon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg id="moon-icon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="w-full max-w-5xl mx-auto pt-28 px-4 lg:px-8 py-6">
        <div class="bg-white dark:bg-dark-gray shadow-lg rounded-lg bg-opacity-90 p-8 animate-fade-in">
            <!-- Header -->
            <div class="bg-gradient-to-r from-primary-blue to-primary-blue-dark p-6 rounded-lg mb-6 text-center">
                <h1 class="text-2xl font-bold text-white">Register School</h1>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
            <div class="bg-white dark:bg-dark-gray text-red-600 p-4 rounded-lg mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Success/Error Messages -->
            @if (session('success'))
            <p class="text-accent-green text-sm mb-4">{{ session('success') }}</p>
            @endif
            @if (session('error'))
            <p class="text-red-600 text-sm mb-4">{{ session('error') }}</p>
            @endif

            <!-- Form -->
            <form method="POST" action="{{ route('school.store') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                <h2 class="col-span-1 md:col-span-2 text-xl font-semibold text-gray-800 dark:text-gray-200">School Details</h2>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">School Name</label>
                    <input type="text" id="school_name" name="school_name" placeholder="Vishaka Vidyalaya"
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg w-full bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" required />
                </div>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">School Number</label>
                    <input type="text" id="school_number" name="school_number" placeholder="E344"
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg w-full bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" required />
                </div>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">Address No</label>
                    <input type="text" id="school_address_no" name="school_address_no" placeholder="133"
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg w-full bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" required />
                </div>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">Street</label>
                    <input type="text" id="school_address_street" name="school_address_street" placeholder="Vajira Road"
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg w-full bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" required />
                </div>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">City</label>
                    <input type="text" id="school_address_city" name="school_address_city" placeholder="Colombo 4"
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg w-full bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" required />
                </div>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">Email</label>
                    <input type="email" id="school_email" name="school_email" placeholder="vishaka@email.com"
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg w-full bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" required />
                </div>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">Phone</label>
                    <input type="tel" id="school_phone" name="school_phone" placeholder="0123456789"
                        class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg w-full bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" pattern="[0-9]{10}" required />
                </div>
                <div>
                    <label class="block text-gray-800 dark:text-gray-200 font-medium">Status</label>
                    <select id="status" name="status" class="w-full rounded-lg p-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-dark-gray text-gray-800 dark:text-gray-200 focus:ring-2 focus:ring-primary-blue" required>
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>
                    </select>
                </div>
                <div class="col-span-1 md:col-span-2">
                    <button type="submit"
                        class="w-full bg-primary-blue py-2 text-white rounded-lg font-bold hover:bg-primary-blue-dark transition-colors duration-300 shadow-md">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Dark mode toggle
        const toggleButton = document.getElementById('theme-toggle');
        const sunIcon = document.getElementById('sun-icon');
        const moonIcon = document.getElementById('moon-icon');
        toggleButton.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            sunIcon.classList.toggle('hidden');
            moonIcon.classList.toggle('hidden');
            localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
        });
        // Load saved theme
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
            sunIcon.classList.remove('hidden');
            moonIcon.classList.add('hidden');
        } else {
            sunIcon.classList.add('hidden');
            moonIcon.classList.remove('hidden');
        }
    </script>
</body>

</html>