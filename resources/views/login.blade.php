<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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
</head>

<body class="bg-gray-100 font-sans min-h-screen antialiased flex items-center justify-center">
    <div class="w-full h-screen flex flex-col lg:flex-row shadow-custom rounded-none overflow-hidden">

        <div class="w-full lg:w-1/2 h-[300px] lg:h-full bg-cover bg-center"
            style="background-image: url('https://www.bci.lk/wp-content/uploads/2022/04/Bachelor-of-Education-Honours-in-Primary-Education.jpg')">
        </div>


        <div
            class="w-full lg:w-1/2 bg-gradient-to-b from-blue-50 to-gray-100 flex flex-col justify-center items-center p-4 lg:p-8 rounded-none">
            <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-800 mb-4">Login</h2>
            <p class="text-gray-500 text-base italic mb-6">Access your dashboard in TLMS</p>

            <form action="{{ route('login.submit') }}" method="POST" class="w-full max-w-md">
                @csrf
                <div
                    class="max-h-[300px] overflow-y-auto p-6 border border-gray-200 rounded-2xl mb-6 bg-white shadow-custom">
                    <div class="mb-4">
                        <label for="user_email"
                            class="block text-gray-700 text-sm lg:text-base font-semibold">Email</label>
                        <div class="relative">
                            <input type="email" id="user_email" name="user_email"
                                class="w-full p-3 pl-10 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 shadow-sm bg-white transition-transform duration-300 focus:scale-105"
                                placeholder="Enter your email" required />
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                </path>
                            </svg>
                        </div>
                        @error('user_email')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="user_password"
                            class="block text-gray-700 text-sm lg:text-base font-semibold">Password</label>
                        <div class="relative">
                            <input type="password" id="user_password" name="user_password"
                                class="w-full p-3 pl-10 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600 shadow-sm bg-white transition-transform duration-300 focus:scale-105"
                                placeholder="Enter your password" required />
                            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0-1.1-.9-2-2-2s-2 .9-2 2 2 4 2 4m2-4c0-1.1.9-2 2-2s2 .9 2 2-2 4-2 4m-6 5c0 1.1.9 2 2 2s2-.9 2-2m-8-7h16m-2-7H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2z">
                                </path>
                            </svg>
                        </div>
                        @error('user_password')
                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if ($errors->has('login_error'))
                <div
                    class="bg-red-100 text-red-500 p-4 rounded-2xl mb-6 border border-red-200 shadow-custom animate-pulse">
                    {{ $errors->first('login_error') }}
                </div>
                @endif
                <button type="submit"
                    class="w-full bg-gray-600 text-white py-3 px-6 rounded-full hover:bg-gray-700 transition-all duration-300 shadow-md hover:shadow-custom-hover font-semibold text-base hover:scale-105 flex items-center justify-center gap-2">
                    <span>Login</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
                <div class="mt-4 text-center">
                    <p class="text-gray-600 text-sm">Forgot password? <a href="{{ route('password.request') }}"
                            class="text-gray-600 hover:underline">Reset it here</a></p>
            </form>
        </div>
    </div>
</body>

</html>