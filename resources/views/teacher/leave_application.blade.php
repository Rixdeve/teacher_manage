<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Teacher Dashboard - Apply for Leave</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Commented Sidebar -->
        <!--
        <div class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="{{ asset('storage/photos/boy.png') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/teacherDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mr-2" alt="Apply Leave" />
                        Apply Leave
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/active.png') }}" class="w-8 h-8 mr-2" alt="Notifications" />
                        Notifications
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-8 h-8 mr-2" alt="Leave History" />
                        Leave Application Status
                    </a>
                </li>
                <li class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center w-full">
                            <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-2" alt="Logout" />
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        -->

        <!-- Main Content -->
        <div class="w-full p-8 relative">
            <button onclick="history.back()" class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-10 w-10 rounded-full border border-gray-400" />
                <a href="{{ url('/show') }}">
                    <h3 class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6 relative">
                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>

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

            <!-- Leave Balance Display -->
            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                <h2 class="text-lg font-semibold mb-2">Your Leave Balance</h2>
                <p class="text-gray-700">Casual Leave Remaining: <span class="font-bold">{{ $leaveCounter->total_casual }}</span></p>
                <p class="text-gray-700">Medical Leave Remaining: <span class="font-bold">{{ $leaveCounter->total_medical }}</span></p>
                <p class="text-gray-700">Short Leave Remaining: <span class="font-bold">{{ $leaveCounter->total_short }}</span></p>
            </div>

            <!-- Leave Application Form -->
            <div class="overflow-y-auto h-[360px]">
                <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="commence_date" class="block text-gray-700">From Date</label>
                        <input type="date" name="commence_date" id="commence_date" class="w-full p-3 mt-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700">To Date</label>
                        <input type="date" name="end_date" id="end_date" class="w-full p-3 mt-2 border rounded" required>
                    </div>

                    <div class="mb-4">
                        <label for="leave_type" class="block text-gray-700">Leave Type</label>
                        <select name="leave_type" id="leave_type" class="w-full p-3 mt-2 border rounded" required>
                            <option value="CASUAL">Casual Leave</option>
                            <option value="MEDICAL">Medical Leave</option>
                            <option value="HALF_DAY">Half Day Leave</option>
                            <option value="SHORT">Short Leave</option>
                            <option value="NO_PAY">No Pay Leave</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="reason" class="block text-gray-700">Reason</label>
                        <textarea name="reason" id="reason" rows="4" class="w-full p-3 mt-2 border rounded"></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="attachment_url_1" class="block text-gray-700">Attachment 1 (optional)</label>
                        <input type="file" name="attachment_url_1" id="attachment_url_1" class="w-full p-3 mt-2 border rounded" accept=".pdf,.jpg,.jpeg,.png">
                    </div>

                    <div class="mb-4">
                        <label for="attachment_url_2" class="block text-gray-700">Attachment 2 (optional)</label>
                        <input type="file" name="attachment_url_2" id="attachment_url_2" class="w-full p-3 mt-2 border rounded" accept=".pdf,.jpg,.jpeg,.png">
                    </div>

                    <div class="mb-4">
                        <label for="attachment_url_3" class="block text-gray-700">Attachment 3 (optional)</label>
                        <input type="file" name="attachment_url_3" id="attachment_url_3" class="w-full p-3 mt-2 border rounded" accept=".pdf,.jpg,.jpeg,.png">
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="bg-gray-500 hover:bg-gray-600 text-white p-3 rounded">Submit Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>