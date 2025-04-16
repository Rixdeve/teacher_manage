<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dashboard</title>
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
                    <a href="{{ url('/zonalDashboard') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/dashboard.png')}}" class="w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/log-file.png')}}" class="w-8 h-8 mr-2" alt="Audit Log" />
                        Audit Log</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/manageSchool') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/vocational.png')}}" class="w-8 h-8 mr-2"
                            alt="Manage Schools" />
                        Manage Schools</a>
                </li>
                <li
                    class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/chat-box.png')}}" class="w-8 h-8 mr-2"
                            alt="Write Notification" />
                        Write Notification</a>
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
                <img src="{{ asset('storage/app/public/photos/woman.png') }}"
                    class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <a href="{{ url('/show') }}">

                        <h3 class="font-semibold">
                            @php
                            $zoneOffice = \App\Models\ZoneOffice::find(session('zone_office_id'));
                            @endphp

                            @if ($zoneOffice)
                            <h3 class="font-semibold">{{ $zoneOffice->zone_name }}</h3>
                            @endif

                        </h3>
                    </a>
                </div>
            </div>

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6">
                <p class="text-gray-700">#</p>

            </div>

            <div class="grid grid-cols-3 gap-6">
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <a href="{{ url('/registerschool') }} ">
                        <p class="text-gray-700 font-semibold">Register School:</p>
                        <div class="flex justify-center mt-2">
                            <img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/add-a-device-5373030-4489968.png"
                                alt="Icon" class="w-10 h-10" />
                        </div>
                    </a>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <p class="text-gray-700 font-semibold">Registered Schools:</p>
                    <p class="text-3xl font-bold text-blue-600">#</p>
                </div>
                <div class="bg-blue-100 p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <p class="text-gray-700 font-semibold">Registered Users:</p>
                    <p class="text-3xl font-bold text-blue-600">#</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>