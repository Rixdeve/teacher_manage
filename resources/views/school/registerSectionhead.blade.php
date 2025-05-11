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
    <title>Register Sectional Head | TLMS</title>
</head>

<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar (hidden by default on mobile, toggled by hamburger) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-full z-40 bg-opacity-95">
            <img src="{{ asset('/storage/photos/school.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />

            <ul class="space-y-4 w-full">
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/schoolDashboard') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/dashboard.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Dashboard" />
                        Dashboard
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerPrincipal') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/boss.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Principal" />
                        Assign Principal
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerClerk') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/immigration.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Clerk" />
                        Assign Clerk
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerTeacher') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/classroom.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Teacher" />
                        Assign Teacher
                    </a>
                </li>
                <li class="w-full lg:w-48 py-2 flex items-center text-black font-semibold cursor-pointer hover:bg-gray-200 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/registerSectionhead') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/teachernew.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Assign Section" />
                        Assign Sectional Head
                    </a>
                </li>
                <li class="mt-8 lg:mt-12 w-full lg:w-48 py-2 flex items-center text-red-500 font-bold hover:text-red-700 cursor-pointer hover:bg-gray-300 rounded-lg p-2 mx-auto">
                    <a href="{{ url('/logout') }}" class="flex items-center w-full">
                        <img src="{{ asset('storage/photos/logout.png') }}" class="w-6 lg:w-8 h-6 lg:h-8 mr-2" alt="Logout" />
                        Logout
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-3/4 p-4 lg:p-8 relative">
            @php
            $school = \App\Models\School::find(session('school_id'));
            @endphp

            @if($school)
            <div class="absolute top-16 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
                <img src="{{ asset('storage/photos/school2.png') }}" class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400" alt="School Logo" />
                <div>
                    <h3 class="font-semibold text-sm lg:text-base">{{ $school->school_name }}</h3>
                    <h3 class="text-gray-600 text-xs lg:text-sm">School</h3>
                </div>
            </div>
            @endif

            <button onclick="history.back()" class="absolute top-24 lg:top-6 left-4 lg:left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 lg:py-2 lg:px-4 rounded-lg shadow-md flex items-center" aria-label="Go back">
                <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2" alt="Back" />
                Back
            </button>

            <div class="mt-32 lg:mt-12">
                <h2 class="text-xl lg:text-2xl font-semibold mb-6">Assign Sectional Head</h2>
                <div class="max-h-[60vh] overflow-y-auto px-2 pr-4">
                    <form action="{{ route('sectionhead.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                                    <label for="first_name" class="block text-sm lg:text-lg font-medium text-gray-800">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm lg:text-lg font-medium text-gray-800">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="school_index" class="block text-sm lg:text-lg font-medium text-gray-800">School Index</label>
                                    <input type="text" id="school_index" name="school_index" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                                <div>
                                    <label for="email" class="block text-sm lg:text-lg font-medium text-gray-800">Email</label>
                                    <input type="email" id="user_email" name="user_email" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="phone" class="block text-sm lg:text-lg font-medium text-gray-800">Phone Number</label>
                                    <input type="text" id="user_phone" name="user_phone" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                                <div>
                                    <label for="nic" class="block text-sm lg:text-lg font-medium text-gray-800">NIC</label>
                                    <input type="text" id="user_nic" name="user_nic" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="address_no" class="block text-sm lg:text-lg font-medium text-gray-800">Address No</label>
                                    <input type="text" id="user_address_no" name="user_address_no" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                                <div>
                                    <label for="address_street" class="block text-sm lg:text-lg font-medium text-gray-800">Address Street</label>
                                    <input type="text" id="user_address_street" name="user_address_street" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="address_city" class="block text-sm lg:text-lg font-medium text-gray-800">Address City</label>
                                    <input type="text" id="user_address_city" name="user_address_city" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                                <div>
                                    <label for="dob" class="block text-sm lg:text-lg font-medium text-gray-800">Date of Birth</label>
                                    <input type="date" id="user_dob" name="user_dob" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="profile_photo" class="block text-sm lg:text-lg font-medium text-gray-800">Profile Photo</label>
                                    <input type="file" id="profile_picture" name="profile_picture" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" />
                                </div>
                                <div>
                                    <label for="status" class="block text-sm lg:text-lg font-medium text-gray-800">Status</label>
                                    <select id="status" name="status" class="w-full rounded-lg p-2 lg:p-3 border" required>
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
                                    <label for="section" class="block text-sm lg:text-lg font-medium text-gray-800">Section</label>
                                    <select id="section" name="section" class="w-full rounded-lg p-2 lg:p-3 border" required>
                                        <optgroup label="Select Section">
                                            <option value="1-5">1-5</option>
                                            <option value="6-7">6-7</option>
                                            <option value="8-9">8-9</option>
                                            <option value="10-11">10-11</option>
                                            <option value="12-13">12-13</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label for="subjects" class="block text-sm lg:text-lg font-medium text-gray-800">Subjects</label>
                                <div class="max-h-[60vh] overflow-y-auto p-2">
                                    <label for="subjects" class="block text-xs lg:text-sm font-medium text-gray-700">Grades 1-5</label>
                                    <label><input type="checkbox" name="subjects[]" value="Sinhala (First Language)" class="mr-1 lg:mr-2"> Sinhala (First Language)</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Tamil (First Language)" class="mr-1 lg:mr-2"> Tamil (First Language)</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="English Language" class="mr-1 lg:mr-2"> English Language</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Mathematics" class="mr-1 lg:mr-2"> Mathematics</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Environmental Studies" class="mr-1 lg:mr-2"> Environmental Studies</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Religion" class="mr-1 lg:mr-2"> Religion</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies" class="mr-1 lg:mr-2"> Aesthetic Studies</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Health and Physical Education" class="mr-1 lg:mr-2"> Health and Physical Education</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Life Competencies and Civic Education" class="mr-1 lg:mr-2"> Life Competencies and Civic Education</label><br>

                                    <label for="subjects" class="block text-xs lg:text-sm font-medium text-gray-700">Grades 6-11</label>
                                    <label><input type="checkbox" name="subjects[]" value="Sinhala (First Language)" class="mr-1 lg:mr-2"> Sinhala (First Language)</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Tamil (First Language)" class="mr-1 lg:mr-2"> Tamil (First Language)</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="English Language" class="mr-1 lg:mr-2"> English Language</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Mathematics" class="mr-1 lg:mr-2"> Mathematics</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Science" class="mr-1 lg:mr-2"> Science</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="History" class="mr-1 lg:mr-2"> History</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Religion" class="mr-1 lg:mr-2"> Religion</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Geography" class="mr-1 lg:mr-2"> Geography</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Civic Education" class="mr-1 lg:mr-2"> Civic Education</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Business and Accounting Studies" class="mr-1 lg:mr-2"> Business and Accounting Studies</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Information and Communication Technology" class="mr-1 lg:mr-2"> Information and Communication Technology</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Agriculture and Food Technology" class="mr-1 lg:mr-2"> Agriculture and Food Technology</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Health and Physical Education" class="mr-1 lg:mr-2"> Health and Physical Education</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Second Language" class="mr-1 lg:mr-2"> Second Language</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies" class="mr-1 lg:mr-2"> Aesthetic Studies</label><br>

                                    <label for="subjects" class="block text-xs lg:text-sm font-medium text-gray-700">Grades 12-13</label>
                                    <label><input type="checkbox" name="subjects[]" value="Sinhala Literature" class="mr-1 lg:mr-2"> Sinhala Literature</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Tamil Literature" class="mr-1 lg:mr-2"> Tamil Literature</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="English Literature" class="mr-1 lg:mr-2"> English Literature</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="History" class="mr-1 lg:mr-2"> History</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Geography" class="mr-1 lg:mr-2"> Geography</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Political Science" class="mr-1 lg:mr-2"> Political Science</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Logic and Scientific Method" class="mr-1 lg:mr-2"> Logic and Scientific Method</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Economics" class="mr-1 lg:mr-2"> Economics</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Buddhism" class="mr-1 lg:mr-2"> Buddhism</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Hinduism" class="mr-1 lg:mr-2"> Hinduism</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Islam" class="mr-1 lg:mr-2"> Islam</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Christianity" class="mr-1 lg:mr-2"> Christianity</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Art" class="mr-1 lg:mr-2"> Aesthetic Studies Art</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Music" class="mr-1 lg:mr-2"> Aesthetic Studies Music</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Dance" class="mr-1 lg:mr-2"> Aesthetic Studies Dance</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Aesthetic Studies Drama" class="mr-1 lg:mr-2"> Aesthetic Studies Drama</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Media Studies" class="mr-1 lg:mr-2"> Media Studies</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Information Technology" class="mr-1 lg:mr-2"> Information Technology</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Entrepreneurship Studies" class="mr-1 lg:mr-2"> Entrepreneurship Studies</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Physics" class="mr-1 lg:mr-2"> Physics</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Chemistry" class="mr-1 lg:mr-2"> Chemistry</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Biology" class="mr-1 lg:mr-2"> Biology</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Combined Mathematics" class="mr-1 lg:mr-2"> Combined Mathematics</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Agriculture" class="mr-1 lg:mr-2"> Agriculture</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Information Technology" class="mr-1 lg:mr-2"> Information Technology</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Science for Technology" class="mr-1 lg:mr-2"> Science for Technology</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Bio-systems Technology" class="mr-1 lg:mr-2"> Bio-systems Technology</label><br>
                                    <label><input type="checkbox" name="subjects[]" value="Information and Communication Technology" class="mr-1 lg:mr-2"> Information and Communication Technology</label><br>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-6 lg:mt-8">
                            <button type="submit" class="bg-gray-500 text-white font-semibold py-2 lg:py-3 px-4 lg:px-6 rounded-lg shadow-md hover:bg-gray-600">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
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