<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Student Records</h5>
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
                                    <li><a class="dropdown-item bg-success" href="{{ route('student-records.pdf') }}"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>All
                                            Records</a>
                                    </li>
                                    <li><a class="dropdown-item bg-orange" href="#"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>CICS</a></li>
                                    <li><a class="dropdown-item bg-pink" href="#"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>CHM</a></li>
                                    <li><a class="dropdown-item bg-primary" href="#"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>CTE</a></li>
                                    <li><a class="dropdown-item bg-yellow" href="#"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>CBEA</a></li>
                                    <li><a class="dropdown-item bg-secondary" href="#"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>CIT</a></li>
                                    <li><a class="dropdown-item bg-info" href="#"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>CFAS</a></li>
                                    <li><a class="dropdown-item bg-danger" href="#"><i
                                                class="fa-solid fa-caret-right me-2 text-white "></i>CCJE</a></li>
                                </ul>
                            </div>
                            <button class="btn btn-success ms-2"><i class="fa-solid fa-file-export me-1"></i>Export All
                                Records</button>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row">
                    <div class="col-12">
                        <form method="GET" action="{{ route('student.records') }}" class="form-inline">
                            <div class="form-group mb-2 col-md-4 text-dark">
                                <label for="start_date" class="mr-2">Start Date:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control px-3"
                                    value="{{ $startDate }}">
                            </div>
                            <div class="form-group mb-2 col-md-4 text-dark">
                                <label for="end_date" class="mr-2">End Date:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control"
                                    value="{{ $endDate }}">
                                <button type="submit" class="btn btn-primary ms-1">Filter</button>
                            </div>
                            <div class="form-group mb-2 col-md-4 text-dark justify-content-end  ">
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
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Course</th>
                                        <th>College</th>
                                        <th>Time In</th>
                                        <th>Time Out</th>
                                        <th>Duration</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $counter = 1 @endphp
                                    @foreach ($sessionsByDay->sortByDesc('created_at') as $day => $sessions)
                                        <tr>
                                            <td colspan="9" class="table-warning px-3 py-2">
                                                {{ $day }}
                                            </td>
                                        </tr>
                                        @foreach ($sessions as $session)
                                            <tr>
                                                <td>{{ $counter++ }}</td>
                                                <td>{{ $session->student_id }}</td>
                                                <td>{{ $session->student->name }}</td>
                                                <td>{{ $session->student->course }}</td>
                                                <td>{{ $session->student->college }}</td>
                                                <td>{{ $session->time_in }}</td>
                                                <td>{{ $session->time_out ?: 'N/A' }}</td>
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
                                                <td>{{ $session->created_at->format('F j, Y') }}</td>
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
