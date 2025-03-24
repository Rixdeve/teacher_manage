<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Attendance Entry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="max-w-6xl mx-auto p-6 bg-white rounded shadow mt-10">
        <h2 class="text-2xl font-bold mb-6">Manual Attendance Entry</h2>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
        @endif

        <form method="POST" action="{{ route('attendance.store') }}">
            @csrf

            <!-- Date Picker -->
            <div class="mb-4">
                <label for="attendance_date" class="block text-gray-700 font-medium mb-2">Select Date:</label>
                <input type="date" name="attendance_date"
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                    required>
            </div>

            <!-- Attendance Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="p-2 text-left">Teacher ID</th>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Check-In</th>
                            <th class="p-2 text-left">Check-Out</th>
                            <th class="p-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teachers as $teacher)
                        <tr class="border-b">
                            <td class="p-2">{{ $teacher->id }}</td>
                            <td class="p-2">{{ $teacher->name }}</td>
                            <td class="p-2">
                                <input type="time" name="teachers[{{ $teacher->id }}][check_in_time]"
                                    class="border border-gray-300 rounded px-2 py-1 w-full">
                            </td>
                            <td class="p-2">
                                <input type="time" name="teachers[{{ $teacher->id }}][check_out_time]"
                                    class="border border-gray-300 rounded px-2 py-1 w-full">
                            </td>
                            <td class="p-2">
                                <select name="teachers[{{ $teacher->id }}][status]"
                                    class="border border-gray-300 rounded px-2 py-1 w-full">
                                    <option value="PRESENT">Present</option>
                                    <option value="ABSENT">Absent</option>
                                </select>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">Submit
                    Attendance</button>
            </div>
        </form>
    </div>

</body>

</html>