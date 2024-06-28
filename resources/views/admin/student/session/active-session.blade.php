<x-app-layout>
    <div class="container p-4">
        <div class="d-flex justify-content-center align-items-center">
            <div class="w-100 max-w-4xl bg-white shadow rounded-lg overflow-auto" style="max-height: 24rem;">
                <table class="table table-striped table-hover">
                    <thead class="thead-dark sticky-top">
                        <tr>
                            <th>#</th> {{-- Sequential number column --}}
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
                        @php $counter = 1 @endphp {{-- Initialize counter --}}
                        @foreach ($studentsTimedInToday as $student)
                            <tr>
                                <td>{{ $counter++ }}</td> {{-- Increment counter for each row --}}
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->student->name }}</td>
                                <td>{{ $student->student->course }}</td>
                                <td>Active</td>
                                <td>{{ $student->time_in }}</td>
                                <td>{{ $student->time_out }}</td>

                                <td>{{ $student->duration }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
