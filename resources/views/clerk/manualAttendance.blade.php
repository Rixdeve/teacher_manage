<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Attendance Entry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <div class="w-64 bg-white shadow-md p-4">
            <ul class="space-y-4 w-full">
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/clerkDashboard') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/dashboard.png')}}" class=" w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard</a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/scan') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/qr-code.png')}}" class="w-8 h-8 mr-2"
                            alt="Leave Application" />
                        Scan QR</a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/manualAttendance') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/leave.png')}}" class="w-8 h-8 mr-2" alt="Apply Leave" />
                        Manual Attendance</a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Attendance" />
                        View Leave Application</a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/active.png')}}" class="w-8 h-8 mr-2" alt="Notifications" />
                        Notifications</a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/status.png')}}" class="w-8 h-8 mr-2"
                            alt="Leave Application" />
                        Leave Application Status</a>
                </li>

                <li
                    class="mt-12 w-full py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/logout.png')}}" class="w-8 h-8 mr-2" alt="Logout" />
                        Logout</a>
                </li>
            </ul>
        </div>
        <div class="flex-1 p-8">
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
                        <input type="date" name="attendance_date"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                            required>
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
                                        <input type="time" name="teachers[{{ $user->id }}][check_in_time]"
                                            class="border border-gray-300 rounded px-2 py-1 w-full">
                                    </td>
                                    <td class="p-2">
                                        <input type="time" name="teachers[{{ $user->id }}][check_out_time]"
                                            class="border border-gray-300 rounded px-2 py-1 w-full">
                                    </td>
                                    <td class="p-2">
                                        <select name="teachers[{{ $user->id }}][status]"
                                            class="border border-gray-300 rounded px-2 py-1 w-full">
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
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Submit
                            Attendance</button>
                    </div>
                </form>
            </div>
        </div>
</body>

</html>