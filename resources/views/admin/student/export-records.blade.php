<!-- resources/views/pdf/student_records.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Student Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Student Records</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>College</th>
                <th>Time In</th>
                <th>Time Out</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentRecords as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->student_id }}</td>
                    <td>{{ $record->student->name }}</td>
                    <td>{{ $record->student->course }}</td>
                    <td>{{ $record->student->college }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->time_in)->format('g:i:s A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->time_out)->format('g:i:s A') }}</td>
                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                    <td>{{ $record->updated_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
