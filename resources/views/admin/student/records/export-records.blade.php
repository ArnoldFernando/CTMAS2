<!DOCTYPE html>
<html>

<head>
    <title>Student Records</title>
    <link rel="shortcut icon" href="{{ asset('IMG/csulogo.png') }}" type="image/x-icon">
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 15px;
        }

        thead {
            background-color: #f2f2f2;
        }

        .title {
            background-color: #9DDE8B;
            width: 100%;
        }

        @page {
            margin: 200px 25px 150px;
        }

        header {
            position: fixed;
            top: -160px;
            left: 0px;
            right: 0px;
            height: 100px;
            text-align: center;
            background-color: white;
            padding: 10px 0;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
            background-color: white;
            padding: 10px 0;
        }

        .pagenum:before {
            content: counter(page);
        }

        .small-table td {
            font-size: 12px;
            padding: 5px;
        }

        .img {
            margin-top: 10px;
            width: 80px;
            position: absolute;
        }

        .img img {
            position: absolute;
            width: 100%;
            top: 13px;
            left: 203px;
        }

        .span {
            position: absolute;
            right: -1px;
            top: 60px;
            border: solid 1px;
            padding: 3px;
        }

        .f-img {
            height: auto;
        }

        .f-1 {
            width: 100%;
        }

        .f-2 {
            width: 90%;
        }

        .footer-table {
            width: 100%;
            text-align: center;
            border: none;
        }

        .footer-table td {
            width: 50%;
            border: none;
        }
    </style>

</head>

<body>
    <header>
        <div class="img">
            <img src="IMG/library.png" alt="Absolute URL Image">
        </div>
        <p class="text-bg-primary">
            CAGAYAN STATE UNIVERSITY<br>
            APARRI CAMPUSES<br>
            Maura, Aparri, Cagayan <span class="span">F-LIB-AP-80509</span>
        </p>
        <p class="title">LIBRARY SERVICES</p>
        <p>ATTENDANCE FOR STUDENTS LOG SHEET</p>
    </header>
    <footer>
        <table class="footer-table">
            <tr>
                <td><img class="f-img f-1" src="IMG/footer-2.png" alt="footer-2"></td>
                <td><img class="f-img f-2" src="IMG/footer-1.jpg" alt="footer-1"></td>

            </tr>
        </table>
    </footer>
    <main>
        <table class="small-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>College</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($studentRecords as $record)
                    <tr>
                        <td>{{ $record->created_at->format('F j, Y') ?? '' }}</td>
                        <td>{{ $record->student->first_name ?? '' }} {{ $record->student->middle_inital ?? '' }}
                            {{ $record->student->last_name ?? '' }}</td>
                        <td>{{ $record->student->course_id ?? '' }}</td>
                        <td>{{ $record->student->college_id ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->time_in)->format('g:i A') ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->time_out)->format('g:i A') ?? '' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
