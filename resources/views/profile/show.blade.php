<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile</title>
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
</head>
<body class="bg-gray-100">
    <button onclick="history.back()" class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 lg:py-2 px-3 lg:px-4 rounded-lg shadow-md flex items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2" alt="Back" />
        Back
    </button>
    <div class="min-h-screen flex justify-center items-start py-6 lg:py-12 px-2 sm:px-4 lg:px-8">
        <div class="bg-white p-4 lg:p-8 rounded-lg shadow-lg w-full max-w-md lg:max-w-4xl mt-20 lg:mt-12">
            <div class="flex flex-col lg:flex-row justify-between items-center mb-3 lg:mb-8">
                <h1 class="text-2xl lg:text-3xl font-semibold text-gray-800 text-center lg:text-left">
                    Welcome, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                </h1>
                <div class="w-12 lg:w-16 h-12 lg:h-16 bg-gray-300 rounded-full overflow-hidden mt-3 lg:mt-0">
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-full h-full object-cover" />
                </div>
            </div>

            <div class="bg-gray-50 p-3 lg:p-6 rounded-lg shadow-sm mb-3 lg:mb-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-800 mb-2 lg:mb-4">Account Details</h2>
                <div class="space-y-2 lg:space-y-4">
                    <div>
                        <p class="text-base lg:text-lg text-gray-700">
                            Email: <span class="text-gray-600">{{ Auth::user()->user_email }}</span>
                        </p>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-between items-center">
                        <p class="text-base lg:text-lg text-gray-700">
                            Password: <span class="text-gray-600">************</span>
                        </p>
                        <a href="{{ route('password.change') }}" class="bg-gray-500 text-white py-1 px-2 lg:px-4 rounded-md text-sm hover:bg-gray-600 mt-2 lg:mt-0">
                            Update password
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 p-3 lg:p-6 rounded-lg shadow-sm">
                <div class="flex flex-col lg:flex-row justify-between items-center mb-2 lg:mb-4">
                    <h2 class="text-lg lg:text-xl font-semibold text-gray-800">User Details</h2>
                    <!-- <a href="{{ route('profile.edit') }}" class="bg-gray-500 text-white py-1 px-2 lg:px-4 rounded-md text-sm hover:bg-gray-600 mt-2 lg:mt-0">
                        Edit Details
                    </a> -->
                </div>
                <div class="space-y-2 lg:space-y-3">
                    <p class="text-base lg:text-lg text-gray-700">Name: <span class="text-gray-600">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></p>
                    <p class="text-base lg:text-lg text-gray-700">Date of Birth: <span class="text-gray-600">{{ Auth::user()->user_dob }}</span></p>
                    <p class="text-base lg:text-lg text-gray-700">Address: <span class="text-gray-600">{{ Auth::user()->user_address_no }}, {{ Auth::user()->user_address_street }}, {{ Auth::user()->user_address_city }}</span></p>
                    <p class="text-base lg:text-lg text-gray-700">Contact Number: <span class="text-gray-600">{{ Auth::user()->user_phone }}</span></p>
                    <p class="text-base lg:text-lg text-gray-700">Email: <span class="text-gray-600">{{ Auth::user()->user_email }}</span></p>
                    <p class="text-base lg:text-lg text-gray-700">NIC: <span class="text-gray-600">{{ Auth::user()->user_nic }}</span></p>
                    <p class="text-base lg:text-lg text-gray-700">School Index: <span class="text-gray-600">{{ Auth::user()->school_index }}</span></p>
                    <p class="text-base lg:text-lg text-gray-700">Role: <span class="text-gray-600">{{ ucfirst(strtolower(Auth::user()->role)) }}</span></p>
                    @if (Auth::user()->section)
                    <p class="text-base lg:text-lg text-gray-700">Section: <span class="text-gray-600">{{ Auth::user()->section }}</span></p>
                    @endif
                    @if (!empty($user->subjects) && is_array($user->subjects))
                    <p class="text-base lg:text-lg text-gray-700 mb-1 lg:mb-2 font-medium">Subjects:</p>
                    <div class="flex flex-wrap gap-1 lg:gap-2 mb-2 lg:mb-4">
                        @foreach ($user->subjects as $subject)
                        <span class="text-base lg:text-lg text-gray-700">{{ $subject }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="bg-blue-50 p-3 lg:p-6 rounded-lg shadow mt-3 lg:mt-6">
                <h2 class="text-lg lg:text-xl font-semibold text-gray-800 mb-1 lg:mb-2">Duty Status Today</h2>
                @php
                $attendance = Auth::user()->attendances->where('date', today()->toDateString())->first();
                @endphp
                @if ($attendance)
                <p class="text-base lg:text-lg text-gray-700">Status: <span class="font-semibold text-blue-700">{{ $attendance->status }}</span></p>
                <p class="text-base lg:text-lg text-gray-700">Check-In: <span class="text-gray-600">{{ $attendance->check_in_time ?? '—' }}</span></p>
                <p class="text-base lg:text-lg text-gray-700">Check-Out: <span class="text-gray-600">{{ $attendance->check_out_time ?? '—' }}</span></p>
                @else
                <p class="text-red-600 font-medium text-base lg:text-lg">Attendance not marked yet today.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>