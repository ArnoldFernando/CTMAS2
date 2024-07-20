<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Faculty Records</h5>
    @stop
    @section('css')
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
        <style>
            /* Ensure dropdown menu is on top */
            .dropdown-menu {
                z-index: 1050;
            }
        </style>
    @stop
    @section('content')
        <div class="container-fluid p-1 font">
            <div class="bg-secondary bg-opacity-50 rounded-2">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center py-1 px-1">
                            <div class="dropdown">
                                <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="true">
                                    <i class="fa-solid fa-file-pdf me-1"></i>Export PDF
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form action="{{ route('faculty-records.pdf') }}" method="GET">
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
                                                    <option value="CICS">CICS</option>
                                                    <option value="CHM">CHM</option>
                                                    <option value="CTE">CTE</option>
                                                    <option value="CBEA">CBEA</option>
                                                    <option value="CIT">CIT</option>
                                                    <option value="CFAS">CFAS</option>
                                                    <option value="CCJE">CCJE</option>
                                                </select>
                                            </div>
                                            <div class="form-group px-2 py-2">
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fa-solid fa-file-pdf me-1"></i> Export PDF
                                                </button>
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
                                        <form action="{{ route('faculty.reports') }}" method="GET">
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
                                                <button type="submit" class="btn btn-primary w-100">
                                                    <i class="fa-solid fa-file-export me-1"></i> Filter Reports
                                                </button>
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
                    <div class="col-12">
                        <form method="GET" action="{{ route('faculty.records') }}" class="form-inline">
                            <div class="form-group mb-2 col-md-7 text-dark">
                                <label for="start_date" class="mr-2">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control px-3"
                                    value="{{ $startDate }}">
                                <div class="form-group ms-2">
                                    <label for="end_date" class="mr-2">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="{{ $endDate }}">
                                    <button type="submit" class="btn btn-primary ms-1">Filter</button>
                                </div>
                            </div>

                            <div class="form-group mb-2 col-md-5 text-dark justify-content-end  ">
                                {{-- <label for="end_date" class="mr-2">End Date:</label> --}}
                                <input type="text" class="form-control" placeholder="Search here...">
                                <button type="submit" class="btn btn-primary ms-1"><i
                                        class="fa-solid fa-magnifying-glass me-1"></i>Search</button>
                            </div>

                        </form>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row mt-1 px-1">
                    <div class="col">
                        <div class="table-responsive" style="max-height: 600px; overflow-y: auto; position: relative;">
                            <style>
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
                            <table class="table table-bordered text-center" style="margin-right: -17px;">
                                <thead class="table-dark sticky-top">
                                    <tr>
                                        <th>No.</th>
                                        <th>Faculty ID</th>
                                        <th>Name</th>
                                        <th>College</th>
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
                                            <td colspan="8" class="table-warning px-3 py-2">
                                                {{ $day }}
                                            </td>
                                        </tr>
                                        @foreach ($sessions as $session)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $session->faculty_id }}</td>
                                                <td>{{ $session->faculty->name }}</td>
                                                <td>{{ $session->faculty->college }}</td>
                                                <td>{{ \Carbon\Carbon::parse($session->time_in)->format('h:i A') }}</td>
                                                <td>{{ $session->time_out ? \Carbon\Carbon::parse($session->time_out)->format('h:i A') : 'N/A' }}
                                                </td>
                                                <td>
                                                    @if ($session->time_out)
                                                        @php
                                                            $timeIn = \Carbon\Carbon::parse($session->time_in);
                                                            $timeOut = \Carbon\Carbon::parse($session->time_out);
                                                            $duration = $timeOut->diff($timeIn)->format('%H:%I:%S');
                                                        @endphp
                                                        {{ $duration }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $session->created_at->format('Y-m-d') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
    @section('js')
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
    @stop
</x-app-layout>
