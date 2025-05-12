<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Assign Relief Teacher | TLMS</title>
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
</head>

<body class="bg-white font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full min-h-screen flex flex-col lg:flex-row">

        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full shadow-md hover:shadow-custom-hover transition-shadow duration-300">
            <span class="text-2xl">☰</span>
        </button>


        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-0 lg:m-4 rounded-none lg:rounded-2xl shadow-none lg:shadow-custom flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto max-h-[100vh] z-40 transition-transform duration-300 ease-in-out transform lg:transform-none bg-opacity-95 overflow-y-auto">
            <div class="relative group">
                <img src="{{ asset('storage/photos/boy.png') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-6 transition-transform duration-300 group-hover:scale-105" alt="Profile" />
                <div class="absolute inset-0 rounded-full bg-gray-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            </div>

            <ul class="space-y-3 w-full">
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/sectionheadDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-3" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/liveAttendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/fingerprint-scan.png') }}" class="w-8 h-8 mr-3" alt="Live Attendance" />
                        Live Attendance
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('leave/create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mr-3" alt="Apply Leave" />
                        Apply Leave
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-8 h-8 mr-3" alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-3" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('sectional.approved_leaves') }}" class="flex items-center w-full">
                        <img src="https://cdn-icons-png.flaticon.com/256/14662/14662734.png" class="w-8 h-8 mr-3" alt="Approved Leaves" />
                        Assign Relief
                    </a>
                </li>
                <li class="mt-8 w-full py-3 flex items-center text-red-500 font-bold cursor-pointer hover:bg-gray-300 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-3" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <div class="w-full lg:w-3/4 p-6 lg:p-8 relative">

            <div class="absolute top-4 lg:top-6 right-4 lg:right-6 flex items-center space-x-4 group">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-10 w-10 rounded-full border-2 border-gray-400 shadow-md transition-transform duration-300 group-hover:scale-105" alt="Profile" />
                <a href="{{ url('/show') }}" class="text-right">
                    <h3 class="font-semibold text-base text-gray-800">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>


            <div class="mb-4 lg:mb-6 mt-14 lg:mt-0">
                <button onclick="history.back()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300" aria-label="Go back">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                    Back
                </button>
            </div>


            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-2xl mb-8 shadow-custom hover:shadow-custom-hover transition-shadow duration-300">
                <p class="text-gray-700 text-base">Welcome back!</p>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ Auth::user()->first_name }}</h1>
            </div>


            <div>
                <h2 class="text-2xl lg:text-3xl font-semibold text-gray-800 mb-6">Assign Relief Teacher for {{ trim($leaveApplication->user->first_name . ' ' . $leaveApplication->user->last_name) }}</h2>
                <p class="text-gray-600 text-base mb-4">Note: Relief can only be assigned for today or future dates.</p>
            </div>


            @if (session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-6 shadow-custom">
                {{ session('error') }}
            </div>
            @endif


            <form action="{{ route('sectional.store_relief', $leaveApplication->id) }}" method="POST">
                @csrf
                <div class="max-h-[300px] overflow-y-auto p-4 border border-gray-200 rounded-2xl mb-6">
                    <div class="mb-4">
                        <label for="date" class="block text-gray-700 text-sm lg:text-base font-semibold">Date</label>
                        <select name="date" id="date" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Select a date</option>
                            @foreach ($dates as $date)
                            <option value="{{ $date }}">{{ $date }}</option>
                            @endforeach
                        </select>
                        @error('date')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="relief_teacher_id" class="block text-gray-700 text-sm lg:text-base font-semibold">Relief Teacher</label>
                        <select name="relief_teacher_id" id="relief_teacher_id" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">Select a teacher</option>
                            @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ trim($teacher->first_name . ' ' . $teacher->last_name) }}</option>
                            @endforeach
                        </select>
                        @error('relief_teacher_id')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="subjects" class="block text-gray-700 text-sm lg:text-base font-semibold">Subjects</label>
                        <input type="text" name="subjects" id="subjects" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="e.g., Math, Science">
                        @error('subjects')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="time_slot" class="block text-gray-700 text-sm lg:text-base font-semibold">Time Slot</label>
                        <input type="text" name="time_slot" id="time_slot" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="e.g., 08:00-10:00">
                        @error('time_slot')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="class" class="block text-gray-700 text-sm lg:text-base font-semibold">Class</label>
                        <input type="text" name="class" id="class" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required placeholder="e.g., Grade 8A">
                        @error('class')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="bg-blue-500 text-white py-3 px-6 rounded-full hover:bg-blue-600 shadow-md hover:shadow-custom-hover transition-all duration-300">Assign Relief</button>
            </form>
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