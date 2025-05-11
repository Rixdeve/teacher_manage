<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300 flex items-center justify-center min-h-screen">
<div class="bg-white shadow-lg rounded-lg w-full h-screen flex">

    {{-- Sidebar --}}
    <div class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
        <img src="{{ asset('/storage/photos/school.png') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />
        <ul class="space-y-4 w-full">
            <li class="w-48 py-2 flex items-center text-black font-semibold hover:bg-gray-200 rounded-lg p-2 mx-auto">
                <a href="{{ url('/schoolDashboard') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-2" alt="Dashboard" />
                    Dashboard
                </a>
            </li>
            <li class="w-48 py-2 flex items-center text-black font-semibold hover:bg-gray-200 rounded-lg p-2 mx-auto">
                <a href="{{ url('/registerPrincipal') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/boss.png') }}" class="w-8 h-8 mr-2" alt="Assign Principal" />
                    Assign Principal
                </a>
            </li>
            <li class="w-48 py-2 flex items-center text-black font-semibold hover:bg-gray-200 rounded-lg p-2 mx-auto">
                <a href="{{ url('/registerClerk') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-2" alt="Assign Clerk" />
                    Assign Clerk
                </a>
            </li>
            <li class="w-48 py-2 flex items-center text-black font-semibold hover:bg-gray-200 rounded-lg p-2 mx-auto">
                <a href="{{ url('/registerTeacher') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/classroom.png') }}" class="w-8 h-8 mr-2" alt="Assign Teacher" />
                    Assign Teacher
                </a>
            </li>
            <li class="w-48 py-2 flex items-center text-black font-semibold hover:bg-gray-200 rounded-lg p-2 mx-auto">
                <a href="{{ url('/registerSectionhead') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/teachernew.png') }}" class="w-8 h-8 mr-2" alt="Assign Section" />
                    Assign Sectional Head
                </a>
            </li>
            <li class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 hover:bg-gray-300 rounded-lg p-2 mx-auto">
                <a href="{{ url('/logout') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-2" alt="Logout" />
                    Logout
                </a>
            </li>
        </ul>
    </div>

    {{-- Main Content --}}
    <div class="w-3/4 p-10 overflow-y-auto">
        <h2 class="text-2xl font-bold mb-6 text-center">Manage Users</h2>

        <a href="{{ url('/schoolDashboard') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded shadow mb-4">
            < Back
        </a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            {{-- Manage Principals --}}
            <a href="{{ url('/managePrincipals') }}" class="bg-blue-100 hover:bg-blue-200 rounded-lg shadow-lg p-6 text-center transition transform hover:scale-105">
                <img src="{{ asset('storage/photos/boss.png') }}" alt="Manage Principals" class="w-12 h-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Manage Principals</h3>
            </a>

            {{-- Manage Sectional Heads --}}
            <a href="{{ url('/manageSectionals') }}" class="bg-blue-100 hover:bg-blue-200 rounded-lg shadow-lg p-6 text-center transition transform hover:scale-105">
                <img src="{{ asset('storage/photos/teachernew.png') }}" alt="Manage Section Heads" class="w-12 h-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Manage Sectional Heads</h3>
            </a>

            {{-- Manage Teachers --}}
            <a href="{{ url('/teacher_manage') }}" class="bg-blue-100 hover:bg-blue-200 rounded-lg shadow-lg p-6 text-center transition transform hover:scale-105">
                <img src="{{ asset('storage/photos/group.png') }}" alt="Manage Teachers" class="w-12 h-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Manage Teachers</h3>
            </a>

            {{-- Manage Clerks --}}
            <a href="{{ url('/manageClerks') }}" class="bg-blue-100 hover:bg-blue-200 rounded-lg shadow-lg p-6 text-center transition transform hover:scale-105">
                <img src="{{ asset('storage/photos/immigration.png') }}" alt="Manage Clerks" class="w-12 h-12 mx-auto mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Manage Clerks</h3>
            </a>
        </div>
    </div>
</div>
</body>
</html>
