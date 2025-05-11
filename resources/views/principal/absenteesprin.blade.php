<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live Absentees</title>
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
    <meta http-equiv="refresh" content="15">
</head>
<body class="bg-gray-100 p-4 lg:p-6">
    <div class="relative w-full max-w-full lg:max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-4 lg:p-6">
        <button onclick="history.back()" class="absolute top-4 left-4 lg:top-6 lg:left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 lg:py-2 lg:px-4 rounded-lg shadow-md flex items-center z-50">
            <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 lg:w-5 h-4 lg:h-5 mr-2" alt="Back" />
            Back
        </button>

        <div class="mt-16 lg:mt-12">
            <h2 class="text-xl lg:text-2xl font-bold mb-3 lg:mb-4">
                Live Absentee List ({{ now()->format('Y-m-d') }})
                <span class="ml-2 text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full animate-pulse">LIVE</span>
            </h2>

            <div class="overflow-x-auto">
                <table class="w-full table-auto border border-gray-300">
                    <thead class="bg-red-100 text-red-700">
                        <tr>
                            <th class="p-2 lg:p-2 border text-sm lg:text-base">Photo</th>
                            <th class="p-2 lg:p-2 border text-sm lg:text-base">First Name</th>
                            <th class="p-2 lg:p-2 border text-sm lg:text-base">Last Name</th>
                            <th class="p-2 lg:p-2 border text-sm lg:text-base">Role</th>
                            <th class="p-2 lg:p-2 border text-sm lg:text-base">School Index</th>
                            <th class="p-2 lg:p-2 border text-sm lg:text-base">Section</th>
                            <th class="p-2 lg:p-2 border text-sm lg:text-base">Subjects</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($absentees as $user)
                        <tr>
                            <td class="p-2 lg:p-2 border">
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile" class="w-10 lg:w-14 h-10 lg:h-14 self-center rounded-full border border-gray-400 mx-auto" />
                            </td>
                            <td class="p-2 lg:p-2 border text-sm lg:text-base">{{ $user->first_name }}</td>
                            <td class="p-2 lg:p-2 border text-sm lg:text-base">{{ $user->last_name }}</td>
                            <td class="p-2 lg:p-2 border text-sm lg:text-base">{{ ucfirst(strtolower($user->role)) }}</td>
                            <td class="p-2 lg:p-2 border text-sm lg:text-base">{{ $user->school_index }}</td>
                            <td class="p-2 lg:p-2 border text-sm lg:text-base">{{ $user->section }}</td>
                            <td class="p-2 lg:p-2 border text-sm lg:text-base">
                                @if(is_array($user->subjects))
                                @foreach($user->subjects as $subject)
                                <span class="block">{{ $subject }}</span>
                                @endforeach
                                @else
                                <span class="text-gray-500 italic">No subjects</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-3 lg:p-4 text-center text-gray-500 text-sm lg:text-base">No Absentees To display.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>