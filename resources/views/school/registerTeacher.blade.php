<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register Teacher</title>
</head>

<body class="bg-gray-300 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg w-full h-screen flex">
        <div
            class="w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-6 m-4 rounded-xl shadow-lg flex flex-col items-center">

            <img src="{{asset('/storage/photos/school.png')}}"
                class="w-24 h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />

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

        <div class="w-3/4 p-8 relative">
            <button onclick="history.back()"
                class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                Back
            </button>

            @php
            $school = \App\Models\School::find(session('school_id'));
            @endphp

            @if($school)
            <div class="absolute top-6 right-6 flex items-center space-x-3">
                <img src="{{asset('storage/photos/school2.png')}}"
                    class="h-10 w-10 rounded-full border border-gray-400" />
                <div>
                    <h3 class="font-semibold">{{ $school->school_name }}</h3>
                    <h3 class="text-gray-600 text-sm">School</h3>
                </div>
            </div>
            @endif

            <div class="mt-12">
                <h2 class="text-2xl font-semibold mb-6">Assign Teacher</h2>
                <div class="max-h-[78vh] overflow-y-auto px-2 pr-4">

                    <form action="{{route ('teacher.store')}}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf
                        @if(session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                        @endif

                        @if(session('error'))
                        <p style="color: red;">{{ session('error') }}</p>
                        @endif
                        <div class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-lg font-medium text-gray-800">First
                                        Name</label>
                                    <input type="text" id="first_name" name="first_name"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>

                                <div>
                                    <label for="last_name" class="block text-lg font-medium text-gray-800">Last
                                        Name</label>
                                    <input type="text" id="last_name" name="last_name"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="school_index" class="block text-lg font-medium text-gray-800">School
                                        Index</label>
                                    <input type="text" id="school_index" name="school_index"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>

                                <div>
                                    <label for="email" class="block text-lg font-medium text-gray-800">Email</label>
                                    <input type="email" id="user_email" name="user_email"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="phone" class="block text-lg font-medium text-gray-800">Phone
                                        Number</label>
                                    <input type="text" id="user_phone" name="user_phone"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>

                                <div>
                                    <label for="nic" class="block text-lg font-medium text-gray-800">NIC</label>
                                    <input type="text" id="user_nic" name="user_nic"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="address_no" class="block text-lg font-medium text-gray-800">Address
                                        No</label>
                                    <input type="text" id="user_address_no" name="user_address_no"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>

                                <div>
                                    <label for="address_street" class="block text-lg font-medium text-gray-800">Address
                                        Street</label>
                                    <input type="text" id="user_address_street" name="user_address_street"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="address_city" class="block text-lg font-medium text-gray-800">Address
                                        City</label>
                                    <input type="text" id="user_address_city" name="user_address_city"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>

                                <div>
                                    <label for="dob" class="block text-lg font-medium text-gray-800">Date of
                                        Birth</label>
                                    <input type="date" id="user_dob" name="user_dob"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="profile_photo" class="block text-lg font-medium text-gray-800">Profile
                                        Photo</label>
                                    <input type="file" id="profile_picture" name="profile_picture"
                                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" />
                                </div>

                                <div>
                                    <label for="status" class="block text-lg font-medium text-gray-800">Status</label>
                                    <select id="status" name="status" class="w-full rounded-lg p-3 border" required>
                                        <optgroup label="Select Status">
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="INACTIVE">INACTIVE</option>
                                            <option value="ONLEAVE">ONLEAVE</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="section" class="block text-lg font-medium text-gray-800">Section</label>
                                    <select id="section" name="section" class="w-full rounded-lg p-3 border" required>
                                        <optgroup label="Select Section">
                                            <option value="1-5">1-5</option>
                                            <option value="6-7">6-7</option>
                                            <option value="8-9">8-9</option>
                                            <option value="10-11">10-11</option>
                                            <option value="12-12">12-13</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="subjects" class="block text-lg font-medium text-gray-800">Subjects</label>
                                <br>
                                <label for=" subjects" class="block text-sm font-medium text-gray-700">Grades
                                    1-5</label>

                                <label><input type="checkbox" name="subjects[]" value="Sinhala (First Language)"
                                        class="mr-2">
                                    Sinhala (First Language)</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Tamil (First Language)"
                                        class="mr-2">
                                    Tamil (First Language)</label><br>
                                <label><input type="checkbox" name="subjects[]" value="English Language" class="mr-2">
                                    English Language</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Mathematics" class="mr-2">
                                    Mathematics</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Environmental Studies"
                                        class="mr-2">
                                    Environmental Studies</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Religion" class="mr-2">
                                    Religion</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies" class="mr-2">
                                    Aesthetic Studies</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Health and Physical Education"
                                        class="mr-2">
                                    Health and Physical Education
                                </label><br>
                                <label><input type="checkbox" name="subjects[]"
                                        value="Life Competencies and Civic Education" class="mr-2">
                                    Life Competencies and Civic Education
                                </label><br>

                                <label for="subjects" class="block text-sm font-medium text-gray-700">Grades
                                    6-11</label>

                                <label><input type="checkbox" name="subjects[]" value="Sinhala (First Language)"
                                        class="mr-2">
                                    Sinhala (First Language)</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Sinhala (First Language)"
                                        class="mr-2">
                                    Sinhala (First Language)</label><br>
                                <label><input type="checkbox" name="subjects[]" value="English Language" class="mr-2">
                                    English Language</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Mathematics" class="mr-2">
                                    Mathematics</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Science" class="mr-2">
                                    Science</label><br>
                                <label><input type="checkbox" name="subjects[]" value="History" class="mr-2">
                                    History</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Religion" class="mr-2">
                                    Religion</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Geography" class="mr-2">
                                    Geography</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Civic Education" class="mr-2">
                                    Civic Education</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Business and Accounting Studies"
                                        class="mr-2">
                                    Business and Accounting Studies</label><br>
                                <label><input type="checkbox" name="subjects[]"
                                        value="Information and Communication Technology" class="mr-2">
                                    Information and Communication Technology</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Agriculture and Food Technology"
                                        class="mr-2">
                                    Agriculture and Food Technology</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Health and Physical Education"
                                        class="mr-2">
                                    Health and Physical Education</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Second Language" class="mr-2">
                                    Second Language</label><br>
                                <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies" class="mr-2">
                                    Aesthetic Studies</label><br>

                                <label for="subjects" class="block text-sm font-medium text-gray-700">Grades
                                    12-13</label>
                                <label><input type="checkbox" name="subjects[]" value="Sinhala Literature" class="mr-2">
                                    Sinhala Literature
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Tamil Literature" class="mr-2">
                                    Tamil Literature
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="English Literature" class="mr-2">
                                    English Literature
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="History" class="mr-2">
                                    History
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Geography" class="mr-2">
                                    Geography
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Political Science" class="mr-2">
                                    Political Science
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Logic and Scientific Method"
                                        class="mr-2">
                                    Logic and Scientific Method
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Economics" class="mr-2">
                                    Economics
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Buddhism" class="mr-2">
                                    Buddhism
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Hinduism" class="mr-2">
                                    Hinduism
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Islam" class="mr-2">
                                    Islam
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Christianity" class="mr-2">
                                    Christianity
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Art"
                                        class="mr-2">
                                    Aesthetic Studies Art
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Music"
                                        class="mr-2">
                                    Aesthetic Studies Music
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Dance"
                                        class="mr-2">
                                    Aesthetic Studies Dance
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Drama"
                                        class="mr-2">
                                    Aesthetic Studies Drama
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Media Studies" class="mr-2">
                                    Media Studies
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Information Technology"
                                        class="mr-2">
                                    Information Technology
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Entrepreneurship Studies"
                                        class="mr-2">
                                    Entrepreneurship Studies
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Physics" class="mr-2">
                                    Physics
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Chemistry" class="mr-2">
                                    Chemistry
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Biology" class="mr-2">
                                    Biology
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Combined Mathematics"
                                        class="mr-2">
                                    Combined Mathematics
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Agriculture" class="mr-2">
                                    Agriculture
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Information Technology"
                                        class="mr-2">
                                    Information Technology
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Science for Technology"
                                        class="mr-2">
                                    Science for Technology
                                </label><br>
                                <label><input type="checkbox" name="subjects[]" value="Bio-systems Technology"
                                        class="mr-2">
                                    Bio-systems Technology
                                </label><br>
                                <label><input type="checkbox" name="subjects[]"
                                        value="Information and Communication Technology" class="mr-2">
                                    Information and Communication Technology
                                </label><br>

                            </div>

                        </div>
                        <div class="flex justify-center mt-8">
                            <button type="submit"
                                class="bg-gray-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-gray-600">
                                Register
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>