<x-app-layout>
    @section('content_header')
        <h1>Update Student Records</h1>
    @stop
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
                    title: 'Student ID is Already Existing in System '
                })
            })()
        </script>
    @endif
    <div class="py-2 font">
        <div class="container">
            <div class="bg-secondary bg-opacity-25 shadow-sm rounded d-flex overflow-hidden">
                <div class="p-4 text-dark flex-fill">
                    <form action="{{ route('student.update', $student->student_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="student_id" class="form-label">Student I.D</label>
                                <input type="text" name="student_id" placeholder="input student I.D"
                                    value="{{ $student->student_id }}" class="form-control">
                            </div>

                            <div class="mb-3 col-3">
                                <label for="year" class="form-label">Year</label>
                                <select required name="year" id="year" class="form-control">
                                    <option value="{{ $student->year }}" selected>{{ $student->year }}</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>

                            <div class="mb-3 col-3">
                                <label for="sex" class="form-label">Sex</label>
                                <select name="sex" id="sex" class="form-control" required>
                                    <option value="{{ $student->sex }}" selected>{{ ucfirst($student->sex) }}</option>
                                    <option value="male" {{ $student->sex === 'male' ? 'selected' : '' }}>Male
                                    </option>
                                    <option value="female" {{ $student->sex === 'female' ? 'selected' : '' }}>Female
                                    </option>
                                </select>
                                @error('sex')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                        <div class="row">
                            <div class="mb-3 col-4">
                                <label for="firstname" class="form-label">Student First Name</label>
                                <input type="text" name="first_name" placeholder="input student First Name"
                                    value="{{ $student->first_name }}" class="form-control">
                            </div>

                            <div class="mb-3 col-4">
                                <label for="Middle Initial" class="form-label">Student Middle Initial</label>
                                <input type="text" name="middle_initial" placeholder="input middle Initial"
                                    value="{{ $student->middle_initial }}" class="form-control">
                            </div>

                            <div class="mb-3 col-4">
                                <label for="Last Name" class="form-label">Student Last Name</label>
                                <input type="text" name="last_name" placeholder="input last Name"
                                    value="{{ $student->last_name }}" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="course_id" class="form-label">Student Course</label>
                                <select name="course_id" id="course_id" class="form-control form-select">
                                    @foreach ($courses as $college_id => $collegeCourses)
                                        <!-- Group by College ID -->
                                        <optgroup label="College: {{ $college_id }}">
                                            @foreach ($collegeCourses as $course)
                                                <option value="{{ $course->course_id }}"
                                                    data-college="{{ $course->college_id }}"
                                                    style="background-color: {{ $course->bg_color }};"
                                                    {{ $course->course_id === $student->course_id ? 'selected' : '' }}>
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
                                <select name="college_id" id="college_id" class="form-control" disabled>
                                    <option value="{{ $student->college_id }}" disabled selected>
                                        {{ $student->college->college_name ?? 'N/a' }}
                                    </option>
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
                            <input type="hidden" name="college_id" id="hidden_college_id"
                                value="{{ $student->college_id }}">

                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Student Image</label>
                            <input type="file" name="image" placeholder="input student image"
                                value="{{ $student->image }}" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>


                </div>
                <div class="flex-fill p-2 d-flex align-items-center justify-content-center">
                    <img class="img-fluid w-50" src="{{ asset('IMG/csulogo.png') }}" alt="CSU LOGO">
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('course_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var collegeId = selectedOption.getAttribute('data-college');
        document.getElementById('college_id').value = collegeId; // For display (if needed)
        document.getElementById('hidden_college_id').value = collegeId; // Store in hidden input
    });
</script>

<style>
    /* Define custom background colors for colleges */
    .college-cbea {
        background-color: #F4CE14;
        color: #fff;
    }


    .college-ccje {
        background-color: #d9534f;
        color: #fff;
    }

    .college-chm {
        background-color: #FF4E88;
        color: #fff;
    }

    .college-cfas {
        background-color: #3795BD;
        color: #fff;
    }

    .college-cit {
        background-color: #1F316F;
        color: #fff;
    }

    .college-cics {
        background-color: #FF8343;
        color: #fff;
    }

    .college-cted {
        background-color: #5bc0de;
        color: #fff;
    }

    /* Define custom background colors for courses */
    .course-bsais {
        background-color: #F4CE14;
        color: #fff;
    }

    .course-bscrim {
        background-color: #d9534f;
        color: #fff;
    }

    .course-bshm {
        background-color: #FF4E88;
        color: #fff;
    }

    .course-bsfas {
        background-color: #3795BD;
        color: #fff;
    }

    .course-bsindtech {
        background-color: #1F316F;
        color: #fff;
    }

    .course-bsit {
        background-color: #FF8343;
        color: #fff;
    }

    .course-cted {
        background-color: #5bc0de;
        color: #fff;
    }
</style>
