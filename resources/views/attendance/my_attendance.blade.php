<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-6">
    <button onclick="history.back()"
        class="absolute top-6 left-6 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md flex items-center">
        <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
        Back
    </button>
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">My Attendance History</h2>

        <table class="w-full table-auto border border-gray-300">
            <thead class="bg-blue-100">
                <tr>
                    <th class="p-2 border">Date</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Check-In</th>
                    <th class="p-2 border">Check-Out</th>
                    <th class="p-2 border">Method</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $record)
                <tr class="bg-white hover:bg-gray-50">
                    <td class="p-2 border">{{ $record->date }}</td>
                    <td class="p-2 border">{{ $record->status }}</td>
                    <td class="p-2 border">{{ $record->check_in_time ?? '-' }}</td>
                    <td class="p-2 border">{{ $record->check_out_time ?? '-' }}</td>
                    <td class="p-2 border">{{ $record->method }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">No attendance records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>