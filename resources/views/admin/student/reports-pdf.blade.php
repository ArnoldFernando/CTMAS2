<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        p {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 3px solid #ddd;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            height: 50px;
            width: 20%;
            font-weight: 900;
        }

        .headings {
            font-weight: 900;
            color: #fff;
            background-color: gray;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>University Library Monthly Attendance Report</h1>

    <p><strong>From: </strong> <strong>To: </strong> <strong>Semester: </strong> <strong>School Year: </strong></p>

    <table>
        @foreach ($courses as $course)
            <tr class="headings">
                <td colspan="5">{{ $course->college }}</td>
            </tr>
            <tr class="courses">
                <td>{{ $course->course }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{ $totals[$course->course] }}</td>
            </tr>
        @endforeach
    </table>
</body>

</html>
