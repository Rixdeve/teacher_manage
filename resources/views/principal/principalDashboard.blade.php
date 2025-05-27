<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
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
    <title>Principal Dashboard | TLMS</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
    <button id="hamburger"
        class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex flex-col lg:flex-row">
        <!-- Sidebar -->
        <div id="sidebar"
            class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto z-40 bg-opacity-95 overflow-y-auto">
            <img src="{{ asset('storage/photos/boss.png') }}"
                class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Apply Leave
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Records" />
                        Leave Records
                    </a>
                </li>
                <li
                    class="mt-8 lg:mt-12 w-full lg:w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" alt="Profile" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold text-sm lg:text-base">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}
                        </h3>
                        <h3 class="text-gray-600 text-xs lg:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>

            <div class="mt-16 lg:mt-12">
                <div
                    class="bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 rounded-lg mb-4 lg:mb-6 relative">
                    <p class="text-gray-700 text-sm lg:text-base">Welcome back!</p>
                    <h1 class="text-xl lg:text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
                </div>

                <div>
                    <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 mb-4 lg:mb-6">Overview</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div
                        class="bg-blue-100 p-4 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-gray-700 font-semibold text-sm mb-2">Attendance</p>
                        <img src="{{ asset('storage/photos/fingerprint-scan.png') }}" class="w-8 h-8 mx-auto mb-2"
                            alt="Attendance" />
                        <a href="{{ url('/my_attendance') }}"
                            class="inline-block bg-gray-200 text-gray-800 py-1.5 px-3 rounded-full hover:bg-gray-300 transition-colors duration-300 text-sm">View
                            Now</a>
                    </div>
                    <div
                        class="bg-blue-100 p-4 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-gray-700 font-semibold text-sm mb-2">Live Attendance</p>
                        <img src="{{ asset('storage/photos/live.png') }}" class="w-8 h-8 mx-auto mb-2"
                            alt="Live Attendance" />
                        <a href="{{ url('/liveAttendanceprin') }}"
                            class="inline-block bg-gray-200 text-gray-800 py-1.5 px-3 rounded-full hover:bg-gray-300 transition-colors duration-300 text-sm">View
                            Now</a>
                    </div>
                    <div
                        class="bg-blue-100 p-4 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-gray-700 font-semibold text-sm mb-2">Live Absentees</p>
                        <img src="{{ asset('storage/photos/absence.png') }}" class="w-8 h-8 mx-auto mb-2"
                            alt="Live Absentees" />
                        <a href="{{ url('/absenteesprin') }}"
                            class="inline-block bg-gray-200 text-gray-800 py-1.5 px-3 rounded-full hover:bg-gray-300 transition-colors duration-300 text-sm">View
                            Now</a>
                    </div>
                    <div
                        class="bg-blue-100 p-4 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-gray-700 font-semibold text-sm mb-2">Apply Leave</p>
                        <img src="{{ asset('storage/photos/absence.png') }}" class="w-8 h-8 mx-auto mb-2"
                            alt="Absentees" />
                        <a href="{{ route('leave.create') }}"
                            class="inline-block bg-gray-200 text-gray-800 py-1.5 px-3 rounded-full hover:bg-gray-300 transition-colors duration-300 text-sm">View
                            Now</a>
                    </div>
                    <div
                        class="bg-blue-100 p-4 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-gray-700 font-semibold text-sm mb-2">Leave Records</p>
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mx-auto mb-2"
                            alt="On Leave" />
                        <a href="{{ route('leave.record') }}"
                            class="inline-block bg-gray-200 text-gray-800 py-1.5 px-3 rounded-full hover:bg-gray-300 transition-colors duration-300 text-sm">View
                            Now</a>
                    </div>
                    <div
                        class="bg-blue-100 p-4 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                        <p class="text-gray-700 font-semibold text-sm mb-2">Attendance Report</p>
                        <img src="{{ asset('storage/photos/fingerprint-scan.png') }}" class="w-8 h-8 mx-auto mb-2"
                            alt="View All" />
                        <a href="{{ url('/attendanceReport') }}"
                            class="inline-block bg-gray-200 text-gray-800 py-1.5 px-3 rounded-full hover:bg-gray-300 transition-colors duration-300 text-sm">View
                            Now</a>
                    </div>
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
            if (!sidebar.contains(event.target) && !hamburger.contains(event.target) && !sidebar.classList.contains(
                    'hidden')) {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
        });

        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.add('hidden');
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            });
        });
    </script>
</body>

</html>