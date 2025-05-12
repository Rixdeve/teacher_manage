<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Live Absentees | TLMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta http-equiv="refresh" content="15">

</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <button onclick="history.back()"
            class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
            <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
            Back
        </button>
        <h2 class="text-2xl font-bold mb-4">
            Live Absentee List ({{ now()->format('Y-m-d') }})
            <span class="ml-2 text-xs text-red-600 bg-red-100 px-2 py-1 rounded-full animate-pulse">LIVE</span>
        </h2>

        <table class="w-full table-auto border border-gray-300">
            <thead class="bg-red-100 text-red-700">
                <tr>
                    <th class="p-2 border">Photo</th>
                    <th class="p-2 border">First Name</th>
                    <th class="p-2 border">Last Name</th>
                    <th class="p-2 border">Subjects</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absentees as $user)
                <tr class="">
                    <td class="p-2 border ">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile"
                            class="w-14 h-14 self-center rounded-full border border-gray-400" />
                    </td>
                    <td class="p-2 border">{{ $user->first_name }}</td>
                    <td class="p-2 border">{{ $user->last_name }}</td>
                    <td class="p-2 border">
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
                    <td colspan="4" class="p-4 text-center text-gray-500">No Absentees To display.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>