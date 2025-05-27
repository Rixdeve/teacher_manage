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
    <title>Apply for Leave - Principal | TLMS</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
    <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Sidebar (hidden by default on mobile, unchanged on desktop) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/boss.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application Status" />
                        Apply leave
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="View Users" />
                        Leave Records
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

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 px-4 lg:px-6 py-6 lg:py-8 overflow-y-auto h-full relative">
            <button onclick="history.back()" class="absolute top-24 lg:top-6 left-4 lg:left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 lg:py-2 lg:px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold text-sm lg:text-base">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-xs lg:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>

            <div class="mt-32 lg:mt-12">
                <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 rounded-lg mb-4 lg:mb-6 relative">
                    <p class="text-gray-700 text-sm lg:text-base">Welcome back!</p>
                    <h1 class="text-xl lg:text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
                </div>

                <h1 class="text-xl lg:text-2xl font-bold mb-4 lg:mb-6">Apply for Leave</h1>

                @if (session('success'))
                <div class="bg-green-100 text-green-700 p-3 lg:p-4 rounded mb-3 lg:mb-4">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('error'))
                <div class="bg-red-100 text-red-700 p-3 lg:p-4 rounded mb-3 lg:mb-4">
                    {{ session('error') }}
                </div>
                @endif

                <div class="bg-gray-100 p-3 lg:p-4 rounded mb-4 lg:mb-6">
                    <h2 class="text-base lg:text-lg font-semibold mb-1 lg:mb-2">Your Leave Balance</h2>
                    <p class="text-sm lg:text-base"><strong>Casual Leave Remaining:</strong> {{ $leaveCounter->total_casual }}</p>
                    <p class="text-sm lg:text-base"><strong>Medical Leave Remaining:</strong> {{ $leaveCounter->total_medical }}</p>
                    <p class="text-sm lg:text-base"><strong>Short Leave Remaining:</strong> {{ $leaveCounter->total_short }}</p>
                </div>

                <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3 lg:space-y-4">
                    @csrf

                    <div>
                        <label for="commence_date" class="block text-xs lg:text-sm font-medium text-gray-700">Commence Date</label>
                        <input type="date" name="commence_date" id="commence_date" value="{{ old('commence_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm">
                        @error('commence_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-xs lg:text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm">
                        @error('end_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="leave_type" class="block text-xs lg:text-sm font-medium text-gray-700">Leave Type</label>
                        <select name="leave_type" id="leave_type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm">
                            <option value="CASUAL" {{ old('leave_type') == 'CASUAL' ? 'selected' : '' }}>Casual</option>
                            <option value="MEDICAL" {{ old('leave_type') == 'MEDICAL' ? 'selected' : '' }}>Medical</option>
                            <option value="SHORT" {{ old('leave_type') == 'SHORT' ? 'selected' : '' }}>Short</option>
                        </select>
                        @error('leave_type')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="reason" class="block text-xs lg:text-sm font-medium text-gray-700">Reason (Optional)</label>
                        <textarea name="reason" id="reason" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm">{{ old('reason') }}</textarea>
                        @error('reason')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="attachments" class="block text-xs lg:text-sm font-medium text-gray-700">Attachments (Up to 3, Optional)</label>
                        <input type="file" name="attachments[]" id="attachments" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-xs lg:text-sm" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        @error('attachments')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="bg-gradient-to-b from-blue-100 to-gray-500 text-white px-3 lg:px-4 py-1.5 lg:py-2 rounded hover:bg-blue-600 text-sm lg:text-base">Submit Application</button>
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