<!DOCTYPE html>
<html>

<head>
    <title>Student Time In/Out</title>
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
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
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success',
                    title: 'Student time out recorded successfully'
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
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 2500,
                timerPr0ogressBar: true,
            });
            (async () => {
                await Toast.fire({
                    icon: 'success1',
                    title: 'Faculty time in recorded successfully'
                })
            })()
        </script>
    @endif
    <div class="container-fluid bg-light text-dark d-flex flex-column min-vh-100 p-3">
        <div class="row">
            <div class="container p-2 text-dark col-5">
                <h1 id="typingText" class="fw-bold display-1 ms-5 font"></h1>
            </div>

            <div class="container p-2 col-7">
                <div class="d-flex justify-content-start align-items-center px-5">
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

                @if (session('student'))
                    <div class="px-5">
                        <div class="container rounded-3 mt-3 bg-secondary bg-opacity-25 p-3">
                            <div class="row p-2">
                                <div class="col-8">
                                    <h5 class="fw-bold mb-3">Student Record</h5>

                                    <h6 class="d-inline fw-bolder"><i class="fa-solid fa-caret-right me-1"></i>Name:
                                    </h6>
                                    <h6 class="d-inline">{{ session('student')->name }}</h6>
                                    <hr class="mt-0">
                                    <h6 class="d-inline fw-bolder mt-1"><i
                                            class="fa-solid fa-caret-right me-1"></i>Course:
                                    </h6>
                                    <h6 class="d-inline">{{ session('student')->course }}</h6>
                                    <hr class="mt-0">
                                    <h6 class="d-inline fw-bolder mt-1"><i
                                            class="fa-solid fa-caret-right me-1"></i>Department: </h6>
                                    <h6 class="d-inline font">{{ session('student')->college }}</h6>
                                    <hr class="mt-0">
                                </div>
                                <div class="col-4">
                                    @if (session('student')->image)
                                        <div class="p-1 text-center">
                                            <img src="{{ asset('images/' . session('student')->image) }}"
                                                class="border border-1 border-secondary rounded-2" height="170px"
                                                width="170px" alt="">
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- @if (session('student'))
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-header text-center bg-primary text-white">
                                <h2>Student Details</h2>
                            </div>
                            <div class="card-body bg-light">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{ session('student')->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Course</th>
                                            <td>{{ session('student')->course }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">College</th>
                                            <td>{{ session('student')->college }}</td>
                                        </tr>
                                        @if (session('student')->image)
                                            <tr>
                                                <th scope="row">Image</th>
                                                <td class="text-center">
                                                    <img src="{{ asset('images/' . session('student')->image) }}"
                                                        alt="Student Image" class="img-fluid" style="max-width: 200px;">
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif --}}

                {{-- @if (session('faculty'))
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-header text-center bg-primary text-white">
                                <h2>Faculty Details</h2>
                            </div>
                            <div class="card-body bg-light">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Name</th>
                                            <td>{{ session('faculty')->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">College</th>
                                            <td>{{ session('faculty')->college }}</td>
                                        </tr>
                                        @if (session('faculty')->image)
                                            <tr>
                                                <th scope="row">Image</th>
                                                <td class="text-center">
                                                    <img src="{{ asset('images/' . session('faculty')->image) }}"
                                                        alt="Faculty Image" class="img-fluid" style="max-width: 200px;">
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif --}}
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
            const text = "Cagayan State University Aparri Library";
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
