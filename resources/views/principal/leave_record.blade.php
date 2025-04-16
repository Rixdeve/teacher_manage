<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Leave Record - Principal</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <div
            class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="{{asset('storage/photos/boss.png')}}"
                class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">

                        <img src="{{asset('storage/photos/dashboard.png')}}" class="w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard</a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mr-2" alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Attendance" />
                        Attendance Report</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Attendance" />
                        My Attendance</a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/folder.png') }}" class="w-8 h-8 mr-2" alt="Leave Application Status" />
                    Apply leave
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-8 h-8 mr-2" alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/viewUsers') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/classroom.png')}}" class="w-8 h-8 mr-2" alt="View Users" />
                        View Users</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/classroom.png')}}" class="w-8 h-8 mr-2" alt="View Users" />
                        Leave Records</a>
                </li>
                <li
                    class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/logout.png')}}" class="w-8 h-8 mr-2" alt="Logout" />
                        Logout</a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-3/4 p-8 relative">
            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>

            <button onclick="history.back()" class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6 relative">
                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>

            <!-- Leave Record Table -->
            <h1 class="text-2xl font-bold mb-6">Approved Leave Record</h1>

            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($approvedLeaves->isEmpty())
                <p class="text-gray-600">No approved leave records found.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-left">Applicant</th>
                                <th class="p-3 text-left">Role</th>
                                <th class="p-3 text-left">From</th>
                                <th class="p-3 text-left">To</th>
                                <th class="p-3 text-left">Days</th>
                                <th class="p-3 text-left">Type</th>
                                <th class="p-3 text-left">Reason</th>
                                <th class="p-3 text-left">Attachments</th>
                                <th class="p-3 text-left">Approved At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvedLeaves as $leave)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">
                                        {{ $leave->user ? $leave->user->first_name . ' ' . $leave->user->last_name : 'Unknown User' }}
                                        @if ($leave->user_id == Auth::id())
                                            <span class="text-blue-500 text-sm">(You)</span>
                                        @endif
                                    </td>
                                    <td class="p-3">{{ $leave->user ? ucfirst(strtolower($leave->user->role)) : 'N/A' }}</td>
                                    <td class="p-3">{{ $leave->commence_date }}</td>
                                    <td class="p-3">{{ $leave->end_date }}</td>
                                    <td class="p-3">{{ $leave->leave_days }}</td>
                                    <td class="p-3">{{ $leave->leave_type }}</td>
                                    <td class="p-3">{{ $leave->reason ?? 'N/A' }}</td>
                                    <td class="p-3">
                                        @if ($leave->attachment_url_1)
                                            <a href="{{ asset('storage/' . $leave->attachment_url_1) }}" class="text-blue-500 hover:underline" target="_blank">File 1</a>
                                        @endif
                                        @if ($leave->attachment_url_2)
                                            <a href="{{ asset('storage/' . $leave->attachment_url_2) }}" class="text-blue-500 hover:underline" target="_blank">File 2</a>
                                        @endif
                                        @if ($leave->attachment_url_3)
                                            <a href="{{ asset('storage/' . $leave->attachment_url_3) }}" class="text-blue-500 hover:underline" target="_blank">File 3</a>
                                        @endif
                                        @if (!$leave->attachment_url_1 && !$leave->attachment_url_2 && !$leave->attachment_url_3)
                                            None
                                        @endif
                                    </td>
                                    <td class="p-3">{{ $leave->latestStatus->updated_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $approvedLeaves->links() }}
                </div>
            @endif
        </div>
    </div>
</body>

</html>