<!DOCTYPE html>
<html lang="en">

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
    <title>Teacher Dashboard | TLMS</title>
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full h-screen flex flex-col lg:flex-row">

        <button id="hamburger"
            class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full shadow-md hover:shadow-custom-hover transition-shadow duration-300">
            <span class="text-2xl">☰</span>
        </button>


        <div id="sidebar"
            class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-0 lg:m-4 rounded-none lg:rounded-2xl shadow-none lg:shadow-custom flex-col items-center fixed lg:static top-0 left-0 h-[100vh] lg:h-[100vh] max-h-[95vh] z-40 transition-transform duration-300 ease-in-out transform lg:transform-none bg-opacity-95 overflow-y-auto">
            <div class="relative group">
                <img src="{{ asset('storage/photos/boy.png') }}"
                    class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-6 transition-transform duration-300 group-hover:scale-105"
                    alt="Profile" />
                <div
                    class="absolute inset-0 rounded-full bg-gray-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300">
                </div>
            </div>

            <ul class="space-y-3 w-full">
                <li
                    class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/teacherDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-3" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li
                    class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mr-3" alt="Apply Leave" />
                        Apply Leave
                    </a>
                </li>
                <li
                    class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-3"
                            alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li
                    class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('teacher.notifications') }}" class="flex items-center w-full">
                        <img src="https://cdn-icons-png.freepik.com/256/3602/3602175.png?semt=ais_hybrid"
                            class="w-8 h-8 mr-3" alt="Notifications" />
                        Notifications
                    </a>
                </li>
                <li
                    class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-8 h-8 mr-3" alt="Leave History" />
                        Leave Application Status
                    </a>
                </li>
                <li
                    class="mt-8 w-full py-3 flex items-center text-red-500 font-bold cursor-pointer hover:bg-gray-300 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-3" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>


        <div class="w-full lg:w-3/4 p-6 lg:p-8 relative">

            <div class="mb-4 lg:mb-6 mt-14 lg:mt-0">
                <button onclick="history.back()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300"
                    aria-label="Go back">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                    Back
                </button>
            </div>


            <div class="absolute top-4 lg:top-6 right-4 lg:right-6 flex items-center space-x-4 group">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    class="h-10 w-10 rounded-full border-2 border-gray-400 shadow-md transition-transform duration-300 group-hover:scale-105"
                    alt="Profile" />
                <a href="{{ url('/show') }}" class="text-right">
                    <h3 class="font-semibold text-base text-gray-800">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}
                    </h3>
                    <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>


            <div
                class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-2xl mb-8 shadow-custom hover:shadow-custom-hover transition-shadow duration-300">
                <p class="text-gray-700 text-base">Welcome back!</p>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ Auth::user()->first_name }}</h1>
            </div>


            <div>
                <h2 class="text-2xl lg:text-3xl font-semibold text-gray-800 mb-6">Apply Leaves</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    class="bg-blue-100 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 font-semibold text-base mb-2">Casual Leaves</p>
                    <img src="{{ asset('storage/photos/exit.png') }}" class="w-12 h-12 mx-auto mb-4"
                        alt="Casual Leave" />
                    <a href="{{ route('leave.create') }}"
                        class="inline-block bg-gray-200 text-gray-800 py-2 px-4 rounded-full hover:bg-gray-300 transition-colors duration-300">Apply
                        Now</a>
                </div>
                <div
                    class="bg-blue-100 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 font-semibold text-base mb-2">Medical Leave</p>
                    <img src="{{ asset('storage/photos/stress-management.png') }}" class="w-12 h-12 mx-auto mb-4"
                        alt="Medical Leave" />
                    <a href="{{ route('leave.create') }}"
                        class="inline-block bg-gray-200 text-gray-800 py-2 px-4 rounded-full hover:bg-gray-300 transition-colors duration-300">Apply
                        Now</a>
                </div>
                <div
                    class="bg-blue-100 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 font-semibold text-base mb-2">Short Leaves</p>
                    <img src="{{ asset('storage/photos/stopwatch.png') }}" class="w-12 h-12 mx-auto mb-4"
                        alt="Short Leave" />
                    <a href="{{ route('leave.create') }}"
                        class="inline-block bg-gray-200 text-gray-800 py-2 px-4 rounded-full hover:bg-gray-300 transition-colors duration-300">Apply
                        Now</a>
                </div>
                <div
                    class="bg-blue-100 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 font-semibold text-base mb-2">View Notifications</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/4810/4810689.png" class="w-12 h-12 mx-auto mb-4"
                        alt="Earned Leave" />
                    <a href="{{ route('teacher.notifications') }}"
                        class="inline-block bg-gray-200 text-gray-800 py-2 px-4 rounded-full hover:bg-gray-300 transition-colors duration-300">View
                        Now</a>
                </div>
                <div
                    class="bg-blue-100 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 font-semibold text-base mb-2">Leave application Status</p>
                    <img src="https://cdn-icons-png.flaticon.com/512/1786/1786640.png" class="w-12 h-12 mx-auto mb-4"
                        alt="Maternity/Paternity Leave" />
                    <a href="{{  route('leave.history')  }}"
                        class="inline-block bg-gray-200 text-gray-800 py-2 px-4 rounded-full hover:bg-gray-300 transition-colors duration-300">VIew
                        Now</a>
                </div>
                <div
                    class="bg-blue-100 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <p class="text-gray-700 font-semibold text-base mb-2">My profile</p>
                    <img src="https://cdn-icons-png.flaticon.com/256/4466/4466498.png" class="w-12 h-12 mx-auto mb-4"
                        alt="Maternity/Paternity Leave" />
                    <a href="{{  route('leave.history')  }}"
                        class="inline-block bg-gray-200 text-gray-800 py-2 px-4 rounded-full hover:bg-gray-300 transition-colors duration-300">VIew
                        Now</a>
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
                document.getElementById('sidebar').classList.add('hidden');
                document.getElementById('sidebar').classList.remove('translate-x-0');
                document.getElementById('sidebar').classList.add('-translate-x-full');
            });
        });
    </script>
</body>

</html>