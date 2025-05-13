<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Attendance</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>

<body class="bg-white font-sans flex flex-col min-h-screen antialiased">
    <div class="w-full p-6 lg:p-8">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-custom p-6 lg:p-8">
            <!-- Back Button -->
            <div class="mb-4 lg:mb-6">
                <button onclick="history.back()"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-full shadow-md hover:shadow-custom-hover flex items-center transition-shadow duration-300"
                    aria-label="Go back">
                    <img src="https://cdn-icons-png.flaticon.com/512/271/271220.png" class="w-5 h-5 mr-2" alt="Back" />
                    Back
                </button>
            </div>

            <!-- Heading -->
            <div class="mb-6 lg:mb-8">
                <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">My Attendance History</h2>
            </div>

            <!-- Present and Absent Boxes -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8 lg:mb-10">
                <div
                    class="bg-green-200 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-lg lg:text-xl font-semibold text-green-800">Total Present</h3>
                    <p class="text-3xl lg:text-4xl font-bold text-green-700">
                        {{ $attendances->where('status', 'PRESENT')->count() }}
                    </p>
                </div>
                <div
                    class="bg-red-200 p-6 rounded-2xl text-center shadow-custom hover:shadow-custom-hover transition-all duration-300 transform hover:-translate-y-1">
                    <h3 class="text-lg lg:text-xl font-semibold text-red-800">Total Absent</h3>
                    <p class="text-3xl lg:text-4xl font-bold text-red-700">
                        {{ $attendances->where('status', 'ABSENT')->count() }}
                    </p>
                </div>
            </div>


            <!-- Attendance Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto border-collapse border border-gray-300 rounded-lg">
                    <thead class="bg-blue-100">
                        <tr>
                            <th scope="col"
                                class="p-3 border border-gray-300 text-sm lg:text-base font-semibold text-gray-800">Date
                            </th>
                            <th scope="col"
                                class="p-3 border border-gray-300 text-sm lg:text-base font-semibold text-gray-800">
                                Status</th>
                            <th scope="col"
                                class="p-3 border border-gray-300 text-sm lg:text-base font-semibold text-gray-800">
                                Check-In</th>
                            <th scope="col"
                                class="p-3 border border-gray-300 text-sm lg:text-base font-semibold text-gray-800">
                                Check-Out</th>
                            <th scope="col"
                                class="p-3 border border-gray-300 text-sm lg:text-base font-semibold text-gray-800">
                                Method</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $record)
                        <tr class="bg-white hover:bg-gray-50 transition-colors duration-200">
                            <td class="p-3 border border-gray-300 text-sm lg:text-base text-gray-800">
                                {{ $record->date }}
                            </td>
                            <td class="p-3 border border-gray-300 text-sm lg:text-base text-gray-800">
                                {{ $record->status }}
                            </td>
                            <td class="p-3 border border-gray-300 text-sm lg:text-base text-gray-800">
                                {{ $record->check_in_time ?? '-' }}
                            </td>
                            <td class="p-3 border border-gray-300 text-sm lg:text-base text-gray-800">
                                {{ $record->check_out_time ?? '-' }}
                            </td>
                            <td class="p-3 border border-gray-300 text-sm lg:text-base text-gray-800">
                                {{ $record->method ?? '-' }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500 text-sm lg:text-base">No attendance
                                records found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<canvas id="leaveChart"></canvas>

</html>