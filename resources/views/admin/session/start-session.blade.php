<!DOCTYPE html>
<html>

<head>
    <title>Student Time In/Out</title>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    {{--  FAVICON  --}}
    <link rel="shortcut icon" href="{{ asset('IMG/csulogo.png') }}" type="image/x-icon">
    {{-- Sweet Alert CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/5c14b0052b.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Nunito';
        }

        .container-fluid {
            background-color: #F9DBBA;

        }

        .body .row-1 {
            background-color: #F9DBBA;
        }

        .scan {
            background-color: #f0f0f0
        }

        .font {
            font-family: 'Poppins';
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: #f0f0f0;
        }

        .infinite-scroll {
            overflow: hidden;
            position: relative;
        }

        .table-responsive {
            position: relative;
            height: 200px;
            /* Fixed height */
            overflow: hidden;
            /* Hide the scrollbar */
        }

        .table-responsive.no-scrollbar::-webkit-scrollbar {
            display: none;
            /* Hide scrollbar for Chrome, Safari and Opera */
        }

        .table-responsive.no-scrollbar {
            -ms-overflow-style: none;
            /* Hide scrollbar for IE and Edge */
            scrollbar-width: none;
            /* Hide scrollbar for Firefox */
        }

        .table {
            width: 100%;
            margin-bottom: 0;
        }

        .thead-fixed th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
        }

        .table thead,
        .table tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .table tbody {
            display: block;
            animation: scroll 50s linear infinite;
        }

        @keyframes scroll {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(calc(-100% - 10px * {{ count($rankedStudents) }}));
                /* Adjust based on row height and margin */
            }
        }

        .rank {
            height: 200px;
            /* Fixed height */
        }

        .h1 {
            height: 60vh;

        }

        /* Ensure the card-body has a fixed height */
        .card-body {
            height: 200px;
            /* Ensure the card body is exactly 200px */
        }
    </style>
</head>

