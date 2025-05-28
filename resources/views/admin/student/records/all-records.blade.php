<x-app-layout>


    @section('css')
        <style>
            /* Ensure dropdown menu is on top */
            .dropdown-menu {
                z-index: 1050;
            }

            @media(max-width: 768px) {
                table {
                    font-size: 10px
                }

                .image {
                    display: none;
                }
            }

            @media(min-width: 768px) {
                table {
                    font-size: 14px
                }
            }
        </style>
    @stop

    @section('content')
        <div class="container-fluid p-1 font">
            <div class="mt-2 rounded-2">
                <div class="">


                    <div class="row">
                        <div class="col">

                            <div class="d-flex justify-content-between align-items-start px-1">
                                <h5 class="fw-bold font p-2"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Student
                                    Records</h5>
                                <!-- Export PDF Button Dropdown -->
                                <div class="d-flex">

                                    <div class="dropdown me-2">
                                        <button class="btn btn-danger dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa-solid fa-file-pdf me-1"></i>Export PDF
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('student-records.pdf') }}" method="GET">
                                                    <div class="form-group px-2">
                                                        <label for="start_date">Start Date:</label>
                                                        <input type="date" name="start_date" id="start_date"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="form-group px-2">
                                                        <label for="end_date">End Date:</label>
                                                        <input type="date" name="end_date" id="end_date"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="form-group px-2">
                                                        <label for="college">College:</label>
                                                        <select name="college" id="college" class="form-control">
                                                            <option value="">All Colleges</option>
                                                            @foreach ($colleges as $college)
                                                                <option value="{{ $college->college_id }}">
                                                                    {{ $college->college_id }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group px-2 py-2">
                                                        <input type="submit" value="Export PDF"
                                                            class="btn btn-primary w-100">
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Make Reports Button Dropdown -->
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa-solid fa-file-export me-1"></i> Make Reports
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="{{ route('student.reports') }}" method="GET">
                                                    <div class="form-group px-2">
                                                        <label for="start_date">Start Date:</label>
                                                        <input type="date" name="start_date" id="start_date"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="form-group px-2">
                                                        <label for="end_date">End Date:</label>
                                                        <input type="date" name="end_date" id="end_date"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="form-group px-2">
                                                        <label for="school_year">School Year:</label>
                                                        <input type="text" name="school_year" id="school_year"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group px-2">
                                                        <label for="semester">Semester:</label>
                                                        <input type="text" name="semester" id="semester"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <div class="form-group px-2 py-2">
                                                        <input type="submit" value="Export Reports"
                                                            class="btn btn-primary w-100">
                                                    </div>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <!-- Filter Form -->
                            <form method="GET" action="{{ route('student.records') }}"
                                class="form-inline d-flex align-items-center">
                                <div class="form-group mb-2 text-dark">
                                    <label for="start_date" class="mr-2">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control px-3"
                                        value="{{ $startDate }}">
                                    <label for="end_date" class="ms-2 mr-2">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="{{ $endDate }}">
                                    <button type="submit" class="btn btn-primary ms-2">Filter</button>
                                </div>
                            </form>

                            <!-- Search Form -->
                            <form action="{{ route('student.records') }}" method="GET"
                                class="d-flex align-items-center">
                                <input type="text" name="query" placeholder="Search by student ID or name..."
                                    class="form-control me-2" value="{{ request()->input('query') }}">
                                <button type="submit" class="btn btn-primary d-flex align-items-center">
                                    <i class="fa-solid fa-magnifying-glass me-2"></i>Search
                                </button>
                            </form>

                        </div>
                    </div>

                </div>
                {{--  <hr class="mt-0">  --}}

                <!-- Records Table -->
                <div class="row mt-1 px-1">
                    <div class="col">
                        @if (session('results') || isset($sessionsByDay))
                            <h6 class="fw-bold">{{ session('results') ? 'Search Results:' : '' }}</h6>
                            <div class="rounded-2 table-responsive-sm border border-black-subtle">
                                <table class="table table-striped table-bordered text-center">
                                    <!-- Table Header -->
                                    <thead class="table-warning">
                                        <tr class="">
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>College</th>
                                            <th>Year</th>
                                            <th>Sex</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Duration</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        @php $counter = $filteredSessions->firstItem(); @endphp
                                        @foreach ($filteredSessions as $session)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $session->student_id }}</td>
                                                <td>{{ $session->student->first_name }}
                                                    {{ $session->student->middle_initial }}
                                                    {{ $session->student->last_name }}</td>
                                                <td>{{ $session->student->course_id }}</td>
                                                <td>{{ $session->student->college_id }}</td>
                                                <td>{{ $session->student->year }}</td>
                                                <td>{{ $session->student->sex }}</td>
                                                <td>{{ $session->time_in }}</td>
                                                <td>{{ $session->time_out ?: 'N/A' }}</td>
                                                <td>{{ $session->duration ?: 'N/A' }}</td>
                                                <td>{{ $session->created_at->format('F j, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-center">
                                    {{ $filteredSessions->appends(request()->query())->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        @else
                            <p>No records found.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    @stop

    @section('js')
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        <script>
            document.getElementById('start_date').addEventListener('change', updateSchoolYearAndSemester);
            document.getElementById('end_date').addEventListener('change', updateSchoolYearAndSemester);

            function updateSchoolYearAndSemester() {
                const startDate = new Date(document.getElementById('start_date').value);
                const endDate = new Date(document.getElementById('end_date').value);

                if (startDate && endDate) {
                    let schoolYear = '';
                    let semester = '';

                    const startMonth = startDate.getMonth() + 1;
                    const startYear = startDate.getFullYear();

                    if (startMonth == 7) {
                        schoolYear = `${startYear}-${startYear + 1}`;
                        semester = 'Vacation';
                    } else if (startMonth >= 8 && startMonth <= 12) {
                        schoolYear = `${startYear}-${startYear + 1}`;
                        semester = 'First Semester';
                    } else if (startMonth >= 1 && startMonth <= 6) {
                        schoolYear = `${startYear - 1}-${startYear}`;
                        semester = 'Second Semester';
                    }

                    document.getElementById('school_year').value = schoolYear;
                    document.getElementById('semester').value = semester;
                }
            }
        </script>
    @stop
</x-app-layout>
