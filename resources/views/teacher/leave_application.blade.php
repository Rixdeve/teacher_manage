<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />'
    @include('partials.theme')
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    screens: {
                        'lg': '1000px',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    boxShadow: {
                        'custom': '0 4px 20px rgba(0, 0, 0, 0.1)',
                        'custom-hover': '0 6px 30px rgba(0, 0, 0, 0.15)',
                    },
                }
            }
        }
    </script>

    <title>Teacher Dashboard - Apply for Leave | TLMS</title>
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white flex flex-col min-h-screen">
    <div class="w-full h-full flex flex-col sm:min-h-[600px]">
        <!-- Main Content -->
        <div class="w-full p-4 sm:p-6 lg:p-8 relative">
            <!-- Back Button -->
            <button onclick="history.back()"
                class="absolute top-4 left-4 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <!-- Profile Section -->
            <div class="absolute top-4 right-4 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    class="h-8 w-8 sm:h-10 sm:w-10 rounded-full border border-gray-400" alt="Profile" />
                <a href="{{ url('/show') }}">
                    <h3 class="font-semibold text-sm sm:text-base">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}
                    </h3>
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

            <!-- Leave Balance Display -->
            <div class="bg-gray-100 p-4 rounded-lg mb-6">
                <h2 class="text-base sm:text-lg font-semibold mb-2">Your Leave Balance</h2>
                <p class="text-gray-700 text-sm sm:text-base">Casual Leave Remaining: <span
                        class="font-bold">{{ $leaveCounter->total_casual }}</span></p>
                <p class="text-gray-700 text-sm sm:text-base">Medical Leave Remaining: <span
                        class="font-bold">{{ $leaveCounter->total_medical }}</span></p>
                <p class="text-gray-700 text-sm sm:text-base">Short Leave Remaining: <span
                        class="font-bold">{{ $leaveCounter->total_short }}</span></p>
            </div>

            <!-- Leave Application Form -->
            <div class="overflow-y-auto max-h-[400px] sm:max-h-[360px]">
                <form action="{{ route('leave.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="commence_date" class="block text-gray-700 text-sm sm:text-base">From Date</label>
                        <input type="date" name="commence_date" id="commence_date"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" required>
                        @error('commence_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700 text-sm sm:text-base">To Date</label>
                        <input type="date" name="end_date" id="end_date"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" required>
                        @error('end_date')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="leave_type" class="block text-gray-700 text-sm sm:text-base">Leave Type</label>
                        <select name="leave_type" id="leave_type"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" required>
                            <option value="CASUAL">Casual Leave</option>
                            <option value="MEDICAL">Medical Leave</option>
                            <option value="SHORT">Short Leave</option>
                        </select>
                        @error('leave_type')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="reason" class="block text-gray-700 text-sm sm:text-base">Reason</label>
                        <textarea name="reason" id="reason" rows="4"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base"></textarea>
                        @error('reason')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="attachments" class="block text-gray-700 text-sm sm:text-base">Attachments (Up to 3,
                            Optional, PDF/JPG/PNG, Max 2MB each)</label>
                        <input type="file" name="attachments[]" id="attachments"
                            class="w-full p-3 mt-2 border rounded text-sm sm:text-base" accept=".pdf,.jpg,.jpeg,.png"
                            multiple onchange="limitFiles(this)">
                        <script>
                            function limitFiles(input) {
                                if (input.files.length > 3) {
                                    alert('You can only upload a maximum of 3 files.');
                                    input.value = '';
                                }
                            }
                        </script>
                        @error('attachments.*')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
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
</body>

</html>