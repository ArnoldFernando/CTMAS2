<!-- resources/views/pdf/student_records.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Student Records</title>

    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            box-sizing: border-box;
        }

        p {
            text-align: center;
            text
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;

        }

        thead {
            text-align: center;
            margin-bottom: 2em;
        }

        tbody {
            text-align: center;
        }

        .title {
            background-color: #9DDE8B;
            width: 100vw;
            padding: 0;
        }

        .div1 {
            border-bottom: 1px black solid;
            padding: 0;
        }

        .div2 {
            border-top: 1px black solid;
            padding: 0;
        }

        @page {
            margin: 100px 25px;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
            text-align: center;
        }

        .pagenum:before {
            content: counter(page);
        }
    </style>
</head>

<body>
    <header>
        <p>CAGAYAN STATE UNIVERSITY <br>
            APARRI CAMPUSES <br>
            Maura, Aparri, Cagayan <br>
        </p>
        {{-- <p>APARRI CAMPUSES</p>
        <p>Maura, Aparri, Cagayan</p> --}}

    </header>
    <p class="title">LIBRARY SERVICES</p>
    <p>ATTENDANCE FOR STUDENTS LOG SHEET</p>
    <footer>
        <div class="div2">Footer Content Here</div>
        <div>Page <span class="pagenum"></span></div>
    </footer>





    <table>
        <thead>
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
                    <td>{{ \Carbon\Carbon::parse($record->time_in)->format('g:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->time_out)->format('g:i A') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>
