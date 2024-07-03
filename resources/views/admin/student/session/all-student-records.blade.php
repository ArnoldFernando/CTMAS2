<x-app-layout>

    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Student Records</h5>
    @stop

    @section('content')
        <div class="container p-4">
            <div class="d-flex justify-content-center align-items-center">
                <div class="w-100 max-w-4xl bg-white shadow rounded-lg overflow-auto" style="max-height: 24rem;">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark sticky-top">
                            <tr>
                                <th>#</th> {{-- New column for sequential number --}}
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
                            @php $counter = 1 @endphp {{-- Initialize counter --}}
                            @foreach ($sessionsByDay as $day => $sessions)
                                <tr>
                                    <td colspan="10" class="bg-dark text-white px-3 py-2">{{ $day }}</td>
                                </tr>
                                @foreach ($sessions as $session)
                                    <tr>
                                        <td>{{ $counter++ }}</td> {{-- Increment counter for each row --}}
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
            </div>
        </div>
    @stop
</x-app-layout>
