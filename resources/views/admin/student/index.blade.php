<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font">
            <i class="fa-solid fa-caret-right me-2 text-primary"></i>Student List
        </h5>
    @endsection

    @section('content')
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <x-existing-records-modal :records="session('existingRecords')" />

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

                <form action="{{ route('student.index') }}" method="GET" class="d-flex">
                    <input type="text" name="query" placeholder="🔍 Search" class="form-control mr-2"
                        value="{{ request()->input('query') }}">

                    {{--  <button type="hidden" class="btn btn-primary d-flex align-items-center">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Search
                    </button>  --}}
                </form>
            </div>

            <style>
                @media(max-width: 768px) {
                    table {
                        font-size: 10px
                    }

                    .image {
                        display: none;
                    }
                }
            </style>
            <div class="bg-dark bg-opacity-25 p-1 rounded-2 table-responsive-sm">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>ID</th>
                            <th>STUDENT NAME</th>
                            <th>COURSE</th>
                            <th>COLLEGE</th>
                            <th>YEAR</th>
                            <th class="image">IMAGE</th>
                            <th class="action">ACTION</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if (isset($data) && count($data) > 0)
                            @foreach ($data as $course => $students)
                                <tr class="bg-light">
                                    <td colspan="10" class="py-1 table-warning text-uppercase">
                                        {{ strtoupper($course) }}
                                    </td>
                                </tr>
                                @php
                                    $counter = 1;
                                @endphp
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $counter++ }}</td>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ $student->first_name }} {{ $student->middle_initial }}
                                            {{ $student->last_name }}</td>
                                        <td>{{ $student->course_id }}</td>
                                        <td>{{ $student->college_id }}</td>
                                        <td>{{ $student->year }}</td>
                                        <td class="image">
                                            @if ($student->image)
                                                <img src="{{ asset('student-images/' . $student->image) }}"
                                                    alt="Student Photo" class="img-fluid"
                                                    style="border-radius: 50%; height:25px; width:25px;">
                                            @else
                                                <img src="{{ asset('IMG/default.jpg') }}" class="img-fluid" alt=""
                                                    style="border-radius: 50%; height:25px; width:25px;">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('student.edit', $student->student_id) }}"
                                                class="d-inline btn btn-success"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="py-1">No results found</td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    @endsection
</x-app-layout>
