<x-app-layout>


    @section('content_header')
        <h1>update</h1>
    @stop

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('update.student') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" placeholder="input student I.D"
                            value="{{ $Student_list['id'] }}" class="form-control">

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student I.D</label>
                            <input type="text" name="student_id" placeholder="input student I.D"
                                value="{{ $Student_list['student_id'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Student Name</label>
                            <input type="text" name="name" placeholder="input student name"
                                value="{{ $Student_list['name'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="course" class="form-label">Student Course</label>
                            <input type="text" name="course" placeholder="input student course"
                                value="{{ $Student_list['course'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="college" class="form-label">Student college</label>
                            <input type="text" name="college" placeholder="input student college"
                                value="{{ $Student_list['student_id'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Student Image</label>
                            <input type="file" name="image" placeholder="input student image"
                                value="{{ $Student_list['image'] }}" class="form-control">
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
