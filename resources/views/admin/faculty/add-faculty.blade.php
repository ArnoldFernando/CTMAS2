<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Add Faculty and Staff</h5>
    @stop
    <div class="">
        <div class="container-fluid font">
            <div class="bg-secondary bg-opacity-25 shadow-sm rounded d-flex overflow-hidden">
                <div class="p-4 text-dark flex-fill">
                    <form action="{{ route('add.faculty') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="faculty_id" class="form-label">Faculty I.D</label>
                            <input type="text" required name="faculty_id" id="faculty_id"
                                placeholder="Input Faculty I.D" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Faculty Name</label>
                            <input type="text" required name="name" id="name"
                                placeholder="Input Faculty Name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="college" class="form-label">Faculty College</label>
                            <select required name="college" id="college" class="form-control">
                                <option value="" disabled selected>Select College</option>
                                <option value="CICS">College of Information And Computing Sciences</option>
                                <option value="CBEA">College of Business Entrepreneurship And Accountancy</option>
                                <option value="CTED">College of Teacher Education</option>
                                <option value="CCJE">College of Criminal Justice Education</option>
                                <option value="CFAS">College of Fisheries And Aquatic Sciences</option>
                                <option value="CIT">College Of Industrial Technology</option>
                                <option value="CHM">College of Hospitality Management</option>
                                <!-- Add more options as needed -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Faculty Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary px-5">Add </button>
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
                    <img class="img-fluid w-50" src="{{ asset('IMG/csulogo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
