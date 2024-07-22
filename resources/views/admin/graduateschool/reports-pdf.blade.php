<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graduate School Attendance Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: 400;
            font-size: 12px;
            vertical-align: top;
        }

        .headings {
            font-weight: 700;
            color: #fff;
            background-color: #333;
            text-align: center;
        }

        .total-column {
            text-align: right;
            font-weight: bold;
            font-size: 12px;
            padding-right: 10px;
        }

        .header {
            display: flex;
            font-size: 12px;
            justify-content: space-between;
        }

        .header div {
            display: inline;
        }
    </style>
</head>

<body>
    <h1>Graduate School Attendance Report</h1>

    <div class="header">
        <div>
            <strong>From: </strong> {{ $startDate }}
        </div>
        <div>
            <strong>To: </strong> {{ $endDate }}
        </div>
    </div>

    <table>
        <tr class="headings">
            <th>Course</th>
            <th>Total Attendance</th>
        </tr>
        @foreach ($courseCounts as $course => $total)
            <tr>
                <td>{{ $course }}</td>
                <td class="total-column">{{ $total }}</td>
            </tr>
        @endforeach
        <tr class="headings">
            <th>Total</th>
            <th class="total-column">{{ array_sum($courseCounts->toArray()) }}</th>
        </tr>
    </table>
</body>

</html>
