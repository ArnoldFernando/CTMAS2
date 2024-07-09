<!DOCTYPE html>
<html>

<head>
    <title>All Students</title>
    <style>
        .student-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            padding: 15px;
            margin: 10px;
            display: inline-block;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: yellow;
        }

        .student-card img.student-image {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .student-card img.barcode {
            width: 150px;
            /* Adjust the width as needed */
            height: auto;
            margin-top: 10px;
        }

        .student-card h2 {
            margin: 10px 0;
            font-size: 1.5em;
        }

        .student-card p {
            margin: 5px 0;
            font-size: 1em;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">All Students</h1>
    <div class="cards-container">

        @foreach ($students as $student)
            <div class="student-card">
                <p>Cagayan State University <br>
                    Aparri Cagayan <br>
                    Aparri Cagayan</p>

                <h5>BORROWERS CARD</h5>
                @if ($student->image)
                    <img src="{{ asset('student-images/' . $student->image) }}" alt="student image"
                        class="student-image" />
                @else
                    <img src="{{ asset('IMG/default.jpg') }}" alt="default student image" class="student-image" />
                @endif
                <h2>{{ $student->name }}</h2>
                <p>Student ID: {{ $student->student_id }}</p>
                <img src="data:image/png;base64,{{ $student->barcode }}" alt="barcode" class="barcode" />
            </div>
        @endforeach
    </div>
</body>

</html>
