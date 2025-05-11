<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Approved Leave Applications</title>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="w-full min-h-screen flex flex-col lg:flex-row">
        
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
            <span class="text-2xl">☰</span>
        </button>

       
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-screen max-h-screen overflow-y-auto z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/boy.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full max-h-[calc(100vh-160px)] overflow-y-auto">
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/sectionheadDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/liveAttendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/fingerprint-scan.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Live Attendance" />
                        Live Attendance
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('leave/create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Apply Leave" />
                        Apply Leave
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('sectional.approved_leaves') }}" class="flex items-center w-full">
                        <img src="https://cdn-icons-png.flaticon.com/256/14662/14662734.png" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Approved Leaves" />
                        Assign relief for approved leaves
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

   
        <div class="w-full lg:w-3/4 p-8 pt-20 lg:pt-8 relative">
            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-10 w-10 rounded-full border border-gray-400" alt="Profile">
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>
            <button onclick="history.back()" class="absolute top-16 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center lg:hidden">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back">
                Back
            </button>
            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6">
                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>
            <h1 class="text-2xl font-bold mb-6">Approved Leave Applications for Section {{ Auth::user()->section }}</h1>
            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            @if ($approvedLeaves->isEmpty())
                <p class="text-gray-600">No approved leave applications found for section {{ Auth::user()->section }}.</p>
            @else
                <div class="max-h-[500px] overflow-y-auto border border-gray-200 rounded-lg">
                    <table class="w-full border-collapse">
                        <thead class="bg-gray-200 sticky top-0 z-10">
                            <tr>
                                <th class="p-3 text-left">Teacher</th>
                                <th class="p-3 text-left">From</th>
                                <th class="p-3 text-left">To</th>
                                <th class="p-3 text-left">Type</th>
                                <th class="p-3 text-left">Reason</th>
                                <th class="p-3 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvedLeaves as $leave)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">{{ trim($leave->user->first_name . ' ' . $leave->user->last_name) }}</td>
                                    <td class="p-3">{{ $leave->commence_date }}</td>
                                    <td class="p-3">{{ $leave->end_date }}</td>
                                    <td class="p-3">{{ $leave->leave_type }}</td>
                                    <td class="p-3">{{ $leave->reason }}</td>
                                    <td class="p-3">
                                        <a href="{{ route('sectional.assign_relief', $leave->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Assign Relief</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

   
    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });

      
        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !hamburger.contains(e.target)) {
                sidebar.classList.add('hidden');
            }
        });
    </script>
</body>
</html>