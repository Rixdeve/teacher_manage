<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('partials.theme')
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
                        'custom': '0 4px 20px rgba(0, 0, 0, 0.1)',
                        'custom-hover': '0 6px 30px rgba(0, 0, 0, 0.15)',
                    },
                }
            }
        }
    </script>
    <title>Clerk Dashboard | TLMS</title>
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full min-h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-full shadow-md hover:shadow-custom-hover transition-shadow duration-300">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 p-6 m-0 lg:m-4 rounded-none lg:rounded-2xl shadow-none lg:shadow-custom flex-col items-center fixed lg:static top-0 left-0 h-[100vh] lg:h-auto max-h-[95vh] z-40 transition-transform duration-300 ease-in-out transform lg:transform-none bg-opacity-95 overflow-y-auto">
            <div class="relative group">
                <img src="{{ asset('storage/photos/woman.png') }}" class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-700 shadow-md mb-6 transition-transform duration-300 group-hover:scale-105" alt="Profile" />
                <div class="absolute inset-0 rounded-full bg-gray-500 dark:bg-gray-700 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            </div>

            <ul class="space-y-3 w-full">
                <li class="w-full py-3 flex items-center text-gray-800 dark:text-white font-semibold cursor-pointer bg-gray-200 dark:bg-gray-700 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/clerkDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-3" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-gray-800 dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/scan') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/qr-code.png') }}" class="w-8 h-8 mr-3" alt="Scan QR" />
                        Scan QR
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-gray-800 dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/manualAttendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mr-3" alt="Manual Attendance" />
                        Manual Attendance
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-gray-800 dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('clerk.leave.create') }}" class="flex items-center w-full">
                        <img src="https://media.istockphoto.com/id/1059233806/vector/man-hold-attendance-clipboard-with-checklist-questionnaire-survey-clipboard-task-list-flat.jpg?s=612x612&w=0&k=20&c=Yv3g79R_g5mMliBx4McY2Xt0k552tVZ0xHbIBO2cMx8=" class="w-8 h-8 mr-3" alt="Apply Manual Leave" />
                        Apply Leave for teacher
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-gray-800 dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('clerk.assign.duty.leave') }}" class="flex items-center w-full">
                        <img src="https://cdn-icons-png.flaticon.com/512/9882/9882238.png" class="w-8 h-8 mr-3" alt="Assign Duty Leave" />
                        Assign Duty Leave
                    </a>
                </li>
                
                <li class="mt-8 w-full py-3 flex items-center text-red-500 dark:text-red-400 font-bold cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-700 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-3" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 sm:p-6 lg:p-8 relative">
            <!-- Back Button -->
            <div class="mb-4 sm:mb-6 mt-14 sm:mt-12 lg:mt-0">
                <button onclick="history.back()" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold py-1.5 sm:py-2 px-3 sm:px-4 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300" aria-label="Go back">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 sm:w-5 h-4 sm:h-5 mr-2" alt="Back" />
                    Back
                </button>
            </div>

            <!-- User Info -->
            <div class="absolute top-4 right-4 flex items-center space-x-4 group">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-8 sm:h-10 w-8 sm:w-10 rounded-full border-2 border-gray-400 dark:border-gray-600 shadow-md transition-transform duration-300 group-hover:scale-105" alt="Profile" />
                <a href="{{ url('/show') }}" class="text-right">
                    <h3 class="font-semibold text-sm sm:text-base text-gray-800 dark:text-white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 dark:text-gray-400 text-xs sm:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>

            <!-- Welcome Section -->
            <div class="bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 p-4 sm:p-6 rounded-2xl mb-6 sm:mb-8 shadow-custom hover:shadow-custom-hover transition-shadow duration-300">
                <p class="text-gray-700 dark:text-gray-300 text-sm sm:text-base">Welcome back!</p>
                <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white">{{ Auth::user()->first_name }}</h1>
            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <div class="bg-blue-100 dark:bg-gray-800 p-4 sm:p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 dark:text-gray-300 font-semibold text-sm sm:text-base mb-2">Manual Attendance Marking</p>
                    <img src="{{ asset('storage/photos/fingerprint-scan.png') }}" class="w-10 sm:w-12 h-10 sm:h-12 mx-auto mb-4" alt="Manual Attendance" />
                    <a href="{{ url('/manualAttendance') }}" class="inline-block bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white py-1.5 sm:py-2 px-3 sm:px-4 rounded-full transition-colors duration-300 text-xs sm:text-sm">Mark Now</a>
                </div>
                <div class="bg-blue-100 dark:bg-gray-800 p-4 sm:p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 dark:text-gray-300 font-semibold text-sm sm:text-base mb-2">Live Attendance</p>
                    <img src="{{ asset('storage/photos/live.png') }}" class="w-10 sm:w-12 h-10 sm:h-12 mx-auto mb-4" alt="Live Attendance" />
                    <a href="{{ url('/liveAttendanceclerk') }}" class="inline-block bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white py-1.5 sm:py-2 px-3 sm:px-4 rounded-full transition-colors duration-300 text-xs sm:text-sm">View Now</a>
                </div>
                <div class="bg-blue-100 dark:bg-gray-800 p-4 sm:p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 dark:text-gray-300 font-semibold text-sm sm:text-base mb-2">Live Absentees</p>
                    <img src="{{ asset('storage/photos/absence.png') }}" class="w-10 sm:w-12 h-10 sm:h-12 mx-auto mb-4" alt="Live Absentees" />
                    <a href="{{ url('/absenteesclerk') }}" class="inline-block bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white py-1.5 sm:py-2 px-3 sm:px-4 rounded-full transition-colors duration-300 text-xs sm:text-sm">View Now</a>
                </div>
                <div class="bg-blue-100 dark:bg-gray-800 p-4 sm:p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 dark:text-gray-300 font-semibold text-sm sm:text-base mb-2">View Leave Applications</p>
                    <img src="{{ asset('storage/photos/leave.png') }}" class="w-10 sm:w-12 h-10 sm:h-12 mx-auto mb-4" alt="View Leave Applications" />
                    <a href="{{ url('') }}" class="inline-block bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white py-1.5 sm:py-2 px-3 sm:px-4 rounded-full transition-colors duration-300 text-xs sm:text-sm">View Now</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('hamburger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        });

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger');
            if (!sidebar.contains(event.target) && !hamburger.contains(event.target) && !sidebar.classList.contains('hidden')) {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
        });

        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('sidebar').classList.add('hidden');
                document.getElementById('sidebar').classList.remove('translate-x-0');
                document.getElementById('sidebar').classList.add('-translate-x-full');
            });
        });
    </script>
</body>

</html>