<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>School Dashboard</title>
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
                <h2 class="text-2xl font-semibold mb-6">Assign Principal</h2>
                <div class="max-h-[78vh] overflow-y-auto px-2 pr-4">

                    <div class="mb-4">
                        <label for="check_nic" class="block text-lg font-medium text-gray-800">Enter NIC to Check Transfer Status</label>
                        <div class="flex space-x-2 mt-2">
                            <input type="text" id="check_nic" name="check_nic"
                                class="p-3 border border-gray-300 rounded-lg w-full"
                                placeholder="Enter NIC..." required>
                            <button type="button" onclick="checkPrincipalNIC()"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">
                                Check
                            </button>
                            <button type="button" onclick="resetNIC()"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                                Reset
                            </button>
                        </div>
                    </div>

                    <form action="{{route ('principal.store')}}" method="POST" enctype="multipart/form-data"
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
                                <div id="current-photo-preview" class="mt-2 hidden">
                                    <label class="block text-sm text-gray-700">Current Photo:</label>
                                    <img id="current-profile-pic" src="" alt="Profile Picture" class="w-24 h-24 rounded-lg border mt-2">
                                </div>

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
    <script>
        // Calculate the maximum allowed date (18 years ago from today)
        const today = new Date();
        const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
            .toISOString().split("T")[0];

        // Set the max attribute to enforce the age restriction
        document.getElementById("user_dob").setAttribute("max", maxDate);
    </script>
    <script>
        function checkPrincipalNIC() {
            const nic = document.getElementById('check_nic').value;

            fetch('{{ route("principals.checkNIC") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ nic })
            })
            .then(response => {
                if (!response.ok) throw new Error('Network error');
                return response.json();
            })
            .then(data => {
                if (data.status === 'TRANSFERRED') {
                    const principal = data.principal; // make sure key matches

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
    </script>
</body>

</html>