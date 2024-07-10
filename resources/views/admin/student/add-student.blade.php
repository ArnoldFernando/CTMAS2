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
                <div class="bg-white shadow-sm rounded d-flex overflow-hidden">
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

                            <div class="mb-3">
                                <label for="course" class="form-label">Student Course</label>
                                <select required name="course" id="course" class="form-control">
                                    <option value="" disabled selected>Select Course</option>
                                    <option class="bg-primary" value="BSIT">Bachelor of Science in Information Technology
                                    </option>
                                    <option class="bg-primary" value="BSHM">Bachelor of Science in Hospitality Management
                                    </option>
                                    <option class="bg-primary" value="BSED">Bachelor of Science in Secondary Education
                                    </option>
                                    <!-- Add more options as needed -->
                                </select>
                            </div>

                            <div class="mb-3 position-relative">
                                <label for="college" class="form-label">Faculty College</label>
                                <select required name="college" id="college" class="form-select">
                                    <option value="" disabled selected>Select College</option>
                                    <option class="bg-orange text-white" value="CICS">College of Information And Computing
                                        Sciences</option>
                                    <option class="bg-warning" value="CBEA">College of Business Entrepreneurship And
                                        Accountancy</option>
                                    <option class="bg-blue" value="CTED">College of Teacher Education</option>
                                    <option class="bg-danger" value="CCJE">College of Criminal Justice Education</option>
                                    <option class="bg-info" value="CFAS">College of Fisheries And Aquatic Sciences
                                    </option>
                                    <option class="bg-navy" value="CIT">College Of Industrial Technology
                                    </option>
                                    <option class="bg-pink" value="CHM">College of Hospitality Management</option>
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
                                <button type="submit" class="btn btn-primary px-5">Save</button>
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
