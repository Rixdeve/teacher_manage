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
    <title>Zonal Dashboard | TLMS</title>
</head>

<body class="bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 font-sans min-h-screen">
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
                <a href="{{ url('/logout') }}" class="text-red-500 dark:text-red-400 font-semibold px-4 py-2 rounded-full hover:bg-red-500 hover:bg-opacity-10 transition-colors duration-300">Logout</a>
                <button id="theme-toggle" class="p-2 rounded-full bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-primary-blue hover:text-white dark:hover:bg-primary-blue transition-colors duration-300">
                    <svg id="sun-icon" class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <svg id="moon-icon" class="w-5 h-5 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="w-full pt-20 px-4 lg:px-6 pb-6 max-h-screen overflow-y-auto">
        <div class="max-w-7xl mx-auto">
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-primary-blue to-primary-blue-dark text-white p-6 rounded-lg mb-4 shadow-custom transition-transform duration-300 hover:scale-[1.01] animate-fade-in">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl lg:text-2xl font-semibold">Welcome to the Zonal Dashboard</h2>
                        <p class="text-sm">Manage schools and monitor key metrics for {{ $zoneOffice ? $zoneOffice->zone_name : 'your zone' }}.</p>
                    </div>
                    <img src="https://cdn-icons-png.flaticon.com/512/2838/2838912.png" class="w-12 h-12 opacity-80" alt="Dashboard Icon" />
                </div>
            </div>

            <!-- Metrics Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-4">
                <div class="bg-white dark:bg-dark-gray p-4 rounded-lg text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:scale-[1.01] animate-fade-in">
                    <a href="{{ url('/registerschool') }}" class="block">
                        <div class="flex justify-center mb-2">
                            <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/add-a-device-5373030-4489968.png" alt="Register School" class="w-10 h-10" />
                        </div>
                        <p class="text-gray-800 dark:text-gray-200 font-semibold text-sm">Register New School</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Add a new school to the zone.</p>
                    </a>
                </div>
                <div class="bg-white dark:bg-dark-gray p-4 rounded-lg text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:scale-[1.01] animate-fade-in">
                    <div class="flex justify-center mb-2">
                        <img src="https://cdn-icons-png.flaticon.com/512/8074/8074788.png" alt="Registered Schools" class="w-10 h-10" />
                    </div>
                    <p class="text-gray-800 dark:text-gray-200 font-semibold text-sm">Registered Schools</p>
                    <p class="text-xl font-bold text-accent-green mt-1">{{ \App\Models\School::where('zonal_id', session('zone_office_id'))->count() }}</p>
                </div>
                <div class="bg-white dark:bg-dark-gray p-4 rounded-lg text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:scale-[1.01] animate-fade-in">
                    <a href="{{ url('/zone/schools') }}" class="block">
                        <div class="flex justify-center mb-2">
                            <img src="https://cdn-icons-png.flaticon.com/512/4304/4304009.png" alt="Registered Users" class="w-10 h-10" />
                        </div>
                        <p class="text-gray-800 dark:text-gray-200 font-semibold text-sm">Registered Users</p>
                        <p class="text-xl font-bold text-accent-purple mt-1">{{ \App\Models\User::whereIn('school_id', \App\Models\School::where('zonal_id', session('zone_office_id'))->pluck('id'))->count() }}</p>
                    </a>
                </div>
                <div class="bg-white dark:bg-dark-gray p-4 rounded-lg text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:scale-[1.01] animate-fade-in">
                    <div class="flex justify-center mb-2">
                        <img src="https://cdn-icons-png.flaticon.com/512/1055/1055646.png" alt="Active Users" class="w-10 h-10" />
                    </div>
                    <p class="text-gray-800 dark:text-gray-200 font-semibold text-sm">Active Users</p>
                    <p class="text-xl font-bold text-primary-blue mt-1">{{ \App\Models\User::whereIn('school_id', \App\Models\School::where('zonal_id', session('zone_office_id'))->pluck('id'))->where('status', 'ACTIVE')->count() }}</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-dark-gray p-4 rounded-lg shadow-custom mb-4 animate-fade-in">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-3">Recent Activity</h3>
                <div class="space-y-2 max-h-48 overflow-y-auto">
                    @php
                    $recentSchools = \App\Models\School::where('zonal_id', session('zone_office_id'))->orderBy('created_at', 'desc')->take(5)->get();
                    @endphp
                    @forelse($recentSchools as $school)
                    <div class="flex items-center justify-between p-2 bg-light-gray dark:bg-gray-700 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <img src="https://cdn-icons-png.flaticon.com/512/8074/8074788.png" class="w-6 h-6" alt="School" />
                            <p class="text-sm text-gray-800 dark:text-gray-200">{{ $school->school_name }} registered</p>
                        </div>

                    </div>
                    @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">No recent activity.</p>
                    @endforelse
                </div>
            </div>

            
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