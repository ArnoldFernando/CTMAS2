<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>All Student Today</h5>
    @stop
    @section('content')
        <div class="container-fluid">
            <div class="bg-dark p-1 rounded-2 bg-opacity-25">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered text-center font">
                            <thead class="table-dark">
                                <tr>
                                    <th>No.</th>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = $studentsTimedInToday->count() @endphp
                                @foreach ($studentsTimedInToday->sortByDesc('created_at') as $student)
                                    <tr>
                                        <td>{{ $counter-- }}</td>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ $student->student->name }}</td>
                                        <td>{{ $student->student->course }}</td>
                                        <td>Active</td>
                                        <td>{{ \Carbon\Carbon::parse($student->time_in)->format('h:i A') }}</td>
                                        @if ($student->time_out === null)
                                            <td>N/A</td>
                                        @else
                                            <td>{{ \Carbon\Carbon::parse($student->time_out)->format('h:i A') }}</td>
                                        @endif
                                        <td>{{ $student->duration }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @stop

</x-app-layout>
