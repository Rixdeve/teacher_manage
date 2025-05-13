<!DOCTYPE html>
<html>
<head>
    <title>Absentee Report</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2cm; }
        h1 { text-align: center; }
        .header { margin-bottom: 20px; text-align: center; }
        .summary { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Absentee Report</h1>
        <p><strong>Section {{ $sectionName }}</strong></p>
        <p>Date: {{ $today }}</p>
    </div>

    <div class="summary">
        <p>This report lists all teachers in Section {{ $sectionName }} who were absent on {{ $today }}.</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Teacher Name</th>
                <th>Subjects</th>
            </tr>
        </thead>
        <tbody>
            @forelse($absentees as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                    <td>
                        @if(is_array($user->subjects))
                            {{ implode(', ', $user->subjects) }}
                        @else
                            No subjects
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align: center;">No Absentees Recorded</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Generated on {{ $today }}</p>
    </div>
</body>
</html>