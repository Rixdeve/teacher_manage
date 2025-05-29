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
    <title>Edit Sectional Head | TLMS</title>
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
</head>

<body class="bg-white font-sans flex items-center justify-center min-h-screen antialiased">
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
                <li class="w-full py-3 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-3 mx-auto transition-colors duration-200">
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
        <div class="w-full lg:w-3/4 p-6 lg:p-8 relative">
            @php
            $school = \App\Models\School::find(session('school_id'));
            @endphp

            @if($school)
            <div class="absolute top-4 lg:top-6 right-4 lg:right-6 flex items-center space-x-4 group z-10">
                <img src="{{ asset('storage/photos/school2.png') }}" class="h-10 w-10 rounded-full border-2 border-gray-400 shadow-md transition-transform duration-300 group-hover:scale-105" alt="School Logo" />
                <div class="text-right">
                    <h3 class="font-semibold text-base text-gray-800">{{ $school->school_name }}</h3>
                    <h3 class="text-gray-600 text-sm">School</h3>
                </div>
            </div>
            @endif

            <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-2xl mb-8 shadow-custom hover:shadow-custom-hover transition-shadow duration-300 mt-20 lg:mt-16">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-800 text-center">Edit Sectional Head</h2>
            </div>

            <a href="{{ route('sectionals.manage') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-full shadow-md hover:shadow-custom-hover transition-all duration-300 mb-6">
                ← Back to Manage Sectional Heads
            </a>

            @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded-2xl mb-6 shadow-custom">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-blue-100 p-6 rounded-2xl shadow-custom hover:shadow-custom-hover transition-shadow duration-300">
                <form action="{{ route('sectionals.update', $sectional->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-800">First Name</label>
                                <input type="text" id="first_name" name="first_name" value="{{ $sectional->first_name }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-800">Last Name</label>
                                <input type="text" id="last_name" name="last_name" value="{{ $sectional->last_name }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="school_index" class="block text-sm font-medium text-gray-800">School Index</label>
                                <input type="text" id="school_index" name="school_index" value="{{ $sectional->school_index }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                            <div>
                                <label for="user_email" class="block text-sm font-medium text-gray-800">Email</label>
                                <input type="email" id="user_email" name="user_email" value="{{ $sectional->user_email }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="user_phone" class="block text-sm font-medium text-gray-800">Phone</label>
                                <input type="text" id="user_phone" name="user_phone" value="{{ $sectional->user_phone }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                            <div>
                                <label for="user_nic" class="block text-sm font-medium text-gray-800">NIC</label>
                                <input type="text" id="user_nic" name="user_nic" value="{{ $sectional->user_nic }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="user_address_no" class="block text-sm font-medium text-gray-800">Address No</label>
                                <input type="text" id="user_address_no" name="user_address_no" value="{{ $sectional->user_address_no }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                            <div>
                                <label for="user_address_street" class="block text-sm font-medium text-gray-800">Address Street</label>
                                <input type="text" id="user_address_street" name="user_address_street" value="{{ $sectional->user_address_street }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="user_address_city" class="block text-sm font-medium text-gray-800">Address City</label>
                                <input type="text" id="user_address_city" name="user_address_city" value="{{ $sectional->user_address_city }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                            <div>
                                <label for="user_dob" class="block text-sm font-medium text-gray-800">Date of Birth</label>
                                <input type="date" id="user_dob" name="user_dob" value="{{ \Carbon\Carbon::parse($sectional->user_dob)->format('Y-m-d') }}" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="profile_picture" class="block text-sm font-medium text-gray-800">Profile Picture</label>
                                @if($sectional->profile_picture)
                                <img src="{{ asset('storage/' . $sectional->profile_picture) }}" class="w-24 h-24 rounded-lg shadow border mt-1 mb-3" alt="Profile Picture" />
                                @else
                                <p class="text-sm text-gray-500 mt-1 mb-3">No image available</p>
                                @endif
                                <input type="file" id="profile_picture" name="profile_picture" class="mt-1 p-3 border border-gray-300 rounded-lg w-full" />
                            </div>
                            <div>
                                <label for="section" class="block text-sm font-medium text-gray-800">Section</label>
                                <select id="section" name="section" class="mt-1 p-3 border border-gray-300 rounded-lg w-full focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Select Section</option>
                                    <option value="1-5" {{ $sectional->section == '1-5' ? 'selected' : '' }}>1-5</option>
                                    <option value="6-7" {{ $sectional->section == '6-7' ? 'selected' : '' }}>6-7</option>
                                    <option value="8-9" {{ $sectional->section == '8-9' ? 'selected' : '' }}>8-9</option>
                                    <option value="10-11" {{ $sectional->section == '10-11' ? 'selected' : '' }}>10-11</option>
                                    <option value="12-13" {{ $sectional->section == '12-13' ? 'selected' : '' }}>12-13</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-800">Subjects</label>
                            <div class="mt-2 space-y-4">
                                <!-- Grades 1–5 -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Grades 1–5</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                                        @foreach([
                                            'Sinhala (First Language)',
                                            'Tamil (First Language)',
                                            'English Language',
                                            'Mathematics',
                                            'Environmental Studies',
                                            'Religion',
                                            'Aesthetic Studies',
                                            'Health and Physical Education',
                                            'Life Competencies and Civic Education'
                                        ] as $subject)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject }}" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500" {{ in_array($subject, is_array($sectional->subjects) ? $sectional->subjects : json_decode($sectional->subjects, true) ?? []) ? 'checked' : '' }} />
                                            <span class="text-sm text-gray-700">{{ $subject }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Grades 6–11 -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Grades 6–11</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                                        @foreach([
                                            'Science',
                                            'History',
                                            'Geography',
                                            'Civic Education',
                                            'Business and Accounting Studies',
                                            'Information and Communication Technology'
                                        ] as $subject)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject }}" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500" {{ in_array($subject, is_array($sectional->subjects) ? $sectional->subjects : json_decode($sectional->subjects, true) ?? []) ? 'checked' : '' }} />
                                            <span class="text-sm text-gray-700">{{ $subject }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Grades 12–13 -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Grades 12–13</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mt-2">
                                        @foreach([
                                            'Sinhala Literature',
                                            'English Literature',
                                            'Biology',
                                            'Physics',
                                            'Chemistry',
                                            'Political Science',
                                            'Economics',
                                            'Agriculture'
                                        ] as $subject)
                                        <label class="flex items-center">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject }}" class="mr-2 h-4 w-4 text-blue-600 focus:ring-blue-500" {{ in_array($subject, is_array($sectional->subjects) ? $sectional->subjects : json_decode($sectional->subjects, true) ?? []) ? 'checked' : '' }} />
                                            <span class="text-sm text-gray-700">{{ $subject }}</span>
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-700 hover:shadow-custom-hover transition-all duration-300">Update</button>
                        </div>
                    </div>
                </form>
            </div>
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