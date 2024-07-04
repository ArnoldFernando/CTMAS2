<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Student Records</h5>
    @stop

    @section('content')
        <div class="container-fluid p-1 font">
            <div class="bg-secondary bg-opacity-50 rounded-2">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-end align-items-center py-1 px-1">
                            <form method="GET" action="{{ route('student.records') }}" class="d-flex align-items-center">
                                <div class="me-2">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="{{ $startDate }}">
                                </div>
                                <div class="me-2">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="{{ $endDate }}">
                                </div>
                                <div class="me-2">
                                    <button type="submit" class="btn btn-primary mt-4">Filter</button>
                                </div>
                            </form>
                            <a href="{{ route('student-records.pdf') }}" class="btn btn-danger">
                                <i class="fa-solid fa-file-pdf me-1"></i>Export PDF
                            </a>
                        </div>
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
                                    @foreach ($sessionsByDay as $day => $sessions)
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
</x-app-layout>
