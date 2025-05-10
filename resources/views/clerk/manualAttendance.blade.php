<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Attendance Entry</title>
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
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
    <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Sidebar (hidden by default on mobile, adjusted for desktop) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-white lg:bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-md flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto overflow-y-auto z-40 bg-opacity-95">
            <img src="{{asset('storage/photos/woman.png')}}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/clerkDashboard') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/dashboard.png')}}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/scan') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/qr-code.png')}}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application" />
                        Scan QR
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/manualAttendance') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/leave.png')}}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Apply Leave" />
                        Manual Attendance
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ route('clerk.leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave_application.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application" />
                        Apply Leave for Teacher
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        View Leave Application
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/active.png')}}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Notifications" />
                        Notifications
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/status.png')}}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application" />
                        Leave Application Status
                    </a>
                </li>
                <li class="mt-8 lg:mt-12 w-full py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/logout.png')}}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <div class="flex-1 lg:w-3/4 p-4 lg:p-8 relative">
            <button onclick="history.back()" class="hidden lg:block absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold text-sm lg:text-base">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-xs lg:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>

            <div class="mt-32 lg:mt-12">
                <div class="max-w-6xl mx-auto p-6 bg-white rounded shadow">
                    <h2 class="text-2xl font-bold mb-6">Manual Attendance Entry</h2>

                    @if(session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                        {{ session('error') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('attendance.store') }}">
                        @csrf

                        <!-- Date Picker -->
                        <div class="mb-4">
                            <label for="attendance_date" class="block text-gray-700 font-medium mb-2">Select Date:</label>
                            <input type="date" name="attendance_date" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200" required>
                        </div>

                        <!-- Attendance Table -->
                        <div class="overflow-y-auto max-h-[600px] border border-gray-300 rounded-lg">
                            <table class="min-w-full table-auto border-collapse">
                                <thead>
                                    <tr class="bg-gray-100">
                                        <th class="p-2 text-left">Teacher ID</th>
                                        <th class="p-2 text-left">Name</th>
                                        <th class="p-2 text-left">Check-In</th>
                                        <th class="p-2 text-left">Check-Out</th>
                                        <th class="p-2 text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachersAndPrincipals as $user)
                                    <tr class="border-b">
                                        <td class="p-2">{{ $user->id }}</td>
                                        <td class="p-2">{{ $user->first_name }} {{ $user->last_name }} </td>
                                        <td class="p-2">
                                            <input type="time" name="teachers[{{ $user->id }}][check_in_time]" class="border border-gray-300 rounded px-2 py-1 w-full">
                                        </td>
                                        <td class="p-2">
                                            <input type="time" name="teachers[{{ $user->id }}][check_out_time]" class="border border-gray-300 rounded px-2 py-1 w-full">
                                        </td>
                                        <td class="p-2">
                                            <select name="teachers[{{ $user->id }}][status]" class="border border-gray-300 rounded px-2 py-1 w-full">
                                                <option value="PRESENT">Present</option>
                                                <option value="ABSENT">Absent</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-6">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Submit Attendance</button>
                        </div>
                    </form>
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