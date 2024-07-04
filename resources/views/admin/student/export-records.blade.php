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
            /* margin-top: 20px; */
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            font-size: 15px;
            /* font-weight: 600; */
        }

        thead {
            background-color: #f2f2f2;


        }

        .title {
            background-color: #9DDE8B;
            width: 100%;
            /* padding: 4px 0; */
        }

        .div1,
        .div2 {
            border-top: 1px solid black;
            padding: 0;
        }

        @page {
            margin: 150px 25px;
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
            bottom: -100px;
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

        img {
            position: absolute;
            width: 100%;
            top: 13px;
            left: 203px;
        }
    </style>

</head>

<body>
    <header>
        <div class="img">
            <img src="IMG/library.png" alt="Absolute URL Image">
        </div>
        <p>
            CAGAYAN STATE UNIVERSITY<br>
            APARRI CAMPUSES<br>
            Maura, Aparri, Cagayan
        </p>
        <p class="title">LIBRARY SERVICES</p>
        <p>ATTENDANCE FOR STUDENTS LOG SHEET</p>
    </header>
    <footer>
        <div class="div2">Footer Content Here</div>
        <div>Page <span class="pagenum"></span></div>
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
                        <td>{{ $record->created_at->format('F j, Y') }}</td>
                        <td>{{ $record->student->name }}</td>
                        <td>{{ $record->student->course }}</td>
                        <td>{{ $record->student->college }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->time_in)->format('g:i A') }}</td>
                        <td>{{ \Carbon\Carbon::parse($record->time_out)->format('g:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>

</html>
