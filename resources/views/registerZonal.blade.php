<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>ZOnal Register</title>
</head>

<body class="flex items-center justify-center min-h-screen m-0">
    <form action="#" method="POST" class="bg-white w-full max-w-4xl p-8">
        <h2 class="text-2xl font-semibold mb-6 text-center">Registration Form</h2>
        <div class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="zonal_name" class="block text-sm font-medium text-gray-700">Zonal Name</label>
                    <input type="text" id="zonal_name" name="zonal_name"
                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                </div>

                <div>
                    <label for="address_no" class="block text-sm font-medium text-gray-700">Address No</label>
                    <input type="text" id="address_no" name="address_no"
                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="address_street" class="block text-sm font-medium text-gray-700">Address Street</label>
                    <input type="text" id="address_street" name="address_street"
                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                </div>

                <div>
                    <label for="address_city" class="block text-sm font-medium text-gray-700">Address City</label>
                    <input type="text" id="address_city" name="address_city"
                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password"
                        class="mt-2 p-3 border border-gray-300 rounded-lg w-full" required />
                </div>
            </div>

            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="bg-gray-500 text-white font-semibold py-3 px-6 rounded-lg shadow-md hover:bg-gray-600">
                    Submit
                </button>
            </div>
        </div>
    </form>
</body>

</html>