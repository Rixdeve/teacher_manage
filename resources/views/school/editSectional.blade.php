<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Sectional Head</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a href="{{ route('sectionals.manage') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded shadow mb-6">
                < Back
            </a>

            <h2 class="text-2xl font-bold mb-6 text-center">Edit Sectional Head</h2>

            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-3 rounded mb-4 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('sectionals.update', $sectional->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-lg font-medium text-gray-800">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="{{ $sectional->first_name }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>

                        <div>
                            <label for="last_name" class="block text-lg font-medium text-gray-800">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ $sectional->last_name }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="school_index" class="block text-lg font-medium text-gray-800">School Index</label>
                            <input type="text" id="school_index" name="school_index" value="{{ $sectional->school_index }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>

                        <div>
                            <label for="user_email" class="block text-lg font-medium text-gray-800">Email</label>
                            <input type="email" id="user_email" name="user_email" value="{{ $sectional->user_email }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="user_phone" class="block text-lg font-medium text-gray-800">Phone</label>
                            <input type="text" id="user_phone" name="user_phone" value="{{ $sectional->user_phone }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>

                        <div>
                            <label for="user_nic" class="block text-lg font-medium text-gray-800">NIC</label>
                            <input type="text" id="user_nic" name="user_nic" value="{{ $sectional->user_nic }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="user_address_no" class="block text-lg font-medium text-gray-800">Address No</label>
                            <input type="text" id="user_address_no" name="user_address_no" value="{{ $sectional->user_address_no }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>

                        <div>
                            <label for="user_address_street" class="block text-lg font-medium text-gray-800">Address Street</label>
                            <input type="text" id="user_address_street" name="user_address_street" value="{{ $sectional->user_address_street }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="user_address_city" class="block text-lg font-medium text-gray-800">Address City</label>
                            <input type="text" id="user_address_city" name="user_address_city" value="{{ $sectional->user_address_city }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>

                        <div>
                            <label for="user_dob" class="block text-lg font-medium text-gray-800">Date of Birth</label>
                            <input type="date" id="user_dob" name="user_dob" value="{{ \Carbon\Carbon::parse($sectional->user_dob)->format('Y-m-d') }}" class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="profile_picture" class="block text-lg font-medium text-gray-800">Current Profile Picture</label>
                            @if($sectional->profile_picture)
                                <img src="{{ asset('storage/' . $sectional->profile_picture) }}" class="w-24 h-24 rounded-lg shadow border" alt="Profile Picture">
                            @else
                                <p class="text-sm text-gray-500">No image available</p>
                            @endif
                            <input type="file" id="profile_picture" name="profile_picture" class="mt-3 p-3 border border-gray-300 rounded-lg w-full" />
                        </div>

                        <div>
                            <label for="section" class="block text-lg font-medium text-gray-800">Section</label>
                            <select id="section" name="section" class="w-full rounded-lg p-3 border" required>
                                <option value="">Select Section</option>
                                <option value="1-5" {{ $sectional->section == '1-5' ? 'selected' : '' }}>1-5</option>
                                <option value="6-7" {{ $sectional->section == '6-7' ? 'selected' : '' }}>6-7</option>
                                <option value="8-9" {{ $sectional->section == '8-9' ? 'selected' : '' }}>8-9</option>
                                <option value="10-11" {{ $sectional->section == '10-11' ? 'selected' : '' }}>10-11</option>
                                <option value="12-13" {{ $sectional->section == '12-13' ? 'selected' : '' }}>12-13</option>
                            </select>
                        </div>

                        @php
                            $selectedSubjects = is_array($sectional->subjects) ? $sectional->subjects : json_decode($sectional->subjects, true);
                        @endphp

                        <div>
                            <label for="subjects" class="block text-lg font-medium text-gray-800">Subjects</label>

                            {{-- Grades 1–5 --}}
                            <label class="block text-sm font-medium text-gray-700 mt-2">Grades 1–5</label>
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
                                <label>
                                    <input type="checkbox" name="subjects[]" value="{{ $subject }}" class="mr-2"
                                        {{ in_array($subject, $selectedSubjects ?? []) ? 'checked' : '' }}>
                                    {{ $subject }}
                                </label><br>
                            @endforeach

                            {{-- Grades 6–11 --}}
                            <label class="block text-sm font-medium text-gray-700 mt-4">Grades 6–11</label>
                            @foreach([
                                'Science',
                                'History',
                                'Geography',
                                'Civic Education',
                                'Business and Accounting Studies',
                                'Information and Communication Technology'
                            ] as $subject)
                                <label>
                                    <input type="checkbox" name="subjects[]" value="{{ $subject }}" class="mr-2"
                                        {{ in_array($subject, $selectedSubjects ?? []) ? 'checked' : '' }}>
                                    {{ $subject }}
                                </label><br>
                            @endforeach

                            {{-- Grades 12–13 --}}
                            <label class="block text-sm font-medium text-gray-700 mt-4">Grades 12–13</label>
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
                                <label>
                                    <input type="checkbox" name="subjects[]" value="{{ $subject }}" class="mr-2"
                                        {{ in_array($subject, $selectedSubjects ?? []) ? 'checked' : '' }}>
                                    {{ $subject }}
                                </label><br>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>
</html>
