<?php
if (!session()->has('school_id')) {
    return redirect('/login');
}
?>
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
    <title>School Dashboard</title>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar (hidden by default on mobile, toggled by hamburger) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-full z-40 bg-opacity-95">
            <img src="{{ asset('/storage/photos/school.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />

            <ul class="space-y-4 w-full">
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/schoolDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerPrincipal') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/boss.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Principal" />
                        Assign Principal
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerClerk') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Clerk" />
                        Assign Clerk
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerTeacher') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Teacher" />
                        Assign Teacher
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerSectionhead') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/teachernew.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Section" />
                        Assign Sectional Head
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
        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
            @php
            $school = \App\Models\School::find(session('school_id'));
            @endphp

            @if($school)
            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/photos/school2.png') }}" class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" alt="School Logo" />
                <div>
                    <h3 class="font-semibold text-sm lg:text-base">{{ $school->school_name }}</h3>
                    <h3 class="text-gray-600 text-xs lg:text-sm">School</h3>
                </div>
            </div>
            @endif

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6 relative">
                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">{{ $school->school_name }}</h1>
            </div>
            <div class="grid grid-cols-3 gap-6">
            <a href="{{ url('/manageUsers') }}">
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg hover:bg-blue-200 transition duration-300 ease-in-out">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold">Manage Users</p>
                        <img src="{{asset('storage/photos/group.png')}}" class="w-12 h-12 mb-4" alt="Manage Users" />
                    </div>
                </div>
            </a>

                <div
                    class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold text-lg mb-2">View Users</p>
                        <h3 class="text-4xl font-bold text-gray-900 mb-4">{{ $userCount }}</h3>
                        <p class="text-gray-500 text-sm">Total users currently in the system</p>
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