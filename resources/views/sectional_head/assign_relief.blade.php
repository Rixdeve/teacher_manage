<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Relief Teacher</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Assign Relief Teacher</h1>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('sectional_head.store_relief', $leaveApplication->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label>
                <input type="text" id="date" name="date" class="flatpickr mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="mb-4">
                <label for="absent_teacher_id" class="block text-sm font-medium text-gray-700">Absent Teacher</label>
                <select id="absent_teacher_id" name="absent_teacher_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required disabled>
                    <option value="">Select Absent Teacher</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="relief_teacher_id" class="block text-sm font-medium text-gray-700">Relief Teacher</label>
                <select id="relief_teacher_id" name="relief_teacher_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required disabled>
                    <option value="">Select Relief Teacher</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="time_slot" class="block text-sm font-medium text-gray-700">Time Slot</label>
                <select id="time_slot" name="time_slot" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Select Time Slot</option>
                    <option value="08:00-09:00">08:00 - 09:00</option>
                    <option value="09:00-10:00">09:00 - 10:00</option>
                    <option value="10:00-11:00">10:00 - 11:00</option>
                    <!-- Add more time slots as needed -->
                </select>
            </div>

            <div class="mb-4">
                <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                <input type="text" id="class" name="class" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required placeholder="e.g., 8A">
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Assign Relief</button>
        </form>
    </div>

    <script>
        // Initialize Flatpickr for date picker
        flatpickr("#date", {
            dateFormat: "Y-m-d",
            minDate: "{{ $leaveApplication->commence_date }}",
            maxDate: "{{ $leaveApplication->end_date }}",
            enable: [
                @foreach($dates as $date)
                    "{{ $date }}",
                @endforeach
            ],
            onChange: function(selectedDates, dateStr) {
                if (dateStr) {
                    $.ajax({
                        url: "{{ route('sectional_head.get_teachers', $leaveApplication->id) }}?date=" + dateStr,
                        method: 'GET',
                        success: function(data) {
                            // Populate absent teachers dropdown
                            $('#absent_teacher_id').empty().append('<option value="">Select Absent Teacher</option>');
                            data.absentTeachers.forEach(function(teacher) {
                                $('#absent_teacher_id').append('<option value="' + teacher.id + '">' + teacher.name + '</option>');
                            });
                            $('#absent_teacher_id').prop('disabled', false);

                            // Populate available teachers dropdown
                            $('#relief_teacher_id').empty().append('<option value="">Select Relief Teacher</option>');
                            data.availableTeachers.forEach(function(teacher) {
                                $('#relief_teacher_id').append('<option value="' + teacher.id + '">' + teacher.name + '</option>');
                            });
                            $('#relief_teacher_id').prop('disabled', false);
                        },
                        error: function(xhr) {
                            alert('Error fetching teachers: ' + xhr.responseJSON.error);
                        }
                    });
                } else {
                    $('#absent_teacher_id').empty().append('<option value="">Select Absent Teacher</option>').prop('disabled', true);
                    $('#relief_teacher_id').empty().append('<option value="">Select Relief Teacher</option>').prop('disabled', true);
                }
            }
        });
    </script>
</body>
</html>