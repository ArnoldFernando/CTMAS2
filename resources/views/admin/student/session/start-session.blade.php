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

        .font {
            font-family: 'Poppins';
        }

        /* .body {
            position: relative;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .body:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('{{ asset('IMG/bg.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.8;
            z-index: -1;
        }

        .body:after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.452);
            z-index: -1;
        } */
    </style>
</head>

<body>
    {{-- Sweet Alert --}}
    @if (session('timein'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Student time in recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('studentTimeout'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast-out',
                },
                showConfirmButton: false,
                timer: 1500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Student TIME OUT recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('20second'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'warning',
                    title: 'Cannot time out within 20 seconds of time in'
                })
            })()
        </script>
    @endif

    @if (session('idnotexist'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'warning',
                    title: 'ID does not exist'
                })
            })()
        </script>
    @endif

    @if (session('facultytimein'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Faculty time in recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('facultytimeout'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast-out',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Faculty time out recorded successfully'
                })
            })()
        </script>
    @endif

    @if (session('20seconds-out'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'question',
                    title: 'time in after 20 seconds'
                })
            })()
        </script>
    @endif
    <style>
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




    <div class="container-fluid bg-light dark d-flex flex-column min-vh-100 p-3 body">
        <div class="row">
            <div class="container p-2 text-dark col-7">
                <h1 id="typingText" class="fw-bold display-1 ms-5  font h1"></h1>
                <div class="d-flex flex-column justify-content-between align-items-start mt-auto mb-5 rank">
                    <!-- This div will align content at the bottom -->
                    <div class="col-md-12">
                        <div class="card">
                            <h5 class="card-header bg-danger fw-bold font text-white">Ranked Students
                                <small>Course</small><small> Visits-Count</small>
                            </h5>
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
                                                    <td class="fw-bold">{{ $student->name }}</td>
                                                    <td class="text-muted">{{ $student->course }}</td>
                                                    <td class="text-muted">{{ $student->total_records }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tbody>
                                            @foreach ($rankedStudents as $key => $student)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="fw-bold">{{ $student->name }}</td>
                                                    <td class="text-muted">{{ $student->course }}</td>
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
                    <div class="bg-secondary bg-opacity-50 p-3 rounded-3" style="width: 450px;">
                        <h2 class="h4 fw-bold mb-3">Start Session</h2>

                        <form id="timeForm" action="{{ route('student-time') }}" method="POST">
                            @csrf
                            <label for="student_id" class="fw-semibold">Student ID:</label>
                            <input type="password" class="form-control" id="student_id" name="id" required
                                autofocus>
                            <button type="submit" style="display: none;">Submit</button>
                        </form>
                    </div>
                </div>

                {{-- Student Displayed Data --}}

                <div class="px-5">
                    <div class="container rounded-3 mt-3 bg-secondary bg-opacity-25 p-3">
                        <div class="row p-1">
                            <div class="">

                                <div class="text-center">
                                    {{--  student  --}}
                                    @if (session('student'))
                                        @if (session('student')->image)
                                            <img src="{{ asset('student-images/' . session('student')->image) }}"
                                                class="border border-1 border-secondary rounded-1"
                                                style="height: 180px; width: 180px;" alt="ID Picture">
                                        @else
                                            <img src="{{ asset('IMG/default.jpg') }}"
                                                class="border border-1 border-secondary rounded-1"
                                                style="height: 180px; width: 180px;" alt="ID Picture">
                                        @endif
                                    @elseif (session('faculty'))
                                        @if (session('faculty')->image)
                                            <img src="{{ asset('faculty-images/' . session('faculty')->image) }}"
                                                class="border border-1 border-secondary rounded-1"
                                                style="height: 180px; width: 180px;" alt="ID Picture">
                                        @else
                                            <img src="{{ asset('IMG/default.jpg') }}"
                                                class="border border-1 border-secondary rounded-1"
                                                style="height: 180px; width: 180px;" alt="ID Picture">
                                        @endif
                                    @else
                                        <img src="{{ asset('IMG/default.jpg') }}"
                                            class="border border-1 border-secondary rounded-1"
                                            style="height: 180px; width: 180px;" alt="ID Picture">

                                    @endif

                                    {{--  faculty
                                    @if (session('faculty'))
                                        @if (session('faculty')->image)
                                            <img src="{{ asset('faculty-images/' . session('faculty')->image) }}"
                                                class="border border-1 border-secondary rounded-1"
                                                style="height: 180px; width: 180px;" alt="ID Picture">
                                        @else
                                            <img src="{{ asset('IMG/default.jpg') }}"
                                                class="border border-1 border-secondary rounded-1"
                                                style="height: 180px; width: 180px;" alt="ID Picture">
                                        @endif
                                    @else
                                        <img src="{{ asset('IMG/default.jpg') }}"
                                            class="border border-1 border-secondary rounded-1"
                                            style="height: 180px; width: 180px;" alt="ID Picture">
                                    @endif  --}}
                                </div>
                            </div>
                        </div>

                        @if (session('student'))
                            <h5 class="fw-bold mb-3 text-center">Student Details</h5>
                        @elseif (session('faculty'))
                            <h5 class="fw-bold mb-3 text-center">Faculty Details</h5>
                        @else
                            <h5 class="fw-bold mb-3 text-center">Scan your Barcode</h5>
                        @endif
                        <div class="row p-2">
                            <div class="col-8">
                                <h6 class="d-inline fw-bolder"><i class="fa-solid fa-caret-right me-1"></i>Name:
                                </h6>
                                @if (session('student'))
                                    <h6 class="d-inline">{{ session('student')->name }}</h6><br>
                                @elseif (session('faculty'))
                                    <h6 class="d-inline">{{ session('faculty')->name }}</h6><br>
                                @endif
                                <hr class="mt-0">
                                <h6 class="d-inline fw-bolder mt-1"><i class="fa-solid fa-caret-right me-1"></i>Course:
                                </h6>
                                @if (session('student'))
                                    <h6 class="d-inline">{{ session('student')->course }}</h6><br>
                                @elseif (session('faculty'))
                                    <h6 class="d-inline">N/A</h6><br>
                                @else
                                    <h6 class="d-inline">N/A</h6><br>
                                @endif
                                <hr class="mt-0">
                                <h6 class="d-inline fw-bolder mt-1"><i
                                        class="fa-solid fa-caret-right me-1"></i>Department:
                                </h6>
                                @if (session('student'))
                                    <h6 class="d-inline font">{{ session('student')->college }}</h6><br>
                                @elseif (session('faculty'))
                                    <h6 class="d-inline font">{{ session('faculty')->college }}</h6><br>
                                @endif
                                <hr class="mt-0">
                            </div>
                            <div class="col-4 border text-center border-1 border-dark rounded-1">
                                <h6 class="font mt-1"></i>Time</h6>

                                <h2 class="mt-2 fw-bolder" style="color: #A50002;">
                                    @if (session('currentTime'))
                                        {{ session('currentTime') }}
                                    @endif
                                </h2>

                            </div>
                        </div>
                    </div>
                </div>


                {{-- Faculty Displayed Data --}}
                {{--  @if (session('faculty'))
                    <div class="px-5">
                        <div class="container rounded-3 mt-3 bg-secondary bg-opacity-25 p-3">
                            <div class="row p-1">
                                <div class="">
                                    @if (session('faculty')->image)
                                        <div class="text-center">
                                            <img src="{{ asset('faculty-images/' . session('faculty')->image) }}"
                                                class="border border-1 border-secondary rounded-1" height="180px"
                                                width="180px" alt="ID Picture">
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <img src="{{ asset('IMG/default.jpg') }}" class=" rounded-1" height="180px"
                                                width="180px" alt="ID Picture">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h5 class="fw-bold mb-3 text-center">Faculty Details</h5>
                            <div class="row p-2">
                                <div class="col-8">
                                    <h6 class="d-inline fw-bolder"><i class="fa-solid fa-caret-right me-1"></i>Name:
                                    </h6>
                                    <h6 class="d-inline">{{ session('faculty')->name }}</h6><br>
                                    <hr class="mt-0">
                                    <h6 class="d-inline fw-bolder mt-1"><i
                                            class="fa-solid fa-caret-right me-1"></i>Department:
                                    </h6>
                                    <h6 class="d-inline font">{{ session('faculty')->college }}</h6><br>
                                    <hr class="mt-0">
                                </div>
                                <div class="col-4 border text-center border-1 border-dark rounded-1">
                                    <h6 class="font mt-1"></i>Time</h6>
                                    @if (session('currentTime'))
                                        <h2 class="mt-2 fw-bolder" style="color: #A50002;">
                                            {{ session('currentTime') }}
                                        </h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif  --}}
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
