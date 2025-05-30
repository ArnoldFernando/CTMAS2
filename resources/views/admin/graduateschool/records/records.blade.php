<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Graduate School Records</h5>
    @stop

    @section('css')
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Ensure dropdown menu is on top */
            .dropdown-menu {
                z-index: 1050;
            }

            .table-responsive::-webkit-scrollbar {
                display: none;
            }

            .table-responsive {
                -ms-overflow-style: none;
                /* IE and Edge */
                scrollbar-width: none;
                /* Firefox */
            }
        </style>
    @stop

    @section('content')
        <div class="container-fluid p-1 font">
            <div class="bg-secondary bg-opacity-50 rounded-2">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center py-1 px-1">
                            <div class="dropdown me-2">
                                <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa-solid fa-file-pdf me-1"></i>Export PDF
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{ route('gradschool-records.pdf') }}" method="GET">
                                            <div class="form-group px-2">
                                                <label for="start_date">Start Date:</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group px-2">
                                                <label for="end_date">End Date:</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control"
                                                    required>
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
                                                <input type="submit" value="Export PDF" class="btn btn-primary w-100">
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa-solid fa-file-export me-1"></i> Make Reports
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{ route('gradschool.reports') }}" method="GET">
                                            <div class="form-group px-2">
                                                <label for="start_date">Start Date:</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group px-2">
                                                <label for="end_date">End Date:</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group px-2">
                                                <label for="school_year">School Year:</label>
                                                <input type="text" name="school_year" id="school_year"
                                                    class="form-control" readonly>
                                            </div>
                                            <div class="form-group px-2">
                                                <label for="semester">Semester:</label>
                                                <input type="text" name="semester" id="semester" class="form-control"
                                                    readonly>
                                            </div>
                                            <div class="form-group px-2 py-2">
                                                <input type="submit" value="Export Reports" class="btn btn-primary w-100">
                                            </div>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="mt-0">

                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <form method="GET" action="{{ route('gradschool.records') }}"
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

                        <form action="{{ route('search.gradschool.records') }}" method="GET"
                            class="d-flex align-items-center">
                            <input type="text" name="query" placeholder="Search..." class="form-control me-2"
                                value="{{ request()->input('query') }}">
                            <button type="submit" class="btn btn-primary d-flex align-items-center">
                                <i class="fa-solid fa-magnifying-glass me-2"></i>Search
                            </button>
                        </form>
                    </div>

                </div>

                <hr class="mt-0">

                @if (session('results'))
                    <div class="row mt-1 px-1">
                        <div class="col">
                            <h6 class="fw-bold">Search Results:</h6>
                            <div class="table-responsive"
                                style="max-height: 600px; overflow-y: auto; position: relative;">
                                <table class="table table-bordered text-center" style="margin-right: -17px;">
                                    <thead class="table-dark sticky-top">
                                        <tr>
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Duration</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1 @endphp
                                        @foreach (session('results') as $session)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $session->student_id }}</td>
                                                <td>{{ $session->student->first_name }}
                                                    {{ $session->student->middle_initial }}
                                                    {{ $session->student->last_name }}</td>
                                                <td>{{ $session->student->course_id }}</td>
                                                <td>{{ $session->time_in }}</td>
                                                <td>{{ $session->time_out ?: 'N/A' }}</td>
                                                <td>{{ $session->duration ?: 'N/A' }}</td>
                                                <td>{{ $session->created_at->format('F j, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @elseif (isset($sessionsByDay))
                    <div class="row mt-1 px-1">
                        <div class="col">
                            <div class="table-responsive"
                                style="max-height: 600px; overflow-y: auto; position: relative;">
                                <table class="table table-bordered text-center" style="margin-right: -17px;">
                                    <thead class="table-dark sticky-top">
                                        <tr>
                                            <th>No.</th>
                                            <th>Student ID</th>
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Duration</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = 1 @endphp
                                        @foreach ($sessionsByDay as $day => $sessions)
                                            <tr>
                                                <td colspan="9" class="table-warning px-3 py-2">{{ $day }}
                                                </td>
                                            </tr>
                                            @foreach ($sessions as $session)
                                                <tr>
                                                    <td>{{ $counter++ }}</td>
                                                    <td>{{ $session->student_id }}</td>
                                                    <td>{{ $session->student->first_name }}
                                                        {{ $session->student->middle_initial }}
                                                        {{ $session->student->last_name }}</td>
                                                    <td>{{ $session->student->course_id }}</td>
                                                    <td>{{ $session->time_in }}</td>
                                                    <td>{{ $session->time_out ?: 'N/A' }}</td>
                                                    <td>{{ $session->duration ?: 'N/A' }}</td>
                                                    <td>{{ $session->created_at->format('F j, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mt-1 px-1">
                        <div class="col">
                            <p>No records found.</p>
                        </div>
                    </div>
                @endif
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
                        // Vacation period in July
                        schoolYear = `${startYear}-${startYear + 1}`;
                        semester = 'Vacation';
                    } else if (startMonth >= 8 && startMonth <= 12) {
                        // First semester
                        schoolYear = `${startYear}-${startYear + 1}`;
                        semester = 'First Semester';
                    } else if (startMonth >= 1 && startMonth <= 6) {
                        // Second semester
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
