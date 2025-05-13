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
                        'lg': '1000px',
                    }
                }
            }
        }
    </script>
    <title>Principal Dashboard</title>
</head>
<body class="bg-gray-100 text-gray-900 flex items-center justify-center min-h-screen">
    <!-- Hamburger Menu -->
    <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Sidebar (unchanged) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/boss.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application Status" />
                        Apply leave
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/viewUsers') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="View Users" />
                        View Users
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="View Users" />
                        Leave Records
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
            <button onclick="history.back()" class="absolute top-24 lg:top-6 left-4 lg:left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 lg:py-2 lg:px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/photos/profilePic.jpg') }}" class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" alt="Profile" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold text-sm lg:text-base">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-xs lg:text-sm">{{ Auth::user()->role }}</h3>
                    </a>
                </div>
            </div>

            <div class="mt-32 lg:mt-8">
                <h2 class="text-xl lg:text-2xl mb-3 lg:mb-4 font-semibold">Attendance Report</h2>

                <!-- Filter Form -->
                <form id="filter-form" method="GET" action="{{ url('/attendanceReport') }}" class="mb-6 bg-gray-200 p-4 rounded-lg shadow-md">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                        <!-- Date Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date</label>
                            <input type="date" name="date" value="{{ request('date') }}" class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <!-- Role Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Role</label>
                            <select name="role" class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">All Roles</option>
                                <option value="TEACHER" {{ request('role') == 'TEACHER' ? 'selected' : '' }}>Teacher</option>
                                <option value="PRINCIPAL" {{ request('role') == 'PRINCIPAL' ? 'selected' : '' }}>Principal</option>
                                <option value="SECTIONAL_HEAD" {{ request('role') == 'SECTIONAL_HEAD' ? 'selected' : '' }}>Sectional Head</option>
                            </select>
                        </div>
                        <!-- User Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">User</label>
                            <select name="user_id" class="mt-1 block w-full rounded-md border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500">
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
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Apply Filters</button>
                        <a href="{{ url('/attendanceReport') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-lg">Clear Filters</a>
                        <a href="#" id="download-pdf" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Download PDF</a>
                    </div>
                </form>

                <!-- Compact Attendance Table -->
                <div class="overflow-y-auto max-h-64 lg:max-h-80 border border-gray-300 rounded-lg">
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gray-200 sticky top-0">
                            <tr>
                                <th class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 text-xs lg:text-sm">ID</th>
                                <th class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 text-xs lg:text-sm">First Name</th>
                                <th class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 text-xs lg:text-sm">Last Name</th>
                                <th class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 text-xs lg:text-sm">Status</th>
                                <th class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 text-xs lg:text-sm">Date</th>
                                <th class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 text-xs lg:text-sm">Check-in</th>
                                <th class="px-2 lg:px-3 py-1 lg:py-1.5 text-left border border-gray-300 text-xs lg:text-sm">Check-out</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @if($attendanceRecords->isEmpty())
                                <tr>
                                    <td colspan="7" class="px-2 lg:px-3 py-1 lg:py-1.5 text-center text-xs lg:text-sm text-gray-600">
                                        No attendance records found. Please apply filters to view records.
                                    </td>
                                </tr>
                            @else
                                @foreach($attendanceRecords as $record)
                                    <tr class="bg-white">
                                        <td class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 text-xs lg:text-sm">{{ $record->id }}</td>
                                        <td class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 text-xs lg:text-sm">{{ $record->user->first_name }}</td>
                                        <td class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 text-xs lg:text-sm">{{ $record->user->last_name }}</td>
                                        <td class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 text-xs lg:text-sm">{{ $record->status }}</td>
                                        <td class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 text-xs lg:text-sm">{{ $record->date }}</td>
                                        <td class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 text-xs lg:text-sm">
                                            {{ $record->check_in_time ? \Carbon\Carbon::parse($record->check_in_time)->format('h:i A') : '' }}
                                        </td>
                                        <td class="px-2 lg:px-3 py-1 lg:py-1.5 border border-gray-300 text-xs lg:text-sm">
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
        // Sidebar toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });
        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('sidebar').classList.add('hidden');
            });
        });

        // PDF Download
        document.getElementById('download-pdf').addEventListener('click', function(e) {
            e.preventDefault();
            const form = document.getElementById('filter-form');
            const formData = new FormData(form);
            const queryString = new URLSearchParams(formData).toString();
            window.location.href = '{{ url("/attendanceReport/pdf") }}?' + queryString;
        });
    </script>
</body>
</html>