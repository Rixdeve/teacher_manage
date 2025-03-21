<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register Teacher</title>
    <style>
        body {
            background: url("https://allonehealth.com/wp-content/uploads/2022/07/iStock-1358014313-scaled-1.jpg") no-repeat center center/cover;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white bg-opacity-90 shadow-lg rounded-lg w-full max-w-5xl p-8">
        <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mb-6 text-center">
            <h1 class="text-2xl font-bold text-black-700">Register Teacher</h1>
        </div>

        <form method="post" action="{{ route('teacher.store') }}" enctype="multipart/form-data"
            class="grid grid-cols-2 gap-6">
            @csrf
            @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
            @endif

            @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
            @endif
            <h2 class="col-span-2 text-xl font-semibold">Teacher Details</h2>
            <div>
                <label class="block text-black-700 font-medium">First Name</label>
                <input type="text" id="first_name" name="first_name" placeholder="Minaga"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Last Name</label>
                <input type="text" id="last_name" name="last_name" placeholder="Ranathunga"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <!-- <div>
                <label class="block text-black-700 font-medium">Zonal ID</label>
                <input type="number" id="" name="zonal_id" autocomplete="zonalID" class="p-2 border rounded-lg w-full"
                    required />
            </div> -->

            <!-- can be zonal id from db -->
            <div>
                <label class="block text-black-700 font-medium">School Index</label>
                <input type="number" id="school_index" name="school_index" placeholder="2"
                    class="p-2 border rounded-lg w-full" required />
            </div>

            <div>
                <label class="block text-black-700 font-medium">Address Number</label>
                <input type="text" id="user_address_no" name="user_address_no" placeholder="12/1"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Address Street</label>
                <input type="text" id="user_address_street" name="user_address_street" placeholder="Vajira Road"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Address City</label>
                <input type="text" id="user_address_city" name="user_address_city" placeholder="Colombo 5"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">NIC Number</label>
                <input type="text" id="user_nic" name="user_nic" placeholder="750123456V"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Date Of Birth</label>
                <input type="date" id="user_dob" name="user_dob" class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Email</label>
                <input type="email" id="user_email" name="user_email" placeholder="minaga@email.com"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <!-- <div>
                <label class="block text-black-700 font-medium">Password</label>
                <input type="password" id="school_password" name="school_password" placeholder="Password"
                    class="p-2 border rounded-lg w-full" minlength="6" required />
            </div> -->
            <div>
                <label class="block text-black-700 font-medium">Phone</label>
                <input type="tel" id="user_phone" name="user_phone" placeholder="0123456789"
                    class="p-2 border rounded-lg w-full" pattern="[0-9]{10}" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Profile Picture</label>
                <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Status</label>
                <select id="status" name="status" class="w-full rounded-lg p-3 border" required>
                    <optgroup label="Select Status">
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="INACTIVE">INACTIVE</option>
                        <option value="ONLEAVE">ONLEAVE</option>
                    </optgroup>
                </select>
            </div>

            <div class="col-span-2">
                <button type="submit"
                    class="w-full bg-gray-500 py-2 text-white rounded-lg font-bold hover:bg-gray-600 transition">
                    Register Teacher
                </button>
            </div>
        </form>
    </div>
    <script>
        // Calculate the maximum allowed date (18 years ago from today)
        const today = new Date();
        const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate())
            .toISOString().split("T")[0];

        // Set the max attribute to enforce the age restriction
        document.getElementById("user_dob").setAttribute("max", maxDate);
    </script>
</body>

</html>