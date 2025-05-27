<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @include('partials.theme')
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta http-equiv="refresh" content="15">
    <script>
        tailwind.config = {
            darkMode: 'class',
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
    <title>Live Absentees | TLMS</title>
</head>

<body class="bg-white text-black dark:bg-gray-900 dark:text-white font-sans flex items-center justify-center min-h-screen antialiased">
    <div class="w-full h-screen p-4 lg:p-8 relative">
        <!-- Back Button -->
        <button onclick="history.back()"
            class="absolute top-4 lg:top-6 left-4 lg:left-6 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-semibold py-1.5 px-3 lg:px-4 rounded-full shadow-md hover:shadow-custom-hover transition-all duration-300 flex items-center z-50">
            <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2"
                alt="Back" />
            Back
        </button>

        <!-- Profile Section -->
        <div class="absolute top-4 lg:top-6 right-4 lg:right-6 flex items-center space-x-3">
            <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                class="h-8 lg:h-10 w-8 lg:w-10 rounded-full border border-gray-400 dark:border-gray-600" alt="Profile" />
            <div>
                <a href="{{ url('/show') }}">
                    <h3 class="font-semibold text-sm lg:text-base text-gray-800 dark:text-white">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h3>
                    <h3 class="text-gray-600 dark:text-gray-400 text-xs lg:text-sm">{{ ucfirst(strtolower(Auth::user()->role)) }}</h3>
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="mt-20 lg:mt-12 max-w-full lg:max-w-6xl mx-auto">
            <!-- Welcome Card -->
            <div class="bg-gradient-to-b from-blue-100 to-gray-500 dark:from-gray-800 dark:to-gray-600 p-4 lg:p-6 rounded-lg mb-4 lg:mb-6 relative">
                <p class="text-gray-700 dark:text-gray-300 text-sm lg:text-base">Welcome back!</p>
                <h1 class="text-xl lg:text-2xl font-bold text-gray-800 dark:text-white">{{ Auth::user()->first_name }}</h1>
            </div>

            <!-- Title and LIVE Badge -->
            <h2 class="text-xl lg:text-2xl font-semibold text-gray-800 dark:text-white mb-4 lg:mb-6">
                Live Absentee List ({{ now()->format('Y-m-d') }})
                <span class="ml-2 text-xs text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-800 px-2 py-1 rounded-full animate-pulse">LIVE</span>
            </h2>

            <!-- Absentee Table Card (Scrollable) -->
            @if (empty($absentees) || $absentees->isEmpty())
            <div class="bg-blue-100 dark:bg-gray-800 p-4 lg:p-6 rounded-2xl shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                <p class="text-gray-600 dark:text-gray-400 text-sm lg:text-base">No absentees to display.</p>
            </div>
            @else
            <div class="bg-blue-100 dark:bg-gray-800 p-4 lg:p-6 rounded-2xl shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1 max-h-96 lg:max-h-[500px] overflow-y-auto">
                <div class="overflow-x-auto">
                    <table class="w-full table-auto border-collapse">
                        <thead class="bg-red-100 dark:bg-red-800 text-red-700 dark:text-red-200 sticky top-0">
                            <tr>
                                <th class="p-2 lg:p-3 text-left text-xs lg:text-sm border border-gray-300 dark:border-gray-600">Photo</th>
                                <th class="p-2 lg:p-3 text-left text-xs lg:text-sm border border-gray-300 dark:border-gray-600">First Name</th>
                                <th class="p-2 lg:p-3 text-left text-xs lg:text-sm border border-gray-300 dark:border-gray-600">Last Name</th>
                                <th class="p-2 lg:p-3 text-left text-xs lg:text-sm border border-gray-300 dark:border-gray-600">Role</th>
                                <th class="p-2 lg:p-3 text-left text-xs lg:text-sm border border-gray-300 dark:border-gray-600">School Index</th>
                                <th class="p-2 lg:p-3 text-left text-xs lg:text-sm border border-gray-300 dark:border-gray-600">Section</th>
                                <th class="p-2 lg:p-3 text-left text-xs lg:text-sm border border-gray-300 dark:border-gray-600">Subjects</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-300 dark:divide-gray-600">
                            @foreach($absentees as $user)
                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="p-2 lg:p-3 border border-gray-300 dark:border-gray-600">
                                    <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                        alt="Profile"
                                        class="w-10 lg:w-14 h-10 lg:h-14 rounded-full border border-gray-400 dark:border-gray-600 mx-auto" />
                                </td>
                                <td class="p-2 lg:p-3 text-xs lg:text-sm text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">{{ $user->first_name }}</td>
                                <td class="p-2 lg:p-3 text-xs lg:text-sm text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">{{ $user->last_name }}</td>
                                <td class="p-2 lg:p-3 text-xs lg:text-sm text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">{{ ucfirst(strtolower($user->role)) }}</td>
                                <td class="p-2 lg:p-3 text-xs lg:text-sm text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">{{ $user->school_index }}</td>
                                <td class="p-2 lg:p-3 text-xs lg:text-sm text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">{{ $user->section }}</td>
                                <td class="p-2 lg:p-3 text-xs lg:text-sm text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">
                                    @if(is_array($user->subjects))
                                    @foreach($user->subjects as $subject)
                                    <span class="block">{{ $subject }}</span>
                                    @endforeach
                                    @else
                                    <span class="text-gray-500 dark:text-gray-400 italic text-xs lg:text-sm">No subjects</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</body>
</html>