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
    <title>Leave Record - Principal | TLMS</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
    <button id="hamburger"
        class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
        <span class="text-2xl">☰</span>
    </button>

    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <!-- Sidebar (hidden by default on mobile, unchanged on desktop) -->
        <div id="sidebar"
            class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-[90vh] lg:h-auto z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/boss.png') }}"
                class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="Profile" />

            <ul class="space-y-4 w-full">
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/principalDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.index') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/leave.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Requests" />
                        Leave Requests
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/attendanceReport') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        Attendance Report
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/my_attendance') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Attendance" />
                        My Attendance
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.create') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/folder.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Apply Leave
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.history') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/status.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="Leave Application Status" />
                        Leave Application Status
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/viewUsers') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="View Users" />
                        View Users
                    </a>
                </li>
                <li
                    class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ route('leave.record') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2"
                            alt="View Users" />
                        Leave Records
                    </a>
                </li>
                <li
                    class="mt-8 lg:mt-12 w-full lg:w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
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
            <button onclick="history.back()"
                class="absolute top-24 lg:top-6 left-4 lg:left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 lg:py-2 lg:px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2"
                    alt="Back" />
                Back
            </button>

            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                    class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" alt="Profile" />
                <div>
                    <a href="{{ url('/show') }}">
                        <h3 class="font-semibold text-sm lg:text-base">{{ Auth::user()->first_name }}
                            {{ Auth::user()->last_name }}
                        </h3>
                        <h3 class="text-gray-600 text-xs lg:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                    </a>
                </div>
            </div>

            <div class="mt-32 lg:mt-12">
                <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 rounded-lg mb-4 lg:mb-6 relative">
                    <p class="text-gray-700 text-sm lg:text-base">Welcome back!</p>
                    <h1 class="text-xl lg:text-2xl font-bold">{{ Auth::user()->first_name }}</h1>
                </div>

                <h1 class="text-xl lg:text-2xl font-bold mb-4 lg:mb-6">Approved Leave Record</h1>

                @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 lg:p-4 mb-4 lg:mb-6 rounded"
                    role="alert">
                    {{ session('error') }}
                </div>
                @endif
                @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 lg:p-4 mb-4 lg:mb-6 rounded"
                    role="alert">
                    {{ session('success') }}
                </div>
                @endif

                @if ($approvedLeaves->isEmpty())
                <p class="text-gray-600 text-sm lg:text-base">No approved leave records found.</p>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">Applicant</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">Role</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">From</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">To</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">Days</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">Type</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">Reason</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">Attachments</th>
                                <th class="p-2 lg:p-3 text-left text-sm lg:text-base">Approved At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvedLeaves as $leave)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2 lg:p-3 text-sm lg:text-base">
                                    {{ $leave->user ? $leave->user->first_name . ' ' . $leave->user->last_name : 'Unknown User' }}
                                    @if ($leave->user_id == Auth::id())
                                    <span class="text-blue-500 text-xs">(You)</span>
                                    @endif
                                </td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">
                                    {{ $leave->user ? ucfirst(strtolower($leave->user->role)) : 'N/A' }}
                                </td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">{{ $leave->commence_date }}</td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">{{ $leave->end_date }}</td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">{{ $leave->leave_days }}</td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">{{ $leave->leave_type }}</td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">{{ $leave->reason ?? 'N/A' }}</td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">
                                    @php
                                    $hasAttachments = $leave->has_attachment_1 || $leave->has_attachment_2 ||
                                    $leave->has_attachment_3;
                                    @endphp
                                    @if ($hasAttachments)
                                    <div class="space-y-1">
                                        @if ($leave->has_attachment_1)
                                        @php
                                        $extension = pathinfo($leave->attachment_url_1, PATHINFO_EXTENSION);
                                        $icon = $extension === 'pdf' ?
                                        'https://cdn-icons-png.flaticon.com/512/337/337946.png' :
                                        'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                        @endphp
                                        <a href="{{ route('leave.attachment', [$leave->id, 1]) }}" target="_blank"
                                            class="flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                                            <img src="{{ $icon }}" class="w-3 lg:w-4 h-3 lg:h-4 mr-1"
                                                alt="{{ $extension }} icon">
                                            Attachment 1 ({{ strtoupper($extension) }})
                                        </a>
                                        @endif
                                        @if ($leave->has_attachment_2)
                                        @php
                                        $extension = pathinfo($leave->attachment_url_2, PATHINFO_EXTENSION);
                                        $icon = $extension === 'pdf' ?
                                        'https://cdn-icons-png.flaticon.com/512/337/337946.png' :
                                        'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                        @endphp
                                        <a href="{{ route('leave.attachment', [$leave->id, 2]) }}" target="_blank"
                                            class="flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                                            <img src="{{ $icon }}" class="w-3 lg:w-4 h-3 lg:h-4 mr-1"
                                                alt="{{ $extension }} icon">
                                            Attachment 2 ({{ strtoupper($extension) }})
                                        </a>
                                        @endif
                                        @if ($leave->has_attachment_3)
                                        @php
                                        $extension = pathinfo($leave->attachment_url_3, PATHINFO_EXTENSION);
                                        $icon = $extension === 'pdf' ?
                                        'https://cdn-icons-png.flaticon.com/512/337/337946.png' :
                                        'https://cdn-icons-png.flaticon.com/512/337/337949.png';
                                        @endphp
                                        <a href="{{ route('leave.attachment', [$leave->id, 3]) }}" target="_blank"
                                            class="flex items-center text-blue-600 hover:text-blue-800 hover:underline">
                                            <img src="{{ $icon }}" class="w-3 lg:w-4 h-3 lg:h-4 mr-1"
                                                alt="{{ $extension }} icon">
                                            Attachment 3 ({{ strtoupper($extension) }})
                                        </a>
                                        @endif
                                    </div>
                                    @else
                                    <span class="text-gray-500 text-sm lg:text-base">No attachments</span>
                                    @endif
                                </td>
                                <td class="p-2 lg:p-3 text-sm lg:text-base">
                                    {{ $leave->latestStatus->updated_at->format('Y-m-d H:i:s') }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 lg:mt-4">
                    {{ $approvedLeaves->links() }}
                </div>
                @endif
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