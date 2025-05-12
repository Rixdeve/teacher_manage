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
    <title>Assign Principal | TLMS</title>
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
                <button onclick="history.back()" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300 mb-4" aria-label="Go back">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 h-4 mr-2" alt="Back" />
                    Back
                </button>

                <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 mb-4">Assign Principal</h2>
                <div class="max-h-[85vh] overflow-y-auto px-2 pr-4">
                    <div class="mb-4">
                        <label for="check_nic" class="block text-sm font-medium text-gray-800">Enter NIC to Check Transfer Status</label>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 mt-1">
                            <input type="text" id="check_nic" name="check_nic" class="p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter NIC..." required>
                            <button type="button" onclick="checkPrincipalNIC()" class="bg-blue-500 text-white px-3 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">Check</button>
                            <button type="button" onclick="resetNIC()" class="bg-red-500 text-white px-3 py-2 rounded-lg hover:bg-red-600 transition-colors duration-300">Reset</button>
                        </div>
                    </div>

                    <form action="{{ route('principal.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @if(session('success'))
                        <p class="text-green-600 font-semibold text-sm">{{ session('success') }}</p>
                        @endif
                        @if(session('error'))
                        <p class="text-red-600 font-semibold text-sm">{{ session('error') }}</p>
                        @endif
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-800">First Name</label>
                                    <input type="text" id="first_name" name="first_name" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-800">Last Name</label>
                                    <input type="text" id="last_name" name="last_name" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                                <div>
                                    <label for="school_index" class="block text-sm font-medium text-gray-800">School Index</label>
                                    <input type="text" id="school_index" name="school_index" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-800">Email</label>
                                    <input type="email" id="user_email" name="user_email" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-800">Phone Number</label>
                                    <input type="text" id="user_phone" name="user_phone" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                                <div>
                                    <label for="nic" class="block text-sm font-medium text-gray-800">NIC</label>
                                    <input type="text" id="user_nic" name="user_nic" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <div>
                                    <label for="address_no" class="block text-sm font-medium text-gray-800">Address No</label>
                                    <input type="text" id="user_address_no" name="user_address_no" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                                <div>
                                    <label for="address_street" class="block text-sm font-medium text-gray-800">Address Street</label>
                                    <input type="text" id="user_address_street" name="user_address_street" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                                <div>
                                    <label for="address_city" class="block text-sm font-medium text-gray-800">Address City</label>
                                    <input type="text" id="user_address_city" name="user_address_city" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <div>
                                    <label for="dob" class="block text-sm font-medium text-gray-800">Date of Birth</label>
                                    <input type="date" id="user_dob" name="user_dob" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required />
                                </div>
                                <div>
                                    <label for="profile_photo" class="block text-sm font-medium text-gray-800">Profile Photo</label>
                                    <input type="file" id="profile_picture" name="profile_picture" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                                </div>
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-800">Status</label>
                                    <select id="status" name="status" class="mt-1 p-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                        <option value="ONLEAVE">ONLEAVE</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                <div id="current-photo-preview" class="mt-2 hidden">
                                    <label class="block text-xs font-medium text-gray-700">Current Photo:</label>
                                    <img id="current-profile-pic" src="" alt="Profile Picture" class="w-20 h-20 rounded-lg border shadow-md mt-1" />
                                </div>
                            </div>

                            <div class="flex justify-center mt-4">
                                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-5 rounded-lg shadow-md hover:bg-blue-600 transition-colors duration-300">
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

        function checkPrincipalNIC() {
            const nic = document.getElementById('check_nic').value;

            fetch('{{ route("principals.checkNIC") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        nic
                    })
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network error');
                    return response.json();
                })
                .then(data => {
                    if (data.status === 'TRANSFERRED') {
                        const principal = data.principal;

                        document.getElementById('first_name').value = principal.first_name;
                        document.getElementById('last_name').value = principal.last_name;
                        document.getElementById('user_email').value = principal.user_email;
                        document.getElementById('user_phone').value = principal.user_phone;
                        document.getElementById('user_nic').value = principal.user_nic;
                        document.getElementById('user_dob').value = principal.user_dob;
                        document.getElementById('user_address_no').value = principal.user_address_no;
                        document.getElementById('user_address_street').value = principal.user_address_street;
                        document.getElementById('user_address_city').value = principal.user_address_city;
                        document.getElementById('school_index').value = '';

                        if (principal.profile_picture) {
                            const profileImage = document.getElementById('current-profile-pic');
                            profileImage.src = '/storage/' + principal.profile_picture;
                            document.getElementById('current-photo-preview').classList.remove('hidden');
                        }

                        document.getElementById('user_nic').readOnly = true;
                        document.getElementById('check_nic').readOnly = true;
                        document.querySelector('button[onclick="checkPrincipalNIC()"]').style.display = 'none';
                    } else if (data.status === 'not_transferred') {
                        alert('This principal is not marked as transferred.');
                    } else {
                        alert('NIC not found.');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('Something went wrong while checking NIC.');
                });
        }

        function resetNIC() {
            document.getElementById('check_nic').value = '';
            document.getElementById('user_nic').value = '';
            document.getElementById('user_nic').readOnly = false;
            document.getElementById('check_nic').readOnly = false;
            document.querySelector('button[onclick="checkPrincipalNIC()"]').style.display = 'inline-block';
            document.getElementById('current-photo-preview').classList.add('hidden');
        }
    </script>
</body>

</html>