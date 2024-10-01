<x-app-layout>

    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Student List</h5>
    @stop

    @section('content')


        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if (session('existingRecords') && session('existingRecords')->isNotEmpty())
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let existingRecords = @json(session('existingRecords'));
                    let message = "The following records already exist:<br><br>";

                    existingRecords.forEach(record => {
                        message +=
                            `<strong>${record.type.charAt(0).toUpperCase() + record.type.slice(1)} ID:</strong> ${record.id} exists in <strong>${record.table}</strong><br>`;
                    });

                    document.getElementById('modal-body-content').innerHTML = message;
                    new bootstrap.Modal(document.getElementById('existingRecordsModal')).show();
                });
            </script>
        @endif

        <!-- Modal HTML -->
        <div class="modal fade" id="existingRecordsModal" tabindex="-1" aria-labelledby="existingRecordsModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="existingRecordsModalLabel">Existing Records</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="modal-body-content">
                        <!-- Existing records content will be inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid font">
            <div class="d-flex justify-content-between mb-2">


                <form action="{{ route('student.index') }}" method="GET" class="d-flex gap-2">
                    <select name="course_id" id="course_id" class="form-control">
                        <option value="">All Courses</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course }}" {{ $selectedCourse == $course ? 'selected' : '' }}>
                                {{ strtoupper($course) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </form>

                <form action="{{ route('search.student') }}" method="GET" class="d-flex">
                    <input type="text" name="query" placeholder="Search..." class="form-control mr-2"
                        value="{{ request()->input('query') }}">
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Search
                    </button>
                </form>
            </div>
            <div class="bg-dark bg-opacity-25 p-1 rounded-2">
                <div class="row">

                    <div class="col">
                        <table class="table table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>STUDENT NAME</th>
                                    <th>COURSE</th>
                                    <th>COLLEGE</th>
                                    <th>YEAR</th>
                                    <th>IMAGE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            @if (isset($results) && count($results) > 0)
                                <tbody class="text-center">
                                    @foreach ($results as $student)
                                        <tr>
                                            <td>{{ $student->student_id }}</td>
                                            <td>{{ $student->first_name }} {{ $student->middle_initial }}
                                                {{ $student->last_name }}</td>
                                            <td>{{ $student->course_id }}</td>
                                            <td>{{ $student->college_id }}</td>
                                            <td>{{ $student->year }}</td>
                                            <td>
                                                @if ($student->image)
                                                    <img src="{{ asset('student-images/' . $student->image) }}"
                                                        alt="Student Photo" class="img-fluid"
                                                        style="border-radius: 50%; height:25px; width:25px;">
                                                @else
                                                    {{--  <p class="py-0">No photo available</p>  --}}
                                                    <img src="{{ asset('IMG/default.jpg') }}" class="img-fluid"
                                                        alt="" style="border-radius: 50%; height:25px; width:25px;">
                                                @endif
                                            </td>
                                            <td>
                                                {{--  <a href="{{ 'delete/' . $student['id'] }}"
                                                    class="d-inline btn btn-danger">Delete</a>  --}}
                                                <a href="{{ route('student.edit', $student->student_id) }}"
                                                    class="d-inline btn btn-primary">Update</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif (!isset($results))
                                <tbody class="text-center">
                                    @foreach ($Student_lists as $group => $Student_list)
                                        <tr class="bg-light">
                                            <td colspan="10" class="py-1 table-warning text-uppercase">
                                                {{ $group }}
                                            </td>
                                        </tr>
                                        @foreach ($Student_list as $student)
                                            <tr>
                                                <td>{{ $student->student_id }}</td>
                                                <td>{{ $student->first_name }} {{ $student->middle_initial }}
                                                    {{ $student->last_name }}</td>
                                                <td>{{ $student->course_id }}</td>
                                                <td>{{ $student->college_id }}</td>
                                                <th>{{ $student->year }}</th>
                                                <td>
                                                    @if ($student->image)
                                                        <img src="{{ asset('student-images/' . $student->image) }}"
                                                            alt="Student Photo" class="img-fluid"
                                                            style="border-radius: 50%; height:25px; width:25px;">
                                                    @else
                                                        {{--  <p class="py-0">No photo available</p>  --}}
                                                        <img src="{{ asset('IMG/default.jpg') }}" class="img-fluid"
                                                            alt=""
                                                            style="border-radius: 50%; height:25px; width:25px;">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{--  <a href="{{ 'delete/' . $student['id'] }}"
                                                        class="d-inline btn btn-danger">Delete</a>   --}}
                                                    <a href="{{ route('student.edit', $student->student_id) }}"
                                                        class="d-inline btn btn-primary">Update</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            @else
                                <tbody class="text-center">
                                    <tr>
                                        <td colspan="7" class="py-1">No results found</td>
                                    </tr>
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>

    @stop
</x-app-layout>
