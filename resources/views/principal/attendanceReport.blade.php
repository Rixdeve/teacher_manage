<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Principal Dashboard</title>
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

        <div class="w-3/4 p-8 relative">
            <button onclick="history.back()"
                class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{asset('storage/photos/profilePic.jpg')}}"
                    class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </h3>
                        <h3 class="text-gray-600 text-sm">{{ Auth::user()->role }}</h3>
                    </a>
                </div>
            </div>



            <div class="mt-8">
                <h2 class="text-2xl mb-4 font-semibold">All Attendance Records</h2>
                <div class="overflow-y-auto max-h-96 border border-gray-300 rounded-lg">
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gray-200 sticky top-0">
                            <tr>
                                <th class="px-4 py-2 text-left border border-gray-300">ID</th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    Method
                                </th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    User ID
                                </th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    First Name
                                </th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    Last Name
                                </th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    Status
                                </th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    Date
                                </th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    Check-in Time
                                </th>
                                <th class="px-4 py-2 text-left border border-gray-300">
                                    Check-out Time
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300">
                            @foreach($attendanceRecords as $record)
                            <tr>
                                <td class="px-4 py-2 border border-gray-300">{{ $record->id }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $record->method }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $record->user_id }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $record->user->first_name }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $record->user->last_name }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $record->status }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $record->date }}</td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ \Carbon\Carbon::parse($record->check_in_time)->format('h:i A') }}
                                </td>
                                <td class="px-4 py-2 border border-gray-300">
                                    {{ \Carbon\Carbon::parse($record->check_out_time)->format('h:i A') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>