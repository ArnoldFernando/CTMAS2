<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Add Graduateschool</h5>
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
                        title: 'Graduate School ID already exists in the system!'
                    })
                })()
            </script>
        @endif

        <div class="py-2 font">
            <div class="container">
                <div class="bg-secondary bg-opacity-25 shadow-sm rounded d-flex overflow-hidden">
                    <div class="p-4 text-dark flex-fill">
                        <form action="{{ route('gradschool.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="student_id" class="form-label">Graduate School I.D</label>
                                <input type="text" required name="student_id" id="student_id"
                                    placeholder="Input Graduate School I.D" class="form-control">
                                @error('student_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" required name="first_name" id="first_name"
                                    placeholder="Input First Name" class="form-control">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="middle_initial" class="form-label">Middle Initial</label>
                                <input type="text" required name="middle_initial" id="middle_initial"
                                    placeholder="Input Middle Initial" class="form-control">
                                @error('middle_initial')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" required name="last_name" id="last_name" placeholder="Input Last Name"
                                    class="form-control">
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="course_id" class="form-label">Graduate School Course</label>
                                <select required name="course_id" id="course_id" class="form-control">
                                    <option value="" disabled selected>Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->course_id }}">
                                            {{ $course->course_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="image" class="form-label">Graduate School Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
