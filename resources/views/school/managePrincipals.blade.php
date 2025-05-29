<?php
if (!session()->has('school_id')) {
    return redirect('/login');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
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
    <title>Manage Principals | TLMS</title>
</head>

<body class="bg-gray-100 font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-full shadow-md hover:shadow-custom-hover transition-shadow duration-300">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-0 lg:m-4 rounded-none lg:rounded-2xl shadow-none lg:shadow-custom flex-col items-center fixed lg:static top-0 left-0 h-[100vh] lg:h-[100vh] max-h-[95vh] z-40 transition-transform duration-300 ease-in-out transform lg:transform-none bg-opacity-95 overflow-y-auto">
            <div class="relative group">
                <img src="{{ asset('/storage/photos/school.png') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-6 transition-transform duration-300 group-hover:scale-105" alt="School Logo" />
                <div class="absolute inset-0 rounded-full bg-gray-500 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
            </div>

            <ul class="space-y-3 w-full">
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/schoolDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-8 h-8 mr-3" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/registerPrincipal') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/boss.png') }}" class="w-8 h-8 mr-3" alt="Assign Principal" />
                        Assign Principal
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/registerClerk') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-8 h-8 mr-3" alt="Assign Clerk" />
                        Assign Clerk
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/registerTeacher') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-8 h-8 mr-3" alt="Assign Teacher" />
                        Assign Teacher
                    </a>
                </li>
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/registerSectionhead') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/teachernew.png') }}" class="w-8 h-8 mr-3" alt="Assign Section" />
                        Assign Sectional Head
                    </a>
                </li>
                <li class="mt-8 w-full py-3 flex items-center text-red-500 font-bold cursor-pointer hover:bg-gray-300 rounded-lg p-3 mx-auto transition-colors duration-200">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-8 h-8 mr-3" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 lg:p-6 relative bg-white rounded-2xl m-0 lg:m-4 shadow-custom">
            @php
            $school = \App\Models\School::find(session('school_id'));
            @endphp

            @if($school)
            <div class="absolute top-4 lg:top-4 right-4 lg:right-4 flex items-center space-x-4 group z-10">
                <img src="{{ asset('storage/photos/school2.png') }}" class="h-8 w-8 rounded-full border-2 border-gray-400 shadow-md transition-transform duration-300 group-hover:scale-105" alt="School Logo" />
                <div class="text-right">
                    <h3 class="font-semibold text-sm text-gray-800">{{ $school->school_name }}</h3>
                    <h3 class="text-gray-600 text-xs">School</h3>
                </div>
            </div>
            @endif

            <div class="mt-16 lg:mt-12">
                <a href="{{ url('/manageUsers') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300 mb-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 h-4 mr-2" alt="Back" />
                    Back
                </a>

                <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 mb-4 text-center">Manage Principals</h2>

                @if (session('success'))
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded-lg mb-4 text-sm">
                    {{ session('success') }}
                </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border rounded-lg shadow-md">
                        <thead>
                            <tr class="bg-gray-200 text-gray-800 text-sm">
                                <th class="py-3 px-4 border text-left font-semibold">Name</th>
                                <th class="py-3 px-4 border text-left font-semibold">Email</th>
                                <th class="py-3 px-4 border text-left font-semibold">Status</th>
                                <th class="py-3 px-4 border text-left font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($principals as $principal)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="py-3 px-4 border text-sm">{{ $principal->first_name }} {{ $principal->last_name }}</td>
                                <td class="py-3 px-4 border text-sm">{{ $principal->user_email }}</td>
                                <td class="py-3 px-4 border text-sm">{{ ucfirst(strtolower($principal->status)) }}</td>
                                <td class="py-3 px-4 border text-sm space-x-2">
                                    <a href="{{ route('principals.edit', $principal->id) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1.5 px-3 rounded-lg transition-colors duration-300">Edit</a>
                                    <form action="{{ route('principals.updateStatus', ['id' => $principal->id, 'status' => 'INACTIVE']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-1.5 px-3 rounded-lg transition-colors duration-300">Deactivate</button>
                                    </form>
                                    <form action="{{ route('principals.updateStatus', ['id' => $principal->id, 'status' => 'TRANSFERRED']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-1.5 px-3 rounded-lg transition-colors duration-300">Transferred</button>
                                    </form>
                                    <form action="{{ route('principals.updateStatus', ['id' => $principal->id, 'status' => 'RETIRED']) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1.5 px-3 rounded-lg transition-colors duration-300">Retired</button>
                                    </form>
                                    @if ($principal->status !== 'ACTIVE')
                                    <form action="{{ route('principals.reactivate', $principal->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1.5 px-3 rounded-lg transition-colors duration-300">Reactivate</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-sm text-gray-600">No principals found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Hamburger menu toggle
        document.getElementById('hamburger').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.getElementById('hamburger');
            if (!sidebar.contains(event.target) && !hamburger.contains(event.target) && !sidebar.classList.contains('hidden')) {
                sidebar.classList.add('hidden');
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Close sidebar when clicking a link
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