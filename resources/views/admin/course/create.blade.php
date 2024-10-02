<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Add Course</h5>
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
                        title: 'Course added successfully!'
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
                        title: 'Course code already exists!'
                    })
                })()
            </script>
        @endif

        <div class="py-4">
            <div class="container">
                <div class="row">
                    {{-- Form for adding new college --}}
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Add Course</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.course') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="course_id" class="form-label">Course Accronym</label>
                                        <input type="text" required name="course_id" id="course_id"
                                            placeholder="Input Course Accronym" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="course_name" class="form-label">Course Name</label>
                                        <input type="text" required name="course_name" id="course_name"
                                            placeholder="Input Course Name" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="type" class="form-label">Course Type</label>
                                        <select name="type" id="type" class="form-select">
                                            <option value="undergraduateschool">Undergraduate School</option>
                                            <option value="graduateschool">Graduate School</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="college_id" class="form-label">College</label>
                                        <select name="college_id" id="college_id" class="form-select" required>
                                            <option value="" disabled selected>Select College</option>
                                            @foreach ($colleges as $college)
                                                <option value="{{ $college->college_id }}">
                                                    {{ $college->college_id }} = {{ $college->college_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-start gap-2">
                                        <button type="submit" class="btn btn-primary px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Existing Courses</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Name</th>
                                            <th>Type</th>
                                            <th>College</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($courses as $course)
                                            <tr>
                                                <td>{{ $course->course_id }}</td>
                                                <td>{{ $course->course_name }}</td>
                                                <td>{{ ucfirst($course->type) }}</td>
                                                <td>{{ $course->college ? $course->college->college_id : 'N/A' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No courses available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.getElementById('type').addEventListener('change', function() {
                const collegeField = document.getElementById('college_id');
                if (this.value === 'graduateschool') {
                    collegeField.value = ''; // Clear the value if previously selected
                    collegeField.setAttribute('disabled', true);
                } else {
                    collegeField.removeAttribute('disabled');
                }
            });

            // Ensure college field is initially disabled if the selected type is graduateschool
            window.addEventListener('DOMContentLoaded', (event) => {
                const typeField = document.getElementById('type');
                const collegeField = document.getElementById('college_id');
                if (typeField.value === 'graduateschool') {
                    collegeField.setAttribute('disabled', true);
                }
            });
        </script>

    @stop
</x-app-layout>
