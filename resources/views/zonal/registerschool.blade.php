<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Register School</title>
    <style>
        body {
            background: url("https://allonehealth.com/wp-content/uploads/2022/07/iStock-1358014313-scaled-1.jpg") no-repeat center center/cover;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white bg-opacity-90 shadow-lg rounded-lg w-full max-w-5xl p-8">
        <div class="bg-gradient-to-b from-blue-100 to-gray-500 p-6 rounded-lg mb-6 text-center">
            <h1 class="text-2xl font-bold text-black-700">Register School</h1>
        </div>

        <form method="post" action="{{ route('school.store') }}" class="grid grid-cols-2 gap-6">
            @csrf
            @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
            @endif

            @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
            @endif
            <h2 class="col-span-2 text-xl font-semibold">School Details</h2>
            <div>
                <label class="block text-black-700 font-medium">School Name</label>
                <input type="text" id="school_name" name="school_name" placeholder="Vishaka Vidyalaya"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">School Number</label>
                <input type="text" id="school_number" name="school_number" placeholder="E344"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <!-- <div>
                <label class="block text-black-700 font-medium">Zonal ID</label>
                <input type="number" id="" name="zonal_id" autocomplete="zonalID" class="p-2 border rounded-lg w-full"
                    required />
            </div> -->

            <!-- can be zonal id from db -->
            <div>
                <label class="block text-black-700 font-medium">Address No</label>
                <input type="text" id="school_address_no" name="school_address_no" placeholder="133"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Street</label>
                <input type="text" id="school_address_street" name="school_address_street" placeholder="Vajira Road"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">City</label>
                <input type="text" id="school_address_city" name="school_address_city" placeholder="Colombo 4"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Email</label>
                <input type="email" id="user_email" name="user_email" placeholder="vishaka@email.com"
                    class="p-2 border rounded-lg w-full" required />
            </div>
            <!-- <div>
                <label class="block text-black-700 font-medium">Password</label>
                <input type="password" id="school_password" name="school_password" placeholder="Password"
                    class="p-2 border rounded-lg w-full" minlength="6" required />
            </div> -->
            <div>
                <label class="block text-black-700 font-medium">Phone</label>
                <input type="tel" id="school_phone" name="school_phone" placeholder="0123456789"
                    class="p-2 border rounded-lg w-full" pattern="[0-9]{10}" required />
            </div>
            <div>
                <label class="block text-black-700 font-medium">Status</label>
                <select id="status" name="status" class="w-full rounded-lg p-3 border" required>
                    <option value="ACTIVE">ACTIVE</option>
                    <option value="INACTIVE">INACTIVE</option>
                </select>
            </div>

            <div class="col-span-2">
                <button type="submit"
                    class="w-full bg-gray-500 py-2 text-white rounded-lg font-bold hover:bg-gray-600 transition">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>

</html>