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
            position: relative;
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

        .courses span {
            position: absolute;
            right: 1rem;
            font-weight: normal;
            font-size: 10px;
            color: #888;
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
    <h1>University Library Attendance Report</h1>

    <div class="header">
        <div>
            <strong>From: </strong> {{ $startDate }}
        </div>
        <div>
            <strong>To: </strong> {{ $endDate }}
        </div>
        <div>
            <strong>Semester: </strong> {{ $semester }}
        </div>
        <div>
            <strong>School Year: </strong> {{ $schoolYear }}
        </div>
    </div>

    <table>
        @foreach ($data as $college => $courses)
            <tr class="headings">
                <th colspan="5">{{ $college }}</th>
            </tr>
            <tr class="courses">
                @foreach ($courses as $course)
                    <td>{{ $course['course'] }} <span>({{ $course['total'] }})</span></td>
                @endforeach
                @for ($i = 0; $i < 4 - count($courses); $i++)
                    <td></td>
                @endfor
                <td class="total-column">Total: {{ array_sum(array_column($courses, 'total')) }}</td>
            </tr>
        @endforeach
        <tr class="headings">
            <th colspan="5">Total</th>
        </tr>
        <tr class="courses">
            <td colspan="4">{{ collect($data)->flatten(1)->sum('total') }}</td>
            <td class="total-column">Total: {{ collect($data)->flatten(1)->sum('total') }}</td>
        </tr>
    </table>
</body>

</html>
