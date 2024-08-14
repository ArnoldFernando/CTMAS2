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
</style>
