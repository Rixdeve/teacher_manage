<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Teacher</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        {{-- Sidebar --}}
        <div class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">
            <img src="{{ asset('/storage/photos/school.png') }}" class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />
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

        {{-- Main Content --}}
        <div class="w-3/4 p-10 overflow-y-auto">
            <h2 class="text-2xl font-semibold mb-6 text-center">Edit Teacher Details</h2>

            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('teachers.manage') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded shadow mb-6">
                < Back
            </a>

            @php
                $selectedSubjects = is_array($teacher->subjects) ? $teacher->subjects : json_decode($teacher->subjects, true);
            @endphp

            <form action="{{ route('teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">First Name</label>
                        <input type="text" name="first_name" value="{{ $teacher->first_name }}" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium">Last Name</label>
                        <input type="text" name="last_name" value="{{ $teacher->last_name }}" class="w-full border rounded p-2" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">School Index</label>
                        <input type="text" name="school_index" value="{{ $teacher->school_index }}" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium">Email</label>
                        <input type="email" name="user_email" value="{{ $teacher->user_email }}" class="w-full border rounded p-2" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Phone Number</label>
                        <input type="text" name="user_phone" value="{{ $teacher->user_phone }}" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium">NIC</label>
                        <input type="text" name="user_nic" value="{{ $teacher->user_nic }}" class="w-full border rounded p-2" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Address No</label>
                        <input type="text" name="user_address_no" value="{{ $teacher->user_address_no }}" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium">Address Street</label>
                        <input type="text" name="user_address_street" value="{{ $teacher->user_address_street }}" class="w-full border rounded p-2" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium">Address City</label>
                        <input type="text" name="user_address_city" value="{{ $teacher->user_address_city }}" class="w-full border rounded p-2" required>
                    </div>
                    <div>
                        <label class="block font-medium">Date of Birth</label>
                        <input type="date" name="user_dob" value="{{ \Carbon\Carbon::parse($teacher->user_dob)->format('Y-m-d') }}" class="w-full border rounded p-2" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Existing profile picture preview --}}
                    <div>
                        <label class="block font-medium">Current Profile Picture</label>
                        @if ($teacher->profile_picture)
                            <img src="{{ asset('storage/' . $teacher->profile_picture) }}" alt="Profile Picture" class="h-24 w-24 mt-2 rounded-full border shadow">
                        @else
                            <p class="text-sm text-gray-500 mt-2">No profile picture uploaded.</p>
                        @endif
                    </div>

                    {{-- New profile picture upload --}}
                    <div>
                        <label class="block font-medium">Upload New Picture</label>
                        <input type="file" name="profile_picture" class="mt-2 w-full border rounded p-2">
                    </div>
                </div>

                <div>
                    <label class="block font-medium">Section</label>
                    <select name="section" class="w-full border rounded p-2" required>
                        <option value="1-5" {{ $teacher->section == '1-5' ? 'selected' : '' }}>1-5</option>
                        <option value="6-7" {{ $teacher->section == '6-7' ? 'selected' : '' }}>6-7</option>
                        <option value="8-9" {{ $teacher->section == '8-9' ? 'selected' : '' }}>8-9</option>
                        <option value="10-11" {{ $teacher->section == '10-11' ? 'selected' : '' }}>10-11</option>
                        <option value="12-13" {{ $teacher->section == '12-13' ? 'selected' : '' }}>12-13</option>
                    </select>
                </div>

                <div>
                    <label class="block font-medium">Subjects</label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                        @foreach([
                            'English Language', 'Mathematics', 'Religion', 'Science', 'History',
                            'Business and Accounting Studies', 'ICT', 'Geography', 'Civic Education',
                            'Sinhala Literature', 'English Literature', 'Physics', 'Chemistry',
                            'Biology', 'Economics', 'Aesthetic Studies', 'Agriculture'
                        ] as $subject)
                            <label class="flex items-center">
                                <input type="checkbox" name="subjects[]" value="{{ $subject }}" class="mr-2"
                                    {{ in_array($subject, $selectedSubjects ?? []) ? 'checked' : '' }}>
                                {{ $subject }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
