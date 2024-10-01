<x-app-layout>


    @section('content_header')
        <h1>update</h1>
    @stop
    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('gradschool.update', $student->student_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student I.D</label>
                            <input type="text" name="student_id" placeholder="input student I.D"
                                value="{{ $student->student_id }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Student First Name</label>
                            <input type="text" name="first_name" placeholder="input student First Name"
                                value="{{ $student->first_name }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="Middle Initial" class="form-label">Student Middle Initial</label>
                            <input type="text" name="middle_initial" placeholder="input middle Initial"
                                value="{{ $student->middle_initial }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="Last Name" class="form-label">Student Last Name</label>
                            <input type="text" name="last_name" placeholder="{{ $student->last_name }}"
                                value="{{ $student->last_name }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="course_id" class="form-label">Student Course</label>
                            <select name="course_id" id="course_id" class="form-control">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->course_id }}"
                                        style="background-color: {{ $course->bg_color }};"
                                        {{ $course->course_id === $student->course_id ? 'selected' : '' }}>
                                        {{ $course->course_id }} = {{ $course->course_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                <i class="bi bi-caret-down-fill"></i>
                            </span>
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

                    @if (session('success'))
                        <div id="success-message" class="alert alert-success mt-3">
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
