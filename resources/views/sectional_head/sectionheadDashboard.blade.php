<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Sectional Head Dashboard</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <div
            class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="{{asset('storage/photos/boy.png')}}"
                class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/teacherDashboard') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/dashboard.png')}}" class="w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/liveAttendance') }}" class="flex items-center w-full"> <img
                            src="{{asset('storage/photos/fingerprint-scan.png')}}" class="w-8 h-8 mr-2"
                            alt="Dashboard" />
                        Live Attendance</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/leave.png')}}" class="w-8 h-8 mr-2" alt="Apply Leave" />
                        Apply Leave</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendance') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Attendance" />
                        My Attendance</a>
                </li>

                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/active.png')}}" class="w-8 h-8 mr-2" alt="Notifications" />
                        Notifications</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/status.png')}}" class="w-8 h-8 mr-2"
                            alt="Leave Application" />
                        Leave Application Status</a>
                </li>
                <li
                    class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/logout.png')}}" class="w-8 h-8 mr-2" alt="Logout" />
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

            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{asset('storage/photos/profilePic.jpg')}}"
                    class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <h3 class="font-semibold">Teacher name</h3>
                    <h3 class="text-gray-600 text-sm">Teacher</h3>
                </div>
            </div>

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6 relative">
                <div class="absolute top-2 right-2 flex items-center space-x-2">
                    <div class="bg-green-500 rounded-full w-3 h-3"></div>
                    <!-- change the color acc -->
                    <span class="text-sm text-green-500 font-semibold">On Duty off duty</span>
                </div>

                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">Risinu</h1>
            </div>
            <div>
                <h2 class="text-2xl mb-5">Apply Leaves</h2>
            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold">Casual Leaves</p>
                        <img src="{{asset('storage/photos/exit.png')}}" class="w-12 h-12 mb-4" alt="Casual Leave" />
                    </div>
                </div>

                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold">Medical Leave</p>
                        <img src="{{asset('storage/photos/stress-management.png')}}" class="w-12 h-12 mb-4"
                            alt="Medical Leave" />
                    </div>
                </div>

                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-gray-700 font-semibold">Short Leaves</p>
                        <img src="{{asset('storage/photos/stopwatch.png')}}" class="w-12 h-12 mb-4" alt="Short Leave" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>