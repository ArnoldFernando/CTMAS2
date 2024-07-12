@php
    $courses = [
        [
            'label' => 'College of Business, Entrepreneurship and Accountancy - CBEA',
            'options' => [
                ['value' => 'BSAIS', 'text' => 'BS Accounting and Information System', 'class' => 'course-bsais'],
            ],
            'class' => 'college-cbea',
        ],
        [
            'label' => 'College of Criminal Justice Education - CCJE',
            'options' => [['value' => 'BSCrim', 'text' => 'BS Criminology', 'class' => 'course-bscrim']],
            'class' => 'college-ccje',
        ],
        [
            'label' => 'College of Hospitality Management – CHM',
            'options' => [['value' => 'BSHM', 'text' => 'BS Hospitality Management', 'class' => 'course-bshm']],
            'class' => 'college-chm',
        ],
        [
            'label' => 'College of Fisheries and Aquatic Science – CFAS',
            'options' => [
                ['value' => 'BSFAS', 'text' => 'BS Fisheries and Aquatic Science', 'class' => 'course-bsfas'],
            ],
            'class' => 'college-cfas',
        ],
        [
            'label' => 'College of Industrial Technology – CIT',
            'options' => [
                [
                    'value' => 'BSIndTech-Elecx',
                    'text' => 'BS Industrial Technology - Elecx',
                    'class' => 'course-bsindtech',
                ],
                [
                    'value' => 'BSIndTech-Elec',
                    'text' => 'BS Industrial Technology - Elec',
                    'class' => 'course-bsindtech',
                ],
                [
                    'value' => 'BSIndTech-Auto',
                    'text' => 'BS Industrial Technology - Auto',
                    'class' => 'course-bsindtech',
                ],
            ],
            'class' => 'college-cit',
        ],
        [
            'label' => 'College of Information and Computing Sciences - CICS',
            'options' => [['value' => 'BSIT', 'text' => 'BS Information Technology', 'class' => 'course-bsit']],
            'class' => 'college-cics',
        ],
        [
            'label' => 'College of Teacher Education - CTED',
            'options' => [
                ['value' => 'BEED', 'text' => 'Bachelor in Elementary Education', 'class' => 'course-cted'],
                ['value' => 'BSed-Eng', 'text' => 'BS Secondary Education - English', 'class' => 'course-cted'],
                ['value' => 'BSed-Scie', 'text' => 'BS Secondary Education - Science', 'class' => 'course-cted'],
                ['value' => 'BSed-Math', 'text' => 'BS Secondary Education - Math', 'class' => 'course-cted'],
            ],
            'class' => 'college-cted',
        ],
    ];
@endphp

<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Add Student</h5>
    @stop

    @section('content')
        @if (session('success'))
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
                        title: 'Data saved successfully!'
                    })
                })()
            </script>
        @endif

        @if (session('error'))
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
                        title: 'Student ID already exists!'
                    })
                })()
            </script>
        @endif
        <div class="py-2 font">
            <div class="container">
                <div class="bg-secondary bg-opacity-25 shadow-sm rounded d-flex overflow-hidden">
                    <div class="p-4 text-dark flex-fill">
                        <form action="{{ route('add.student') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student I.D</label>
                                <input type="text" required name="student_id" id="student_id"
                                    placeholder="Input Student I.D" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Student Name</label>
                                <input type="text" required name="name" id="name"
                                    placeholder="Input Student name" class="form-control">
                            </div>

                            <style>
                                /* Define custom background colors for colleges */
                                .college-cbea {
                                    background-color: #f0ad4e;
                                    color: #fff;
                                }

                                .college-ccje {
                                    background-color: #d9534f;
                                    color: #fff;
                                }

                                .college-chm {
                                    background-color: #5bc0de;
                                    color: #fff;
                                }

                                .college-cfas {
                                    background-color: #5bc0de;
                                    color: #fff;
                                }

                                .college-cit {
                                    background-color: #337ab7;
                                    color: #fff;
                                }

                                .college-cics {
                                    background-color: #5cb85c;
                                    color: #fff;
                                }

                                .college-cted {
                                    background-color: #d9534f;
                                    color: #fff;
                                }

                                /* Define custom background colors for courses */
                                .course-bsais {
                                    background-color: #f0ad4e;
                                    color: #fff;
                                }

                                .course-bscrim {
                                    background-color: #d9534f;
                                    color: #fff;
                                }

                                .course-bshm {
                                    background-color: #5bc0de;
                                    color: #fff;
                                }

                                .course-bsfas {
                                    background-color: #5bc0de;
                                    color: #fff;
                                }

                                .course-bsindtech {
                                    background-color: #337ab7;
                                    color: #fff;
                                }

                                .course-bsit {
                                    background-color: #5cb85c;
                                    color: #fff;
                                }

                                .course-cted {
                                    background-color: #d9534f;
                                    color: #fff;
                                }
                            </style>

                            <div class="mb-3">
                                <label for="course" class="form-label">Student Course</label>
                                <select required name="course" id="course" class="form-control">
                                    <option value="" disabled selected>Select Course</option>
                                    @foreach ($courses as $college)
                                        <optgroup label="{{ $college['label'] }}" class="{{ $college['class'] }}">
                                            @foreach ($college['options'] as $course)
                                                <option value="{{ $course['value'] }}" class="{{ $course['class'] }}">
                                                    {{ $course['text'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>

                            </div>

                            <div class="mb-3 position-relative">
                                <label for="college" class="form-label">Faculty College</label>
                                <select required name="college" id="college" class="form-select">
                                    <option value="" disabled selected>Select College</option>

                                    <option value="CBEA" class="college-cbea">College of Business, Entrepreneurship and
                                        Accountancy - CBEA</option>
                                    <option value="CCJE" class="college-ccje">College of Criminal Justice Education - CCJE
                                    </option>
                                    <option value="CHM" class="college-chm">College of Hospitality Management – CHM
                                    </option>
                                    <option value="CFAS" class="college-cfas">College of Fisheries and Aquatic Science –
                                        CFAS</option>
                                    <option value="CIT" class="college-cit">College of Industrial Technology – CIT
                                    </option>
                                    <option value="CICS" class="college-cics">College of Information and Computing
                                        Sciences - CICS</option>
                                    <option value="CTED" class="college-cted">College of Teacher Education - CTED</option>

                                    <!-- Add more options as needed -->
                                </select>
                                <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                    <i class="bi bi-caret-down-fill"></i>
                                </span>
                            </div>


                            <div class="mb-3">
                                <label for="image" class="form-label">Student Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <button type="submit" class="btn btn-primary px-5">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="flex-fill p-2 d-flex align-items-center justify-content-center">
                        <img class="img-fluid w-50" src="{{ asset('IMG/csulogo.png') }}" alt="CSU LOGO">
                    </div>
                </div>
            </div>
        </div>
    @stop
</x-app-layout>
