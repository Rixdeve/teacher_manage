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
    <title>Attendance Report | TLMS</title>
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
        <button id="hamburger"
            class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-full shadow-md hover:shadow-custom-hover transition-shadow duration-300">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar (copied from principalDashboard) -->
        <div id="sidebar"
            class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-custom flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto z-40 bg-opacity-95 overflow-y-auto">
            <img src="{{ asset('storage/photos/boss.png') }}"
                class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white dark:border-gray-700 shadow-md mb-4"
                alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Apply Leave
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Records" />
                        Leave Records
                    </a>
                </li>
                <li
                    class="mt-8 lg:mt-12 w-full lg:w-48 py-2 flex items-center text-red-500 dark:text-red-400 font-bold cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
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
            <button onclick="history.back()"
                class="absolute top-4 lg:top-6 left-4 lg:left-6 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold py-1.5 px-3 lg:px-4 rounded-full shadow-md hover:shadow-custom-hover transition-all duration-300 flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2"
                    alt="Back" />
                Back
            </button>

            <div class="absolute top-4 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/photos/profilePic.jpg') }}"
                    class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400 dark:border-gray-600" alt="Profile" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold text-sm lg:text-base text-gray-800 dark:text-white">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 dark:text-gray-400 text-xs lg:text-sm">{{ Auth::user()->role }}</h3>
                    </a>
                </div>
            </div>

            <div class="mt-20 lg:mt-12">
                <div
                    class="bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 p-4 lg:p-6 rounded-lg mb-4 lg:mb-6 relative">
                    <p class="text-gray-700 dark:text-gray-300 text-sm lg:text-base">Welcome back!</p>
                    <h1 class="text-xl lg:text-2xl font-bold text-gray-800 dark:text-white">{{ Auth::user()->first_name }}</h1>
                </div>

                <div>
                    <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 dark:text-white mb-4 lg:mb-6">Attendance Report</h2>
                </div>

                <!-- Filter Form -->
                <div
                    class="bg-blue-100 dark:bg-gray-800 p-4 lg:p-6 rounded-2xl shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1 mb-4 lg:mb-6">
                    <form id="filter-form" method="GET" action="{{ url('/attendanceReport') }}">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Date Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                                <input type="date" name="date" value="{{ request('date') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                            <!-- Role Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role</label>
                                <select name="role"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">All Roles</option>
                                    <option value="TEACHER" {{ request('role') == 'TEACHER' ? 'selected' : '' }}>Teacher</option>
                                    <option value="PRINCIPAL" {{ request('role') == 'PRINCIPAL' ? 'selected' : '' }}>Principal</option>
                                    <option value="SECTIONAL_HEAD" {{ request('role') == 'SECTIONAL_HEAD' ? 'selected' : '' }}>
                                        Sectional Head</option>
                                </select>
                            </div>
                            <!-- User Filter -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">User</label>
                                <select name="user_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">All Users</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button type="submit"
                                class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-1.5 px-3 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-300 text-sm">
                                Apply Filters</button>
                            <a href="{{ url('/attendanceReport') }}"
                                class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-1.5 px-3 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-300 text-sm">
                                Clear Filters</a>
                            <a href="#" id="download-pdf"
                                class="inline-block bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white py-1.5 px-3 rounded-full hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors duration-300 text-sm">
                                Download PDF</a>
                        </div>
                    </form>
                </div>

                <!-- Attendance Table -->
                <div
                    class="bg-blue-100 dark:bg-gray-800 p-4 lg:p-6 rounded-2xl shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <div class="overflow-y-auto max-h-64 lg:max-h-80">
                        <table class="min-w-full table-auto border-collapse">
                            <thead class="bg-gray-200 dark:bg-gray-700 sticky top-0">
                                <tr>
                                    <th
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        ID</th>
                                    <th
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        First Name</th>
                                    <th
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        Last Name</th>
                                    <th
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        Status</th>
                                    <th
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        Date</th>
                                    <th
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        Check-in</th>
                                    <th
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        Check-out</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                                @if($attendanceRecords->isEmpty())
                                <tr>
                                    <td colspan="7"
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 text-center text-xs lg:text-sm text-gray-600 dark:text-gray-300">
                                        No attendance records found. Please apply filters to view records.
                                    </td>
                                </tr>
                                @else
                                @foreach($attendanceRecords as $record)
                                <tr class="bg-white dark:bg-gray-800">
                                    <td
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        {{ $record->id }}</td>
                                    <td
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        {{ $record->user->first_name }}</td>
                                    <td
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        {{ $record->user->last_name }}</td>
                                    <td
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        {{ $record->status }}</td>
                                    <td
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        {{ $record->date }}</td>
                                    <td
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        {{ $record->check_in_time ? \Carbon\Carbon::parse($record->check_in_time)->format('h:i A') : '' }}
                                    </td>
                                    <td
                                        class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 dark:border-gray-600 text-xs lg:text-sm text-gray-800 dark:text-white">
                                        {{ $record->check_out_time ? \Carbon\Carbon::parse($record->check_out_time)->format('h:i A') : '' }}
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Hamburger menu functionality
            document.getElementById('hamburger').addEventListener('click', function () {
                const sidebar = document.getElementById('sidebar');
                sidebar.classList.toggle('hidden');
                sidebar.classList.toggle('translate-x-0');
                sidebar.classList.toggle('-translate-x-full');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function (event) {
                const sidebar = document.getElementById('sidebar');
                const hamburger = document.getElementById('hamburger');
                if (!sidebar.contains(event.target) && !hamburger.contains(event.target) && !sidebar.classList.contains('hidden')) {
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                }
            });

            // Close sidebar on link click only for mobile (<1000px)
            document.querySelectorAll('#sidebar a').forEach(link => {
                link.addEventListener('click', function () {
                    if (window.innerWidth <= 1000) { // Match lg breakpoint
                        const sidebar = document.getElementById('sidebar');
                        sidebar.classList.add('hidden');
                        sidebar.classList.remove('translate-x-0');
                        sidebar.classList.add('-translate-x-full');
                    }
                });
            });

            // PDF Download
            document.getElementById('download-pdf').addEventListener('click', function (e) {
                e.preventDefault();
                const form = document.getElementById('filter-form');
                const formData = new FormData(form);
                const queryString = new URLSearchParams(formData).toString();
                window.location.href = '{{ url("/attendanceReport/pdf") }}?' + queryString;
            });
        </script>
    </body>
</html>