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
                            <a href="{{ route('student-records.pdf') }}" class="btn btn-danger"><i
                                    class="fa-solid fa-file-pdf me-1"></i>Export PDF</a>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row mt-1 px-1">
                    <div class="col">
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>No.1</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>College</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Duration Date</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1 @endphp
                                @foreach ($sessionsByDay as $day => $sessions)
                                    <tr>
                                        <td colspan="10" class="table-warning px-3 py-2">
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
                                                    <?php
                                                    $timeIn = \Carbon\Carbon::parse($session->time_in);
                                                    $timeOut = \Carbon\Carbon::parse($session->time_out);
                                                    $duration = $timeOut->diff($timeIn)->format('%H:%I:%S');
                                                    ?>
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
        {{-- <div class="d-flex justify-content-center align-items-center">
                <div class="" style="max-height: 24rem;">

                    <a href="{{ route('student-records.pdf') }}">export pdf</a>

                    <table class="table table-striped table-hover">
                        <thead class="thead-dark sticky-top">
                            <tr>
                                <th>No.1</th>
                                <th>Student-ID</th>
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
                                    <td colspan="10" class="bg-dark text-white px-3 py-2">{{ $day }}</td>
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
                                            <?php
                                            $timeIn = \Carbon\Carbon::parse($session->time_in);
                                            $timeOut = \Carbon\Carbon::parse($session->time_out);
                                            $duration = $timeOut->diff($timeIn)->format('%H:%I:%S');
                                            ?>
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
        </div> --}}
    @stop
</x-app-layout>
