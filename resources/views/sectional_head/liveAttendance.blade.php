<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Live Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="10">

</head>

<body class="bg-gray-100 p-6">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <div
            class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="{{asset('storage/photos/boy.png')}}"
                class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/sectionheadDashboard') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/dashboard.png')}}" class="w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/liveAttendance') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/fingerprint-scan.png')}}" class="w-8 h-8 mr-2"
                            alt="Dashboard" />
                        Live Attendance</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/leave.png')}}" class="w-8 h-8 mr-2" alt="Apply Leave" />
                        Apply Leave</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Attendance" />
                        My Attendance</a>
                </li>

                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/active.png')}}" class="w-8 h-8 mr-2" alt="Notifications" />
                        Notifications</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/status.png')}}" class="w-8 h-8 mr-2"
                            alt="Leave Application" />
                        Leave Application Status</a>
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
                <a href="{{ url('/show') }}">

                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                        class="h-10 w-10 rounded-full border border-gray-400" />
                    <div>
                        <h3 class="font-semibold">
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </h3>
                        <h3 class="text-gray-600 text-sm">
                            {{ ucfirst(strtolower(Auth::user()->role)) }}
                        </h3>
                </a>
            </div>
        </div>

        <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">
                Live Present List ({{ now()->format('Y-m-d') }})
                <span class="ml-2 text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full animate-pulse">LIVE</span>
            </h2>

            <table class="w-full table-auto border-collapse border border-gray-300">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border border-gray-300">Photo</th>
                        <th class="p-2 border border-gray-300">First Name</th>
                        <th class="p-2 border border-gray-300">Last Name</th>
                        <th class="p-2 border border-gray-300">School Index</th>
                        <th class="p-2 border border-gray-300">Subjects</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $record)
                    <tr>
                        <td class="p-2 border ">
                            <img src="{{ asset('storage/' . $record->user->profile_picture) }}" alt="Profile"
                                class="w-14 h-14 self-center rounded-full border border-gray-400" />
                        </td>
                        <td class="p-2 border ">{{ $record->user->first_name }}</td>
                        <td class="p-2 border ">{{ $record->user->last_name }}</td>
                        <td class="p-2 border">{{ $record->user->school_index }}</td>
                        <td class="p-2 border">{{ $record->user->section }}</td>
                        <td class="p-2 border">
                            @foreach($record->user->subjects as $subject)
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-full">
                                {{ $subject->subject_name }}
                            </span>
                            @endforeach
                        </td>
                        <td class="p-2 border"></td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">No attendance records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>

</body>

</html>