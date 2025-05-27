<!DOCTYPE html>
<html lang="en" class="light"> <!-- Default to light mode -->

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

<body
    class="bg-white text-black dark:bg-gray-900 dark:text-white font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile -->
        <button id="hamburger"
            class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-full shadow-md hover:shadow-custom-hover transition-shadow duration-300">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar -->
        
        <!-- Sidebar -->
        <div id="sidebar"
            class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-custom flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto z-40 bg-opacity-95 overflow-y-auto">
            <img src="{{ asset('storage/photos/boss.png') }}"
                class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white dark:border-gray-700 shadow-md mb-4"
                alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Apply Leave
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black dark:text-white font-semibold cursor-pointer hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Records" />
                        Leave Records
                    </a>
                </li>
                <li
                    class="mt-8 lg:mt-12 w-full lg:w-48 py-2 flex items-center text-red-500 dark:text-red-400 font-bold cursor-pointer hover:bg-gray-300 dark:hover:bg-gray-700 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
            <!-- User Profile and Back Button -->
            <div class="absolute top-4 lg:top-6 right-4 lg:right-6 flex items-center space-x-4 group">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    class="h-10 w-10 rounded-full border-2 border-gray-400 dark:border-gray-600 shadow-md transition-transform duration-300 group-hover:scale-105"
                    alt="Profile" />
                <a href="{{ url('/show') }}" class="text-right">
                    <h3 class="font-semibold text-base text-gray-800 dark:text-white">{{ Auth::user()->first_name }}
                        {{ Auth::user()->last_name }}
                    </h3>
                    <h3 class="text-gray-600 dark:text-gray-400 text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>
            <div class="mb-4 lg:mb-6 mt-14 lg:mt-0">
                <button onclick="history.back()"
                    class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold py-2 px-4 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                    Back
                </button>
            </div>

            <!-- Welcome Section -->
            <div
                class="bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 p-6 rounded-2xl mb-8 shadow-custom hover:shadow-custom-hover transition-shadow duration-300">
                <p class="text-gray-700 dark:text-gray-300 text-base">Welcome back!</p>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800 dark:text-white">{{ Auth::user()->first_name }}</h1>
            </div>

            <!-- Leave Applications -->
            <h1 class="text-2xl lg:text-3xl font-semibold text-gray-800 dark:text-white mb-6">Pending Leave Applications</h1>

            @if (session('success'))
            <div
                class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 p-4 rounded-2xl mb-6 shadow-custom transition-all duration-300 hover:shadow-custom-hover">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div
                class="bg-red-100 dark:bg-red-900 text-red-500 dark:text-red-300 p-4 rounded-2xl mb-6 shadow-custom transition-all duration-300 hover:shadow-custom-hover">
                {{ session('error') }}
            </div>
            @endif

            @if ($applications->isEmpty())
            <p class="text-gray-600 dark:text-gray-400 text-base">No pending leave applications.</p>
            @else
            <div class="overflow-auto max-h-[500px] border border-gray-200 dark:border-gray-700 rounded-2xl shadow-custom">
                <table class="w-full border-collapse">
                    <thead class="bg-blue-100 dark:bg-gray-800 sticky top-0 z-10">
                        <tr>
                            <th class="p-4 text-left text-gray-800 dark:text-white font-semibold">Teacher</th>
                            <th class="p-4 text-left text-gray-800 dark:text-white font-semibold">From</th>
                            <th class="p-4 text-left text-gray-800 dark:text-white font-semibold">To</th>
                            <th class="p-4 text-left text-gray-800 dark:text-white font-semibold">Type</th>
                            <th class="p-4 text-left text-gray-800 dark:text-white font-semibold">Reason</th>
                            <th class="p-4 text-left text-gray-800 dark:text-white font-semibold">Attachments</th>
                            <th class="p-4 text-left text-gray-800 dark:text-white font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applications as $application)
                        <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-blue-50 dark:hover:bg-gray-700 transition-all duration-300">
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
                                $hasAttachments = $application->has_attachment_1 || $application->has_attachment_2 ||
                                $application->has_attachment_3;
                                @endphp
                                @if ($hasAttachments)
                                <div class="space-y-2">
                                    @if ($application->has_attachment_1)
                                    @php
                                    $extension = pathinfo($application->attachment_url_1, PATHINFO_EXTENSION);
                                    $icon = $extension === 'pdf' ?
                                    'https://cdn-icons-png.flaticon.com/512/337/337946.png' :
                                    'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                    @endphp
                                    <a href="{{ route('leave.attachment', [$application->id, 1]) }}" target="_blank"
                                        class="flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline transition-all duration-300">
                                        <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                                        Attachment 1 ({{ strtoupper($extension) }})
                                    </a>
                                    @endif
                                    @if ($application->has_attachment_2)
                                    @php
                                    $extension = pathinfo($application->attachment_url_2, PATHINFO_EXTENSION);
                                    $icon = $extension === 'pdf' ?
                                    'https://cdn-icons-png.flaticon.com/512/337/337946.png' :
                                    'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                    @endphp
                                    <a href="{{ route('leave.attachment', [$application->id, 2]) }}" target="_blank"
                                        class="flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline transition-all duration-300">
                                        <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                                        Attachment 2 ({{ strtoupper($extension) }})
                                    </a>
                                    @endif
                                    @if ($application->has_attachment_3)
                                    @php
                                    $extension = pathinfo($application->attachment_url_3, PATHINFO_EXTENSION);
                                    $icon = $extension === 'pdf' ?
                                    'https://cdn-icons-png.flaticon.com/512/337/337946.png' :
                                    'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                    @endphp
                                    <a href="{{ route('leave.attachment', [$application->id, 3]) }}" target="_blank"
                                        class="flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline transition-all duration-300">
                                        <img src="{{ $icon }}" class="w-4 h-4 mr-1" alt="{{ $extension }} icon">
                                        Attachment 3 ({{ strtoupper($extension) }})
                                    </a>
                                    @endif
                                </div>
                                @else
                                <span class="text-gray-500 dark:text-gray-400">No attachments</span>
                                @endif
                            </td>
                            <td class="p-4">
                                <form action="{{ route('principal.leave.updateStatus', $application->id) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="APPROVED">
                                    <button type="submit"
                                        class="bg-green-400 dark:bg-green-600 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:bg-green-300 dark:hover:bg-green-500 shadow-md hover:shadow-custom-hover transition-all duration-300 hover:scale-105">Approve</button>
                                </form>
                                <form action="{{ route('principal.leave.updateStatus', $application->id) }}"
                                    method="POST" class="inline ml-2">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="REJECTED">
                                    <textarea name="comment" placeholder="Reason for rejection"
                                        class="border border-gray-300 dark:border-gray-600 p-2 mt-1 w-full rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 dark:focus:ring-gray-400 shadow-sm bg-white dark:bg-gray-800 dark:text-white transition-all duration-300"
                                        rows="2"></textarea>
                                    @error('comment')
                                    <span class="text-red-500 dark:text-red-400 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                    <button type="submit"
                                        class="bg-red-500 dark:bg-red-600 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:bg-red-300 dark:hover:bg-red-500 shadow-md hover:shadow-custom-hover transition-all duration-300 hover:scale-105 mt-1">Reject</button>
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
        document.getElementById('hamburger').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('transform');
            sidebar.classList.toggle('translate-x');
        });

        document.addEventListener('click', function (event) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger');
            if (!sidebar.contains(event.target) && !hamburger.contains(event.target) && !sidebar.classList.contains('hidden')) {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('transform');
                sidebar.classList.add('-translate-x');
            }
        });

        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth < 1000) {
                    const sidebar = document.getElementById('sidebar');
                    sidebar.classList.add('hidden');
                    sidebar.classList.remove('translate-x-0');
                    sidebar.classList.add('-translate-x-full');
                }
            });
        });
    </script>
</body>

</html>