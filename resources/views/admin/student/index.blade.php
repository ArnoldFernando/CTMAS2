<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font">
            <i class="fa-solid fa-caret-right text-primary"></i> Student List
        </h5>
    @endsection

    @section('content')
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <x-existing-records-modal :records="session('existingRecords')" />

        <div class="container-fluid font">
            <div class="d-flex justify-content-between mb-2">
                <form action="{{ route('student.index') }}" method="GET" class="d-flex justify-content-center gap-2">
                    <select name="course_id" id="course_id" class="form-control">
                        <option value="">All Courses</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course }}" {{ $selectedCourse == $course ? 'selected' : '' }}>
                                {{ strtoupper($course) }}
                            </option>
                        @endforeach
                    </select>
                    <input type="text" name="query" placeholder="🔍 Search" class="form-control"
                        value="{{ request()->input('query') }}">
                    <button type="submit" class="btn btn-primary">Filter/Search</button>
                </form>

                <!-- Print Button -->
                <button onclick="printTableOnly()" class="btn btn-secondary">Print Table</button>
            </div>

            <style>
                @media(max-width: 768px) {
                    table {
                        font-size: 10px;
                    }

                    .image {
                        display: none;
                    }
                }

                @media(min-width: 768px) {
                    table {
                        font-size: 14px;
                    }
                }

                /* Print-only styles */
                @media print {
                    body * {
                        visibility: hidden;
                    }

                    #printableTable,
                    #printableTable * {
                        visibility: visible;
                    }

                    #printableTable {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                    }

                    .image,
                    .action {
                        display: none !important;
                    }
                }
            </style>

            <div class="p-1 rounded-2 table-responsive-sm border border-black-subtle">
                <div id="printableTable">
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
                            @php $counter = $data->firstItem() ?? 1; @endphp
                            @if ($groupedData->isEmpty())
                                <tr>
                                    <td colspan="8" class="py-1">No results found</td>
                                </tr>
                            @else
                                @foreach ($groupedData as $course => $students)
                                    <tr class="bg-light">
                                        <td colspan="8" class="py-1 table-warning text-uppercase">
                                            {{ strtoupper($course) }}
                                        </td>
                                    </tr>

                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $student->student_id }}</td>
                                            <td>{{ $student->first_name }} {{ $student->middle_initial ?? '' }}
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
                                                    <img src="{{ asset('IMG/default.jpg') }}" alt="Default Image"
                                                        class="img-fluid"
                                                        style="border-radius: 50%; height:25px; width:25px;">
                                                @endif
                                            </td>
                                            <td class="action">
                                                <a href="{{ route('student.edit', $student->student_id) }}"
                                                    class="d-inline btn btn-success">
                                                    <i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $data->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        <script>
            function printTableOnly() {
                window.print();
            }
        </script>
    @endsection
</x-app-layout>
