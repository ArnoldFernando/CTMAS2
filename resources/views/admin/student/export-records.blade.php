<!-- resources/views/pdf/student_records.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Student Records</title>

    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            text-align: center;
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

        .table-title {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <h3 class="table-title">Student Records</h3>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Name</th>
                <th>Course</th>
                <th>College</th>
                <th>Time In</th>
                <th>Time Out</th>
                {{-- <th>Updated At</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($studentRecords as $record)
                <tr>
                    <td>{{ $record->created_at->format('F j, Y') }}</td>
                    <td>{{ $record->student->name }}</td>
                    <td>{{ $record->student->course }}</td>
                    <td>{{ $record->student->college }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->time_in)->format('g:i:s A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->time_out)->format('g:i:s A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
