<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Applications | TLMS</title>
    @include('partials.theme')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile -->
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full shadow-md hover:shadow-custom-hover transition-shadow duration-300">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-2xl shadow-none lg:shadow-custom flex-col items-center fixed lg:static top-0 left-0 h-[100vh] lg:h-[100vh] max-h-[95vh] z-40 transition-transform duration-300 ease-in-out transform lg:transform-none bg-opacity-95 overflow-y-auto">
            <div class="relative group">
                <img src="{{ asset('storage/photos/boss.png') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-6 transition-transform duration-300 group-hover:scale-105" alt="Profile" />
                <div class="absolute inset-0 rounded-full bg-gray-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            </div>
            <ul class="space-y-3 w-full">
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-3" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-8 h-8 mr-3" alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-3" alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-3" alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-8 h-8 mr-3" alt="Leave Application Status" />
                        Apply Leave
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ url('') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/chat-box.png') }}" class="w-8 h-8 mr-3" alt="Notifications" />
                        Write Notification
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-8 h-8 mr-3" alt="Leave Record" />
                        Leave Record
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ url('/viewUsers') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-8 h-8 mr-3" alt="View Users" />
                        View Users
                    </a>
                </li>
                <li class="mt-8 w-full py-3 flex items-center text-red-500 font-bold cursor-pointer hover:bg-gray-300 rounded-lg p-3 transition-colors duration-200 hover:scale-105">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-3" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
            <!-- User Profile and Back Button -->
            <div class="absolute top-4 lg:top-6 right-4 lg:right-6 flex items-center space-x-4 group">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" class="h-10 w-10 rounded-full border-2 border-gray-400 shadow-md transition-transform duration-300 group-hover:scale-105" alt="Profile" />
                <a href="{{ url('/show') }}" class="text-right">
                    <h3 class="font-semibold text-base text-gray-800">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>
            <div class="mb-4 lg:mb-6 mt-14 lg:mt-0">
                <button onclick="history.back()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                    Back
                </button>
            </div>

            <!-- Welcome Section -->
            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-2xl mb-8 shadow-custom hover:shadow-custom-hover transition-shadow duration-300">
                <p class="text-gray-700 text-base">Welcome back!</p>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">{{ Auth::user()->first_name }}</h1>
            </div>

            <!-- Leave Applications -->
            <h1 class="text-2xl lg:text-3xl font-semibold text-gray-800 mb-6">Pending Leave Applications</h1>

            @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-6 shadow-custom transition-all duration-300 hover:shadow-custom-hover">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="bg-red-100 text-red-500 p-4 rounded-2xl mb-6 shadow-custom transition-all duration-300 hover:shadow-custom-hover">
                {{ session('error') }}
            </div>
            @endif

            @if ($applications->isEmpty())
            <p class="text-gray-600 text-base">No pending leave applications.</p>
            @else
            <div class="overflow-auto max-h-[500px] border border-gray-200 rounded-2xl shadow-custom">
                <table class="w-full border-collapse">
                    <thead class="bg-blue-100 sticky top-0 z-10">
                        <tr>
                            <th class="p-4 text-left text-gray-800 font-semibold">Teacher</th>
                            <th class="p-4 text-left text-gray-800 font-semibold">From</th>
                            <th class="p-4 text-left text-gray-800 font-semibold">To</th>
                            <th class="p-4 text-left text-gray-800 font-semibold">Type</th>
                            <th class="p-4 text-left text-gray-800 font-semibold">Reason</th>
                            <th class="p-4 text-left text-gray-800 font-semibold">Attachments</th>
                            <th class="p-4 text-left text-gray-800 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        <tr class="border-b hover:bg-blue-50 transition-all duration-300">
                            <td class="p-4">
                                @if ($application->user)
                                {{ $application->user->name ?? trim($application->user->first_name . ' ' . $application->user->last_name) ?? 'N/A' }}
                                @else
                                N/A
                                @endif
                            </td>
                            <td class="p-4">{{ $application->commence_date }}</td>
                            <td class="p-4">{{ $application->end_date }}</td>
                            <td class="p-4">{{ $application->leave_type }}</td>
                            <td class="p-4">{{ $application->reason ?? 'N/A' }}</td>
                            <td class="p-4">
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
                                    <a href="{{ route('leave.attachment', [$application->id, 1]) }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 hover:underline transition-all duration-300">
                                        <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                                        Attachment 1 ({{ strtoupper($extension) }})
                                    </a>
                                    @endif
                                    @if ($application->has_attachment_2)
                                    @php
                                    $extension = pathinfo($application->attachment_url_2, PATHINFO_EXTENSION);
                                    $icon = $extension === 'pdf' ? 'https://cdn-icons-png.flaticon.com/512/337/337946.png' : 'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                    @endphp
                                    <a href="{{ route('leave.attachment', [$application->id, 2]) }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 hover:underline transition-all duration-300">
                                        <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                                        Attachment 2 ({{ strtoupper($extension) }})
                                    </a>
                                    @endif
                                    @if ($application->has_attachment_3)
                                    @php
                                    $extension = pathinfo($application->attachment_url_3, PATHINFO_EXTENSION);
                                    $icon = $extension === 'pdf' ? 'https://cdn-icons-png.flaticon.com/512/337/337946.png' : 'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                    @endphp
                                    <a href="{{ route('leave.attachment', [$application->id, 3]) }}" target="_blank" class="flex items-center text-blue-600 hover:text-blue-800 hover:underline transition-all duration-300">
                                        <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                                        Attachment 3 ({{ strtoupper($extension) }})
                                    </a>
                                    @endif
                                </div>
                                @else
                                <span class="text-gray-500">No attachments</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <form action="{{ route('leave.updateStatus', $application->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="APPROVED">
                                    <button type="submit" class="bg-green-400 text-gray-800 px-4 py-2 rounded-full hover:bg-green-300 shadow-md hover:shadow-custom-hover transition-all duration-300 hover:scale-105">Approve</button>
                                </form>
                                <form action="{{ route('leave.updateStatus', $application->id) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="REJECTED">
                                    <textarea name="comment" placeholder="Reason for rejection" class="border border-gray-300 p-2 mt-1 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 shadow-sm bg-white transition-all duration-300" rows="2"></textarea>
                                    @error('comment')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                    <button type="submit" class="bg-red-500 text-gray-800 px-4 py-2 rounded-full hover:bg-red-300 shadow-md hover:shadow-custom-hover transition-all duration-300 hover:scale-105 mt-1">Reject</button>
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

    <script>
        document.getElementById('hamburger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        });

        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger');
            if (!sidebar.contains(event.target) && !hamburger.contains(event.target) && !sidebar.classList.contains('hidden')) {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
        });

        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('sidebar').classList.add('hidden');
                document.getElementById('sidebar').classList.remove('translate-x-0');
                document.getElementById('sidebar').classList.add('-translate-x-full');
            });
        });
    </script>
</body>

</html>