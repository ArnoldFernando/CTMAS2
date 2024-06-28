<x-app-layout>


    @section('content_header')
        <h1>Add Student</h1>
    @stop


    <div class="py-2">
        <div class="container">
            <div class="bg-white shadow-sm rounded d-flex overflow-hidden">
                <div class="p-4 text-dark flex-fill">
                    <form action="{{ route('add.student') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student I.D</label>
                            <input type="text" required name="student_id" id="student_id"
                                placeholder="input student I.D" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Student Name</label>
                            <input type="text" required name="name" id="name"
                                placeholder="input student name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="course" class="form-label">Student Course</label>
                            <input type="text" required name="course" id="course"
                                placeholder="input student course" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="college" class="form-label">Student college</label>
                            <input type="text" required name="college" id="college"
                                placeholder="input student college" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Student Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                    @if (session('failure'))
                        <div class="alert alert-danger mt-3">
                            {{ session('failure') }}
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                </div>
                <div class="flex-fill p-2 d-flex align-items-center justify-content-center">
                    <img class="img-fluid w-50"
                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQjc1btY6gwcVwmhDcT2922h6oZWp32rRlLMA&s"
                        alt="">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
