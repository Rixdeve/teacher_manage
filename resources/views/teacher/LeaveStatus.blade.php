<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('partials.theme')
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Teacher Dashboard - Leave Status | TLMS</title>
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

<body class="bg-white text-black dark:bg-gray-900 dark:text-white flex flex-col min-h-screen">
    <div class="w-full h-full flex flex-col sm:min-h-[600px]">
        <!-- Commented Sidebar -->
        <!--
        <div class="w-full sm:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 sm:p-6 m-0 sm:m-4 rounded-none sm:rounded-xl shadow-none sm:shadow-lg flex flex-col items-center">
            <img src="{{ asset('storage/photos/boy.png') }}" class="w-20 h-20 sm:w-24 sm:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-full sm:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/teacherDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 h-6 sm:w-8 sm:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full sm:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 h-6 sm:w-8 sm:h-8 mr-2" alt="Apply Leave" />
                        Apply Leave
                    </a>
                </li>
                <li class="w-full sm:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 h-6 sm:w-8 sm:h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-full sm:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/active.png') }}" class="w-6 h-6 sm:w-8 sm:h-8 mr-2" alt="Notifications" />
                        Notifications
                    </a>
                </li>
                <li class="w-full sm:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 h-6 sm:w-8 sm:h-8 mr-2" alt="Leave Application" />
                        Leave Application Status
                    </a>
                </li>
                <li class="mt-8 sm:mt-12 w-full sm:w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center w-full">
                            <img src="{{ asset('storage/photos/logout.png') }}" class="w-6 h-6 sm:w-8 sm:h-8 mr-2" alt="Logout" />
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        -->

        <!-- Main Content -->
        <div class="w-full p-4 sm:p-6 lg:p-8 relative">
            <!-- Back Button -->
            <button onclick="history.back()" class="absolute top-4 left-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <!-- Profile Section -->
            <div class="absolute top-4 right-4 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-8 w-8 sm:h-10 sm:w-10 rounded-full border border-gray-400" alt="Profile" />
                <a href="{{ url('/show') }}">
                    <h3 class="font-semibold text-sm sm:text-base">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 text-xs sm:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>

            <!-- Welcome Section -->
            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-4 sm:p-6 rounded-lg mt-16 sm:mt-12 mb-6">
                <p class="text-gray-700 text-sm sm:text-base">Welcome back!</p>
                <h1 class="text-xl sm:text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>

            <!-- Leave History Section -->
            <div class="overflow-y-auto max-h-[400px] sm:max-h-[360px]">
                <h2 class="text-base sm:text-lg font-semibold mb-4">Your Leave History</h2>
                @if ($pastApplications->isEmpty())
                <p class="text-gray-600 text-sm sm:text-base">No past leave applications found.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm sm:text-base">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 sm:p-3 text-gray-700 font-semibold">Date Submitted</th>
                                <th class="p-2 sm:p-3 text-gray-700 font-semibold">From Date</th>
                                <th class="p-2 sm:p-3 text-gray-700 font-semibold">To Date</th>
                                <th class="p-2 sm:p-3 text-gray-700 font-semibold">Leave Type</th>
                                <th class="p-2 sm:p-3 text-gray-700 font-semibold">Reason</th>
                                <th class="p-2 sm:p-3 text-gray-700 font-semibold">Status</th>
                                <th class="p-2 sm:p-3 text-gray-700 font-semibold">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pastApplications as $application)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2 sm:p-3">{{ $application->created_at->format('Y-m-d') }}</td>
                                <td class="p-2 sm:p-3">{{ $application->commence_date }}</td>
                                <td class="p-2 sm:p-3">{{ $application->end_date }}</td>
                                <td class="p-2 sm:p-3">{{ $application->leave_type }}</td>
                                <td class="p-2 sm:p-3">{{ $application->reason ?? 'N/A' }}</td>
                                <td class="p-2 sm:p-3">
                                    <span class="inline-block px-2 py-1 rounded text-xs sm:text-sm
                                                {{ $application->latestStatus->status === 'APPROVED' ? 'bg-green-100 text-green-700' : 
                                                   ($application->latestStatus->status === 'REJECTED' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                        {{ $application->latestStatus->status }}
                                    </span>
                                </td>
                                <td class="p-2 sm:p-3">
                                    @if ($application->latestStatus->status === 'PENDING')
                                    <!-- No action for pending -->
                                    @else
                                    {{ $application->latestStatus->comment ?? 'N/A' }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>

</html>