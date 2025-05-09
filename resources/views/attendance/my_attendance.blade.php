<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <div class="w-full p-4 sm:p-6 lg:p-8">
        <div class="max-w-6xl mx-auto bg-white rounded-lg sm:shadow-lg p-4 sm:p-6">
            <!-- Heading and Back Button -->
            <div class="mb-4 sm:mb-6">
                <h2 class="text-xl sm:text-2xl font-bold">My Attendance History</h2>
                <button onclick="history.back()" class="sm:absolute sm:top-4 sm:left-4 mt-2 sm:mt-0 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-1.5 px-3 sm:py-2 sm:px-4 rounded-lg shadow-md flex items-center" aria-label="Go back">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-4 h-4 sm:w-5 sm:h-5 mr-2" alt="Back" />
                    Back
                </button>
            </div>

            <!-- Present and Absent Boxes (stacked as rows on mobile, side-by-side on larger screens) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-6 mb-6 sm:mb-8">
                <div class="bg-green-200 p-3 sm:p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <h3 class="text-base sm:text-lg font-semibold text-green-800">Total Present</h3>
                    <p class="text-xl sm:text-3xl font-bold text-green-700">{{ $attendances->where('status', 'PRESENT')->count() }}</p>
                </div>
                <div class="bg-red-200 p-3 sm:p-6 rounded-lg text-center shadow-md hover:shadow-lg">
                    <h3 class="text-base sm:text-lg font-semibold text-red-800">Total Absent</h3>
                    <p class="text-xl sm:text-3xl font-bold text-red-700">{{ $attendances->where('status', 'ABSENT')->count() }}</p>
                </div>
            </div>

            <!-- Attendance Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto border border-gray-300 text-sm sm:text-base">
                    <thead class="bg-blue-100">
                        <tr>
                            <th scope="col" class="p-1 sm:p-2 border">Date</th>
                            <th scope="col" class="p-1 sm:p-2 border">Status</th>
                            <th scope="col" class="p-1 sm:p-2 border">Check-In</th>
                            <th scope="col" class="p-1 sm:p-2 border">Check-Out</th>
                            <th scope="col" class="p-1 sm:p-2 border">Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $record)
                        <tr class="bg-white hover:bg-gray-50">
                            <td class="p-1 sm:p-2 border">{{ $record->date }}</td>
                            <td class="p-1 sm:p-2 border">{{ $record->status }}</td>
                            <td class="p-1 sm:p-2 border">{{ $record->check_in_time ?? '-' }}</td>
                            <td class="p-1 sm:p-2 border">{{ $record->check_out_time ?? '-' }}</td>
                            <td class="p-1 sm:p-2 border">{{ $record->method ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center p-4 text-gray-500 text-sm sm:text-base">No attendance records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>