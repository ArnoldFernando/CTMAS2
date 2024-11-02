<!DOCTYPE html>
<html>

<head>
    <title>Student Time In/Out</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-v5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    {{--  FAVICON  --}}
    <link rel="shortcut icon" href="{{ asset('IMG/csulogo.png') }}" type="image/x-icon">

    {{--  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  --}}
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/5c14b0052b.js" crossorigin="anonymous"></script>
    {{--  <style>
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
            background-color: #f0f0f0;
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
            /* Allow height to adjust */
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
            }
        }

        .rank {
            height: 200px;
            /* Allow rank section to expand */
        }

        .h1 {
            height: 60vh;
            /* Adjust header height */
        }

        .card-body {
            height: 200px;
            /* Allow card body to expand */
        }

        .swal2-image {
            border: 3px solid rgba(7, 227, 7, 0.8);
            border-radius: 50% !important;
            width: 200px;
            /* Make image responsive */
            height: 200px;
            /* Adjust height proportionally */
            object-fit: cover !important;
            overflow: hidden !important;
        }

        @media (max-width: 768px) {
            .h1 {
                font-size: 1.5rem;
                /* Adjust font size for smaller screens */
            }

            .bg-light {
                width: 100%;
                /* Make light background full width */
                padding: 1rem;
                /* Adjust padding */
            }

            .container {
                padding-left: 0;
                /* Remove padding */
                padding-right: 0;
                /* Remove padding */
            }

            .card {
                width: 100%;
                /* Make card full width */
            }

            .rank {
                height: ;
            }

            .table {
                font-size: 0.9rem;
                /* Adjust table font size */
            }

            .student-image {
                width: 100%;
                /* Make student image responsive */
                height: auto;
                /* Maintain aspect ratio */
            }

            #typingText {
                display: none;
            }


        }
    </style>  --}}
    <link rel="stylesheet" href="{{ asset('css/session.css') }}">

    <style>
        @keyframes scroll {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(calc(-100% - 10px * {{ count($rankedStudents) }}));
            }
        }
    </style>

</head>

<body>
    {{-- Sweet Alert --}}
    @extends('admin.session.swal')

    <div class="container-fluid d-flex flex-column min-vh-100 p-3 body">
        <div class="row row-1">
            <div class="container p-2 text-dark col-md-7 col-sm-12">
                <h1 id="typingText" class="fw-bold display-1 ms-5 font h1"></h1>
                <div class="d-flex flex-column justify-content-between align-items-start mt-auto mb-5 rank">
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

            <div class="container-fluid p-4 col-md-5 col-sm-12 ">
                <div class="container bg-light bg-opacity-70 p-3 rounded-3" style="width: 100%;">
                    <h2 class="h4 fw-bold mb-3">Start Session</h2>

                    <form id="timeForm" action="{{ route('student-time') }}" method="POST">
                        @csrf
                        <label for="student_id" class="fw-semibold">Scan ID:</label>
                        <input type="password" class="form-control" id="student_id" name="id" required autofocus>
                        <input type="submit" style="display: none;">
                    </form>
                </div>

                <div class="container rounded-3 mt-3 bg-light bg-opacity-70 p-3 " style="width: 100%;">
                    <div class="row p-1">
                        <div class="text-center">
                            <img src="{{ asset('IMG/default.jpg') }}"
                                class="student-image border border-1 border-secondary rounded-1"
                                style="height: 180px; width: 180px;" alt="ID Picture">
                        </div>
                    </div>

                    <h5 id="type" class="fw-bold mb-3 text-center">Student</h5>

                    <div class="row p-1">
                        <div class="col-9">
                            <h6 class="d-inline fw-bolder"><i class="fa-solid fa-caret-right me-1"></i>Name:</h6>
                            <h6 class="d-inline" id="studentName"></h6>
                            <br>
                            <hr class="mt-0">

                            <h6 class="d-inline fw-bolder mt-1"><i class="fa-solid fa-caret-right me-1"></i>Course:
                            </h6>
                            <h6 class="d-inline" id="studentCourse"></h6>
                            <br>
                            <hr class="mt-0">

                            <h6 class="d-inline fw-bolder mt-1"><i class="fa-solid fa-caret-right me-1"></i>Department:
                            </h6>
                            <h6 class="d-inline" id="studentDepartment"></h6>
                            <br>
                            <hr class="mt-0">
                        </div>
                        <div class="col-3 text-center">
                            <h6 class="font mt-1">Time</h6>
                            <h2 class="mt-2 fw-bolder" style="color: #A50002;" id="currentTime"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{--  for manual typing  --}}
    {{--  <script>
        document.addEventListener('DOMContentLoaded', function() {
            const studentIdInput = document.getElementById('student_id');
            const form = document.getElementById('timeForm');

            studentIdInput.addEventListener('input', function() {
                if (studentIdInput.value) {
                    form.submit();
                }
            });
        });
    </script>  --}}

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/session/session.js') }}"></script>
    <script src="{{ asset('js/session/post-ajax.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-v5/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
