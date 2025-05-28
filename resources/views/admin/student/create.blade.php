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
                    timerProgressBar: true,
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
                    timerProgressBar: true,
                });
                (async () => {
                    await Toast.fire({
                        icon: 'warning',
                        title: 'Student ID already exists in the system!'
                    })
                })()
            </script>
        @endif

        <div class="py-2 font">
            <div class="container">
                <div class=" bg-opacity-25 shadow-sm rounded d-flex overflow-hidden">
                    <div class="p-4 text-dark flex-fill">
                        <form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <div class="mb-3 col-lg-6 col-sm-12">
                                    <label for="student_id" class="form-label">Student I.D</label>
                                    <input type="text" required name="student_id" id="student_id"
                                        placeholder="Input Student I.D" class="form-control">
                                    @error('student_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-3 col-sm-12">
                                    <label for="year" class="form-label">Year</label>
                                    <select required name="year" id="year" class="form-control">
                                        <option value="" disabled selected>Select Year</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    @error('year')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-3 col-sm-12">
                                    <label for="sex" class="form-label">Sex</label>
                                    <select required name="sex" id="sex" class="form-control">
                                        <option value="" disabled selected>Select Sex</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('sex')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-lg-4 col-sm-12">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" required name="first_name" id="first_name"
                                        placeholder="Input First Name" class="form-control">
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4 col-sm-12">
                                    <label for="middle_initial" class="form-label">Middle Initial</label>
                                    <input type="text" name="middle_initial" id="middle_initial"
                                        placeholder="Input Middle Initial" class="form-control">
                                    @error('middle_initial')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-lg-4 col-sm-12">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" required name="last_name" id="last_name"
                                        placeholder="Input Last Name" class="form-control">
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="course_id" class="form-label">Student Course</label>
                                    <select required name="course_id" id="course_id" class="form-control form-select">
                                        <option value="" disabled selected>Select Course</option>
                                        @foreach ($courses as $college_id => $collegeCourses)
                                            <!-- Group by College ID -->
                                            <optgroup label="College: {{ $college_id }}">
                                                @foreach ($collegeCourses as $course)
                                                    <option value="{{ $course->course_id }}"
                                                        data-college="{{ $course->college_id }}"
                                                        style="background-color: {{ $course->bg_color }};">
                                                        {{ $course->course_id }} - {{ $course->course_name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                        <i class="bi bi-caret-down-fill"></i>
                                    </span>
                                </div>

                                <div class="mb-3 position-relative col-6">
                                    <label for="college_id" class="form-label">Student College</label>
                                    <select disabled name="college_id" id="college_id" class="form-control">
                                        <option value="" disabled selected>College</option>
                                        @foreach ($colleges as $college)
                                            <option value="{{ $college->college_id }}">
                                                {{ $college->college_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('college_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                        <i class="bi bi-caret-down-fill"></i>
                                    </span>
                                </div>
                                <input type="hidden" name="college_id" id="hidden_college_id">

                                <div class="mb-3">
                                    <label for="image" class="form-label">Student Image</label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="d-flex justify-content-start gap-2">
                                <button type="submit" class="btn btn-primary px-5">Add</button>
                            </div>

                        </form>
                    </div>
                    <div class="flex-fill p-2 d-flex align-items-center justify-content-center img-con">
                        <img class="img-fluid " src="{{ asset('IMG/college-student-2.png') }}" alt="CSU LOGO">
                    </div>

                    <style>
                        @media (max-width: 768px) {
                            .img-con img {
                                display: none
                            }
                        }
                    </style>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('course_id').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var collegeId = selectedOption.getAttribute('data-college');
                document.getElementById('college_id').value = collegeId; // For display (if needed)
                document.getElementById('hidden_college_id').value = collegeId; // Store in hidden input
            });
        </script>

    @stop
</x-app-layout>
