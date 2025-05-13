<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Report</title>
    <style>
        @page { margin: 1cm; }
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold text-center mb-4">Attendance Report</h1>
        @if(request('date'))
            <p class="text-sm text-center mb-4">Date: {{ request('date') }}</p>
        @endif
        @if(request('role'))
            <p class="text-sm text-center mb-4">Role: {{ request('role') }}</p>
        @endif
        @if(request('user_id'))
            <p class="text-sm text-center mb-4">
                User: {{ $attendanceRecords->first() ? $attendanceRecords->first()->user->first_name . ' ' . $attendanceRecords->first()->user->last_name : 'Unknown' }}
            </p>
        @endif

        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-3 py-2 text-left border border-gray-300 text-sm font-semibold">ID</th>
                    <th class="px-3 py-2 text-left border border-gray-300 text-sm font-semibold">First Name</th>
                    <th class="px-3 py-2 text-left border border-gray-300 text-sm font-semibold">Last Name</th>
                    <th class="px-3 py-2 text-left border border-gray-300 text-sm font-semibold">Status</th>
                    <th class="px-3 py-2 text-left border border-gray-300 text-sm font-semibold">Date</th>
                    <th class="px-3 py-2 text-left border border-gray-300 text-sm font-semibold">Check-in</th>
                    <th class="px-3 py-2 text-left border border-gray-300 text-sm font-semibold">Check-out</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-300">
                @if($attendanceRecords->isEmpty())
                    <tr>
                        <td colspan="7" class="px-3 py-2 text-center text-sm text-gray-600">
                            No attendance records found.
                        </td>
                    </tr>
                @else
                    @foreach($attendanceRecords as $record)
                        <tr class="bg-white">
                            <td class="px-3 py-2 border border-gray-300 text-sm">{{ $record->id }}</td>
                            <td class="px-3 py-2 border border-gray-300 text-sm">{{ $record->user->first_name }}</td>
                            <td class="px-3 py-2 border border-gray-300 text-sm">{{ $record->user->last_name }}</td>
                            <td class="px-3 py-2 border border-gray-300 text-sm">{{ $record->status }}</td>
                            <td class="px-3 py-2 border border-gray-300 text-sm">{{ $record->date }}</td>
                            <td class="px-3 py-2 border border-gray-300 text-sm">
                                {{ $record->check_in_time ? \Carbon\Carbon::parse($record->check_in_time)->format('h:i A') : '' }}
                            </td>
                            <td class="px-3 py-2 border border-gray-300 text-sm">
                                {{ $record->check_out_time ? \Carbon\Carbon::parse($record->check_out_time)->format('h:i A') : '' }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</body>
</html>