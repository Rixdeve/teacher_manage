<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Password Reset | TLMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-white p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Forgot Your Password?</h2>
        <p class="text-sm text-gray-600 text-center mb-6">
            Enter your email and select account type to receive a password reset link.
        </p>

        @if (session('status'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 px-4 py-2 rounded">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Account Type</label>
                <select name="type" id="type" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Select account type</option>
                    <option value="user" {{ old('type') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="school" {{ old('type') == 'school' ? 'selected' : '' }}>School</option>
                    <option value="zonal" {{ old('type') == 'zonal' ? 'selected' : '' }}>Zonal</option>
                </select>
            </div>

            <div>
                <button type="submit"
                    class="w-full bg-gray-600 text-white font-bold py-2 px-4 rounded hover:bg-gray-700 transition">
                    Send Reset Link
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('login') }}" class="text-gray-500 hover:underline text-sm">Back to Login</a>
        </div>
    </div>
</body>

</html>