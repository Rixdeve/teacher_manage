<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Assign Duty Leave</title>
</head>
<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
    <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Sidebar -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto overflow-y-auto z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/woman.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/clerkDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/scan') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/qr-code.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Scan QR" />
                        Scan QR
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('/manualAttendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Manual Attendance" />
                        Manual Attendance
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ route('clerk.leave.create') }}" class="flex items-center w-full">
                        <img src="https://media.istockphoto.com/id/1059233806/vector/man-hold-attendance-clipboard-with-checklist-questionnaire-survey-clipboard-task-list-flat.jpg?s=612x612&w=0&k=20&c=Yv3g79R_g5mMliBx4McY2Xt0k552tVZ0xHbIBO2cMx8=" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Apply Manual Leave" />
                        Apply Leave for Teacher
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer bg-gray-200 rounded-lg p-2">
                    <a href="{{ route('clerk.assign.duty.leave') }}" class="flex items-center w-full">
                        <img src="https://cdn-icons-png.flaticon.com/512/9882/9882238.png" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Duty Leave" />
                        Assign Duty Leave
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="View Leave Application" />
                        View Leave Application
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/active.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Notifications" />
                        Notifications
                    </a>
                </li>
                <li class="w-full py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li class="mt-8 lg:mt-12 w-full py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
            <!-- Back Button -->
            <button onclick="history.back()" class="absolute top-6 left-16 lg:left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center z-40">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <!-- User Profile -->
            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold text-sm lg:text-base">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-xs lg:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>

            <!-- Form Content -->
            <div class="mt-32 lg:mt-12 max-w-2xl mx-auto">
                <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 rounded-lg mb-4 lg:mb-6">
                    <p class="text-gray-700 text-sm lg:text-base">Welcome back!</p>
                    <h1 class="text-xl lg:text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
                </div>

                <h1 class="text-xl lg:text-2xl font-bold mb-6">Assign Duty Leave</h1>

                @if (session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="max-h-[500px] overflow-y-auto bg-white p-4 lg:p-6 rounded-lg shadow-md">
                    <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="leave_type" value="DUTY">

                        <div>
                            <label for="user_id" class="block text-xs lg:text-sm font-medium text-gray-700">Select Teacher</label>
                            <select name="user_id" id="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm" required>
                                <option value="">Select a teacher</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('user_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="commence_date" class="block text-xs lg:text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" name="commence_date" id="commence_date" value="{{ old('commence_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm" required>
                            @error('commence_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block text-xs lg:text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm" required>
                            @error('end_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="reason" class="block text-xs lg:text-sm font-medium text-gray-700">Reason (Optional)</label>
                            <textarea name="reason" id="reason" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm" placeholder="Enter the reason for duty leave">{{ old('reason') }}</textarea>
                            @error('reason')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="attachments" class="block text-xs lg:text-sm font-medium text-gray-700">Attachments (Up to 3, Optional, PDF/JPG/PNG, Max 2MB each)</label>
                            <input type="file" name="attachments[]" id="attachments" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm" accept=".pdf,.jpg,.jpeg,.png" onchange="limitFiles(this)">
                            <script>
                                function limitFiles(input) {
                                    const files = Array.from(input.files).filter(file => file.size > 0);
                                    if (files.length > 3) {
                                        alert('You can only upload a maximum of 3 files.');
                                        input.value = '';
                                    } else if (files.length === 0) {
                                        input.value = '';
                                    }
                                }
                            </script>
                            @error('attachments.*')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-gradient-to-b from-blue-100 to-gray-500 text-white px-4 lg:px-6 py-1.5 lg:py-2 rounded-lg hover:bg-blue-600 text-sm lg:text-base">Assign Duty Leave</button>
                        </div>
                    </form>
                </div>
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