

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Leave Applications</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
       
        <div class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="{{asset('storage/photos/boss.png')}}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/dashboard.png')}}" class="w-8 h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mr-2" alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/immigration.png')}}" class="w-8 h-8 mr-2" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                    <img src="{{ asset('storage/photos/folder.png') }}" class="w-8 h-8 mr-2" alt="Leave Application Status" />
                    Apply leave
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/chat-box.png')}}" class="w-8 h-8 mr-2" alt="Notifications" />
                        Write Notification
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/folder.png')}}" class="w-8 h-8 mr-2" alt="Leave Record" />
                        Leave Record
                    </a>
                </li>
                <li class="w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/viewUsers') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/classroom.png')}}" class="w-8 h-8 mr-2" alt="View Users" />
                        View Users
                    </a>
                </li>
                <li class="mt-12 w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{asset('storage/photos/logout.png')}}" class="w-8 h-8 mr-2" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

       
        <div class="w-3/4 p-8 relative">
            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                        <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>

            <button onclick="history.back()" class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mt-12 mb-6 relative">
                <p class="text-gray-700">Welcome back!</p>
                <h1 class="text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
            </div>

          
            <h1 class="text-2xl font-bold mb-6">Pending Leave Applications</h1>

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

           
            @if ($applications->isEmpty())
                <p class="text-gray-600">No pending leave applications.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-3 text-left">Teacher</th>
                                <th class="p-3 text-left">From</th>
                                <th class="p-3 text-left">To</th>
                                <th class="p-3 text-left">Type</th>
                                <th class="p-3 text-left">Reason</th>
                                <th class="p-3 text-left">Attachments</th>
                                <th class="p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($applications as $application)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="p-3">
                                        @if ($application->user)
                                            {{ $application->user->name ?? trim($application->user->first_name . ' ' . $application->user->last_name) ?? 'N/A' }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td class="p-3">{{ $application->commence_date }}</td>
                                    <td class="p-3">{{ $application->end_date }}</td>
                                    <td class="p-3">{{ $application->leave_type }}</td>
                                    <td class="p-3">{{ $application->reason ?? 'N/A' }}</td>
                                    <td class="p-3">
    @php
        $hasAttachments = $application->has_attachment_1 || $application->has_attachment_2 || $application->has_attachment_3;
    @endphp
    @if ($hasAttachments)
        <div class="space-y-2">
            @if ($application->has_attachment_1)
                @php
                    $extension = pathinfo($application->attachment_url_1, PATHINFO_EXTENSION);
                    $icon = $extension === 'pdf' ? 'https://cdn-icons-png.flaticon.com/512/337/337946.png' : 'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                @endphp
                <a href="{{ route('leave.attachment', [$application->id, 1]) }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                    <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                    Attachment 1 ({{ strtoupper($extension) }})
                </a>
            @endif
            @if ($application->has_attachment_2)
                @php
                    $extension = pathinfo($application->attachment_url_2, PATHINFO_EXTENSION);
                    $icon = $extension === 'pdf' ? 'https://cdn-icons-png.flaticon.com/512/337/337946.png' : 'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                @endphp
                <a href="{{ route('leave.attachment', [$application->id, 2]) }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                    <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                    Attachment 2 ({{ strtoupper($extension) }})
                </a>
            @endif
            @if ($application->has_attachment_3)
                @php
                    $extension = pathinfo($application->attachment_url_3, PATHINFO_EXTENSION);
                    $icon = $extension === 'pdf' ? 'https://cdn-icons-png.flaticon.com/512/337/337946.png' : 'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                @endphp
                <a href="{{ route('leave.attachment', [$application->id, 3]) }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                    <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                    Attachment 3 ({{ strtoupper($extension) }})
                </a>
            @endif
        </div>
    @else
        <span class="text-gray-500">No attachments</span>
    @endif
</td>
                                    <td class="p-3">
                                        <form action="{{ route('leave.updateStatus', $application->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="APPROVED">
                                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Approve</button>
                                        </form>

                                        <form action="{{ route('leave.updateStatus', $application->id) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="REJECTED">
                                            <textarea name="comment" placeholder="Reason for rejection" class="border p-1 mt-1 w-full" rows="2"></textarea>
                                            @error('comment')
                                                <span class="text-red-500 text-sm">{{ $message }}</span>
                                            @enderror
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 mt-1">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</body>

</html>