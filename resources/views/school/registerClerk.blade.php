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
    <title>Assign Clerk</title>
</head>
<body class="bg-white flex items-center justify-center min-h-screen">
    <div class="w-full h-screen flex flex-col lg:flex-row">
        <!-- Hamburger Menu for Mobile/Tablet (<1000px) -->
        <button id="hamburger" class="lg:hidden fixed top-4 left-4 z-50 p-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg shadow-md flex items-center">
            <span class="text-2xl">☰</span>
        </button>

        <!-- Sidebar (hidden by default on mobile, toggled by hamburger) -->
        <div id="sidebar" class="hidden lg:flex w-full lg:w-1/4 bg-gradient-to-b from-blue-100 to-gray-500 p-4 lg:p-6 m-0 lg:m-4 rounded-none lg:rounded-xl shadow-none lg:shadow-lg flex-col items-center fixed lg:static top-0 left-0 h-full z-40 bg-opacity-95">
            <img src="{{ asset('storage/photos/school.png') }}" class="w-20 lg:w-24 h-20 lg:h-24 rounded-full border-4 border-white shadow-md mb-4" alt="School Logo" />

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
                <h2 class="text-xl lg:text-2xl font-semibold mb-6">Assign Clerk</h2>
                <div class="max-h-[78vh] overflow-y-auto px-2 pr-4">
                    <form action="{{ route('clerk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @if(session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                        @endif
                        @if(session('error'))
                        <p style="color: red;">{{ session('error') }}</p>
                        @endif
                        <div class="space-y-4">                            
                                <div class="mb-4">
                                <label for="check_nic" class="block text-lg font-medium text-gray-800">Enter NIC to Check Transfer Status</label>
                                <div class="flex space-x-2 mt-2">
                                    <input type="text" id="check_nic" name="check_nic"
                                        class="p-3 border border-gray-300 rounded-lg w-full"
                                        placeholder="Enter NIC...">
                                    <button type="button" onclick="checkClerkNIC()"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                        Check
                                    </button>
                                    <button type="button" onclick="resetNIC()"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                        Reset
                                    </button>
                                </div>

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
                                    <input type="text" id="user_nic" name="user_nic" class="mt-2 p-2 lg:p-3 border border-gray-300 rounded-lg w-full" required/>
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
                                <div id="current-photo-preview" class="mt-2 hidden">
                                    <label class="block text-sm text-gray-700">Current Photo:</label>
                                    <img id="current-profile-pic" src="" alt="Profile Picture" class="w-24 h-24 rounded-lg border mt-2">
                                </div>
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

                            <div class="flex justify-center mt-6 lg:mt-8">
                                <button type="submit" class="bg-gray-500 text-white font-semibold py-2 lg:py-3 px-4 lg:px-6 rounded-lg shadow-md hover:bg-gray-600">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calculate the maximum allowed date (18 years ago from today)
        const today = new Date();
        const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
            .toISOString().split("T")[0];

        // Set the max attribute to enforce the age restriction
        document.getElementById("user_dob").setAttribute("max", maxDate);

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
    <script>
        function checkClerkNIC() {
            const nic = document.getElementById('check_nic').value;

            fetch('{{ route("clerks.checkNIC") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ nic })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'TRANSFERRED') {
                    const clerk = data.clerk;

                    document.getElementById('first_name').value = clerk.first_name;
                    document.getElementById('last_name').value = clerk.last_name;
                    document.getElementById('user_email').value = clerk.user_email;
                    document.getElementById('user_phone').value = clerk.user_phone;
                    document.getElementById('user_nic').value = clerk.user_nic;
                    document.getElementById('user_dob').value = clerk.user_dob;
                    document.getElementById('user_address_no').value = clerk.user_address_no;
                    document.getElementById('user_address_street').value = clerk.user_address_street;
                    document.getElementById('user_address_city').value = clerk.user_address_city;
                    document.getElementById('school_index').value = '';

                    if (clerk.profile_picture) {
                        document.getElementById('current-profile-pic').src = '/storage/' + clerk.profile_picture;
                        document.getElementById('current-photo-preview').classList.remove('hidden');
                    }

                    document.getElementById('user_nic').readOnly = true;
                    document.getElementById('check_nic').readOnly = true;
                    document.querySelector('button[onclick="checkClerkNIC()"]').style.display = 'none';
                } else {
                    alert('This clerk is not marked as transferred.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('NIC not found or error occurred.');
            });
        }

        function resetNIC() {
            document.getElementById('check_nic').value = '';
            document.getElementById('user_nic').value = '';
            document.getElementById('user_nic').readOnly = false;
            document.getElementById('check_nic').readOnly = false;
            document.querySelector('button[onclick="checkClerkNIC()"]').style.display = 'inline-block';
        }
    </script>
</body>
</html>