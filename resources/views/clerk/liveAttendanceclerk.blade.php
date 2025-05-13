<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Live Attendance | TLMS</title>
    @include('partials.theme')
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="10">
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
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white font-sans flex items-center justify-center min-h-screen antialiased">
    <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
    <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Sidebar (hidden by default on mobile, unchanged on desktop) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto overflow-y-auto z-40 bg-opacity-95">
            <img src="{{asset('storage/photos/boy.png')}}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

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

        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
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
                <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-4 lg:p-6">
                    <h2 class="text-xl lg:text-2xl font-bold mb-4">
                        Live Present List ({{ now()->format('Y-m-d') }})
                        <span class="ml-2 text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full animate-pulse">LIVE</span>
                    </h2>

                    <div class="overflow-x-auto">
                        <table class="w-full table-auto border-collapse border border-gray-300">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="p-2 border border-gray-300">Photo</th>
                                    <th class="p-2 border border-gray-300">First Name</th>
                                    <th class="p-2 border border-gray-300">Last Name</th>
                                    <th class="p-2 border border-gray-300">Section</th>
                                    <th class="p-2 border border-gray-300">Subjects</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attendances as $record)
                                <tr>
                                    <td class="p-2 border">
                                        <img src="{{ asset('storage/' . $record->user->profile_picture) }}" alt="Profile"
                                            class="w-10 lg:w-14 h-10 lg:h-14 self-center rounded-full border border-gray-400" />
                                    </td>
                                    <td class="p-2 border">{{ $record->user->first_name }}</td>
                                    <td class="p-2 border">{{ $record->user->last_name }}</td>
                                    <td class="p-2 border">{{ $record->user->section }}</td>
                                    <td class="p-2 border">
                                        @if(is_array($record->user->subjects))
                                        @foreach($record->user->subjects as $subject)
                                        <span class="block">{{ $subject }}</span>
                                        @endforeach
                                        @else
                                        <span class="text-gray-500 italic">No subjects</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="p-4 text-center text-gray-500">No attendance records found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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