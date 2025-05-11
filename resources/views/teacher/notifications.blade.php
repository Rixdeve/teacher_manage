<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Notifications</title>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="w-full h-screen flex flex-col lg:flex-row">
       
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
            <span class="text-2xl">☰</span>
        </button>

        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-full z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/boy.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/teacherDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Apply Leave" />
                        Apply Leave
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
    <a href="{{ route('teacher.notifications') }}" class="flex items-center w-full">
        <img src="https://cdn-icons-png.freepik.com/256/3602/3602175.png?semt=ais_hybrid" class="w-8 h-8 mr-2" alt="Notifications">
        Notifications
    </a>
</li>

                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave History" />
                        Leave Application Status
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

        <div class="w-3/4 p-8 relative">
            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-10 w-10 rounded-full border border-gray-400">
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>
            <button onclick="history.back()" class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back">
                Back
            </button>
            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6">
                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>
            <h1 class="text-2xl font-bold mb-6">Notifications</h1>
            @if ($notifications->isEmpty())
                <p class="text-gray-600">No notifications found.</p>
            @else
                <div class="space-y-4">
                    @foreach ($notifications as $notification)
                        <div class="bg-white border rounded-lg p-4 shadow-sm {{ $notification->read ? 'opacity-75' : 'bg-blue-50' }}">
                            <h3 class="text-lg font-semibold">{{ $notification->title }}</h3>
                            <p class="text-gray-700">{{ $notification->message }}</p>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->format('Y-m-d H:i:s') }}</p>
                            @if (!$notification->read)
                                <form action="{{ route('teacher.notifications') }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                    <button type="submit" class="text-blue-500 hover:underline text-sm">Mark as Read</button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>
</html>