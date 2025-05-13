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
                    'lg': '1000px', // Override lg breakpoint to 1000px
                }
            }
        }
    }
    </script>
    <title>Clerk Dashboard - Manual Leave Application | TLMS</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
    <button id="hamburger"
        class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Sidebar (hidden by default on mobile, unchanged on desktop) -->
        <div id="sidebar"
            class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto overflow-y-auto z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/woman.png') }}"
                class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/clerkDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/scan') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/qr-code.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Scan QR" />
                        Scan QR
                    </a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/manualAttendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Manual Attendance" />
                        Manual Attendance
                    </a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ route('clerk.leave.create') }}" class="flex items-center w-full">
                        <img src="https://media.istockphoto.com/id/1059233806/vector/man-hold-attendance-clipboard-with-checklist-questionnaire-survey-clipboard-task-list-flat.jpg?s=612x612&w=0&k=20&c=Yv3g79R_g5mMliBx4McY2Xt0k552tVZ0xHbIBO2cMx8="
                            class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Apply Manual Leave" />
                        Apply Leave for teacher
                    </a>
                </li>
                <li
                    class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ route('clerk.assign.duty.leave') }}" class="flex items-center w-full">
                        <img src="https://cdn-icons-png.flaticon.com/512/9882/9882238.png" class="w-8 h-8 mr-3"
                            alt="Assign Duty Leave" />
                        Assign Duty Leave
                    </a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="View Leave Application" />
                        View Leave Application
                    </a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/active.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Notifications" />
                        Notifications
                    </a>
                </li>
                <li
                    class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li
                    class="mt-8 lg:mt-12 w-full py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 sm:p-6 lg:p-8 relative">
            <!-- Back Button (adjusted for sidebar overlap on mobile) -->
            <button onclick="history.back()"
                class="absolute top-6 left-16 lg:left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center z-40">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <!-- Profile Section -->
            <div class="absolute top-6 right-4 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    class="h-8 w-8 sm:h-10 sm:w-10 rounded-full border border-gray-400" alt="Profile" />
                <a href="{{ url('/show') }}">
                    <h3 class="font-semibold text-sm sm:text-base">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 text-xs sm:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>

            <!-- Welcome Section -->
            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-4 sm:p-6 rounded-lg mt-16 sm:mt-12 mb-6">
                <p class="text-gray-700 text-sm sm:text-base">Welcome back!</p>
                <h1 class="text-xl sm:text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>

            <!-- Error/Success Messages -->
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

            <!-- Manual Leave Application Form -->
            <div class="overflow-y-auto max-h-[400px] sm:max-h-[360px]">
                <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block text-gray-700 text-sm sm:text-base">Select User</label>
                        <select name="user_id" id="user_id" class="w-full p-3 mt-2 border rounded text-sm sm:text-base"
                            required>
                            <option value="">Select a user</option>
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}
                                ({{ ucfirst(strtolower($user->role)) }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="commence_date" class="block text-gray-700 text-sm sm:text-base">From Date</label>
                        <input type="date" name="commence_date" id="commence_date"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" required>
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700 text-sm sm:text-base">To Date</label>
                        <input type="date" name="end_date" id="end_date"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" required>
                    </div>

                    <div class="mb-4">
                        <label for="leave_type" class="block text-gray-700 text-sm sm:text-base">Leave Type</label>
                        <select name="leave_type" id="leave_type"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" required>
                            <option value="CASUAL">Casual Leave</option>
                            <option value="MEDICAL">Medical Leave</option>
                            <option value="SHORT">Short Leave</option>

                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="reason" class="block text-gray-700 text-sm sm:text-base">Reason</label>
                        <textarea name="reason" id="reason" rows="4"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="attachments" class="block text-gray-700 text-sm sm:text-base">Attachments (up to 3,
                            optional)</label>
                        <input type="file" name="attachments[]" id="attachments"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" accept=".pdf,.jpg,.jpeg,.png"
                            multiple>
                    </div>

                    <div class="mb-4">
                        <button type="submit"
                            class="bg-gray-500 hover:bg-gray-600 text-white p-3 rounded w-full sm:w-auto text-sm sm:text-base">Submit
                            Application</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('hamburger').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });
    document.querySelectorAll('#sidebar a').forEach(link => {
        link.addEventListener('click', function() {
            document.getElementById('sidebar').classList.add('hidden');
        });
    });
    </script>
</body>

</html>