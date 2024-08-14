<x-app-layout>


    @section('content_header')
        <h1>update Faculty and Staff</h1>
    @stop

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('update.faculty') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" placeholder="input faculty I.D"
                            value="{{ $Faculty_and_staff['id'] }}" class="form-control">

                        <div class="mb-3">
                            <label for="faculty_id" class="form-label">Faculty I.D</label>
                            <input type="text" name="faculty_id" placeholder="input faculty I.D"
                                value="{{ $Faculty_and_staff['faculty_id'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Faculty Name</label>
                            <input type="text" name="name" placeholder="input faculty name"
                                value="{{ $Faculty_and_staff['name'] }}" class="form-control">
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
                            <input type="file" name="image" placeholder="input faculty image"
                                value="{{ $Faculty_and_staff['image'] }}" class="form-control">
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
