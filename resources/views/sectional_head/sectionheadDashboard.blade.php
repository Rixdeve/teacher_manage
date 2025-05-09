<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    screens: {
                        'lg': '1000px', // Override lg breakpoint to 1000px
                    }
                }
            }
        }
    </script>
    <title>Sectional Head Dashboard</title>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar (hidden by default on mobile, toggled by hamburger) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-full z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/boy.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/sectionheadDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/liveAttendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/fingerprint-scan.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Live Attendance" />
                        Live Attendance
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('leave/create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Apply Leave" />
                        Apply Leave
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/active.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Notifications" />
                        Notifications
                    </a>
                </li>
                <li class="mt-8 lg:mt-12 w-full lg:w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
            <div class="absolute top-12 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" alt="Profile" />
                <a href="{{ url('/show') }}">
                    <h3 class="font-semibold text-sm lg:text-base">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 text-xs lg:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 rounded-lg mt-20 lg:mt-12 mb-6 relative">
                <div class="absolute top-2 right-2 flex items-center space-x-2">
                    <div class="bg-green-500 rounded-full w-3 h-3"></div>
                    <span class="text-xs lg:text-sm text-green-500 font-semibold">On Duty</span>
                </div>
                <p class="text-gray-700 text-sm lg:text-base">Welcome back!</p>
                <h1 class="text-xl lg:text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>

            <div>
                <h2 class="text-xl lg:text-2xl mb-5">Apply Leaves</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6  lg:mt-12">
                <div class="bg-blue-100 p-4 lg:p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold text-sm lg:text-base">Casual Leaves</p>
                        <img src="{{ asset('storage/photos/exit.png') }}" class="w-10 lg:w-12 h-10 lg:h-12 mb-4" alt="Casual Leave" />
                    </div>
                </div>
                <div class="bg-blue-100 p-4 lg:p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <a href="{{ url('/liveAttendance') }}">
                            <p class="text-gray-700 font-semibold text-sm lg:text-base">Live Attendance</p>
                            <img src="{{ asset('storage/photos/live.png') }}" class="w-10 lg:w-12 h-10 lg:h-12 mb-4" alt="Attendance" />
                        </a>
                    </div>
                </div>
                <div class="bg-blue-100 p-4 lg:p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <a href="{{ url('/absenteessection') }}">
                            <p class="text-gray-700 font-semibold text-sm lg:text-base">Live Absentees</p>
                            <img src="{{ asset('storage/photos/absence.png') }}" class="w-10 lg:w-12 h-10 lg:h-12 mb-4" alt="Absentees" />
                        </a>
                    </div>
                </div>
                <div class="bg-blue-100 p-4 lg:p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold text-sm lg:text-base">Medical Leave</p>
                        <img src="{{ asset('storage/photos/stress-management.png') }}" class="w-10 lg:w-12 h-10 lg:h-12 mb-4" alt="Medical Leave" />
                    </div>
                </div>
                <div class="bg-blue-100 p-4 lg:p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold text-sm lg:text-base">Short Leaves</p>
                        <img src="{{ asset('storage/photos/stopwatch.png') }}" class="w-10 lg:w-12 h-10 lg:h-12 mb-4" alt="Short Leave" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('hamburger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('sidebar').classList.add('hidden');
            });
        });
    </script>
</body>
</html>