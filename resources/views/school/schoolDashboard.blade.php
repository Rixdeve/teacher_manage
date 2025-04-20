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
    <title>School Dashboard</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <div
            class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">

            <img src="{{asset('/storage/photos/school.png')}}"
                class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/schoolDashboard') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/dashboard.png')}}" class="w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerPrincipal') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/boss.png')}}" class="w-8 h-8 mr-2" alt="Assign Principal" />
                        Assign Principal</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerClerk') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Assign Clerk" />
                        Assign Clerk</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerTeacher') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/classroom.png')}}" class="w-8 h-8 mr-2" alt="Assign Teacher" />
                        Assign Teacher</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerSectionhead') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/teachernew.png')}}" class="w-8 h-8 mr-2"
                            alt="Assign Section" />
                        Assign Sectional Head</a>
                </li>

                <li
                    class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/logout.png')}}" class="w-8 h-8 mr-2" alt="Logout" />
                        Logout</a>
                </li>
            </ul>
        </div>

        <div class="w-3/4 p-8 relative">
            <button onclick="history.back()"
                class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            @php
            $school = \App\Models\School::find(session('school_id'));
            @endphp

            @if($school)
            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{asset('storage/photos/school2.png')}}"
                    class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <h3 class="font-semibold">{{ $school->school_name }}</h3>
                    <h3 class="text-gray-600 text-sm">School</h3>
                </div>
            </div>
            @endif

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6 relative">
                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">{{ $school->school_name }}</h1>
            </div>
            <div class="grid grid-cols-3 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold">Manage Teachers</p>
                        <img src="{{asset('storage/photos/group.png')}}" class="w-12 h-12 mb-4" alt="Manage Teachers" />
                    </div>
                </div>
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
    </div>
    </div>
</body>

</html>