<body>
    {{-- Sweet Alert --}}
    @extends('admin.session.notification')

    <div class="container-fluid  d-flex flex-column min-vh-100 p-3 body">
        <div class="row row-1">
            <div class="container p-2 text-dark col-7">
                <h1 id="typingText" class="fw-bold display-1 ms-5  font h1"></h1>
                <div class="d-flex flex-column justify-content-between align-items-start mt-auto mb-5 rank">
                    <!-- This div will align content at the bottom -->
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header bg-danger fw-bold font text-white">Top Students of Library</h5>
                            <div class="card-body infinite-scroll">
                                <div class="table-responsive no-scrollbar">
                                    <table class="table table-striped">
                                        <thead class="thead-fixed">
                                            <tr>
                                                <th>Rank</th>
                                                <th>Name</th>
                                                <th>Course</th>
                                                <th>Visits Count</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rankedStudents as $key => $student)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="fw-bold">{{ $student->first_name }}</td>
                                                    <td class="text-muted">{{ $student->course_id }}</td>
                                                    <td class="text-muted">{{ $student->total_records }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tbody>
                                            @foreach ($rankedStudents as $key => $student)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="fw-bold">{{ $student->first_name }}</td>
                                                    <td class="text-muted">{{ $student->course_id }}</td>
                                                    <td class="text-muted">{{ $student->total_records }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container p-2 col-5">
                <div class="d-flex justify-content-center align-items-center px-5">
                    <div class="bg-light bg-opacity-70 p-3 rounded-3" style="width: 500px;">
                        <h2 class="h4 fw-bold mb-3">Start Session</h2>

                        <form id="timeForm" action="{{ route('student-time') }}" method="POST">
                            @csrf
                            <label for="student_id" class="fw-semibold">Scan ID:</label>
                            <input type="password" class="form-control" id="student_id" name="id" required
                                autofocus>
                            <button type="submit" style="display: none;">Submit</button>
                        </form>
                    </div>
                </div>

                {{-- Student Displayed Data --}}

                <div class="px-5">
                    <div class="container rounded-3 mt-3 bg-light bg-opacity-70 p-3" style="width: 500px;">
                        <div class="row p-1">
                            <div class="text-center">
                                @php
                                    $sessionTypes = ['student', 'faculty'];
                                    $imagePath = 'IMG/default.jpg';
                                    $name = 'N/A';
                                    $course = 'N/A';
                                    $department = 'N/A';
                                    $typeLabel = 'Scan your Barcode';

                                    foreach ($sessionTypes as $type) {
                                        if (
                                            session($type) ||
                                            session($type . 'Timein') ||
                                            session('20seconds-in-' . $type) ||
                                            session($type . 'Timeout') ||
                                            session('20seconds-out-' . $type)
                                        ) {
                                            $sessionData = session($type);
                                            $imagePath =
                                                $sessionData && $sessionData->image
                                                    ? "$type-images/{$sessionData->image}"
                                                    : $imagePath;
                                            $name = $sessionData ? $sessionData->first_name : $name;
                                            $course =
                                                in_array($type, ['student']) && $sessionData
                                                    ? $sessionData->course_id
                                                    : $course;
                                            $department =
                                                in_array($type, ['student', 'faculty']) && $sessionData
                                                    ? $sessionData->college_id
                                                    : $department;
                                            $typeLabel = ucfirst($type) . ' Details';
                                            break;
                                        }
                                    }
                                @endphp
                                <img src="{{ asset($imagePath) }}" class="border border-1 border-secondary rounded-1"
                                    style="height: 180px; width: 180px;" alt="ID Picture">
                            </div>
                        </div>

                        <h5 class="fw-bold mb-3 text-center">{{ $typeLabel }}</h5>

                        <div class="row p-2">
                            <div class="col-9">
                                <h6 class="d-inline fw-bolder"><i class="fa-solid fa-caret-right me-1"></i>Name:</h6>
                                <h6 class="d-inline">{{ $name }}</h6><br>
                                <hr class="mt-0">
                                <h6 class="d-inline fw-bolder mt-1"><i class="fa-solid fa-caret-right me-1"></i>Course:
                                </h6>
                                <h6 class="d-inline">{{ $course }}</h6><br>
                                <hr class="mt-0">
                                <h6 class="d-inline fw-bolder mt-1"><i
                                        class="fa-solid fa-caret-right me-1"></i>Department:</h6>
                                <h6 class="d-inline">{{ $department }}</h6><br>
                                <hr class="mt-0">
                            </div>
                            <div class="col-3 text-center">
                                <h6 class="font mt-1">Time</h6>
                                <h2 class="mt-2 fw-bolder" style="color: #A50002;">
                                    @if (session('currentTime'))
                                        {{ session('currentTime') }}
                                    @endif
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const studentIdInput = document.getElementById('student_id');
            const form = document.getElementById('timeForm');

            studentIdInput.addEventListener('input', function() {
                if (studentIdInput.value) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const text = "Library Attendance Monitoring System Cagayan State University Aparri";
            const colors = ["#A50002"];
            const typingText = document.getElementById('typingText');
            let index = 0;
            let forward = true;

            function type() {
                if (forward) {
                    if (index < text.length) {
                        const span = document.createElement('span');
                        span.textContent = text.charAt(index);
                        span.style.color = colors[index % colors.length]; // Cycle through colors
                        typingText.appendChild(span);
                        index++;
                        setTimeout(type, 100); // Adjust typing speed here
                    } else {
                        setTimeout(() => {
                            forward = false;
                            type();
                        }, 2000); // Delay before starting to erase
                    }
                } else {
                    if (index > 0) {
                        typingText.removeChild(typingText.lastChild);
                        index--;
                        setTimeout(type, 100); // Adjust erasing speed here
                    } else {
                        setTimeout(() => {
                            forward = true;
                            type();
                        }, 1000); // Delay before restarting the typing effect
                    }
                }
            }

            type(); // Start the typing effect
        });
    </script>

    {{-- Bootstrap CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
