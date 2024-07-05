<x-app-layout>

    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Student List</h5>
    @stop

    @section('content')
        <div class="container-fluid font">
            <div class="d-flex justify-content-end mb-2">
                <form action="{{ route('search.student') }}" method="GET" class="d-flex">
                    <input type="text" name="query" placeholder="Search..." class="form-control mr-2">
                    <button type="submit" class="btn btn-primary d-flex align-items-center"><i
                            class="fa-solid fa-magnifying-glass me-2"></i>Search
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
                                    <th>IMAGE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            @if (isset($results) && count($results) > 0)
                                <tbody class="text-center">
                                    @foreach ($results as $student)
                                        <tr>
                                            <td>{{ $student['student_id'] }}</td>
                                            <td>{{ $student['name'] }}</td>
                                            <td>{{ $student['course'] }}</td>
                                            <td>{{ $student['college'] }}</td>
                                            <td>{{ $student['image'] }}</td>
                                            <td>
                                                <a href="{{ 'delete/' . $student['id'] }}"
                                                    class="d-inline btn btn-danger">Delete</a>
                                                <a href="{{ 'edit/' . $student['id'] }}"
                                                    class="d-inline btn btn-primary">Update</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif (!isset($results))
                                <tbody class="text-center">
                                    @foreach ($Student_lists as $group => $Student_list)
                                        <tr class="bg-light">
                                            <td colspan="10" class="py-1 table-warning text-uppercase">{{ $group }}
                                            </td>
                                        </tr>
                                        @foreach ($Student_list as $student)
                                            <tr>
                                                <td>{{ $student['student_id'] }}</td>
                                                <td>{{ $student['name'] }}</td>
                                                <td>{{ $student['course'] }}</td>
                                                <td>{{ $student['college'] }}</td>
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
                                                    <a href="{{ 'delete/' . $student['id'] }}"
                                                        class="d-inline btn btn-danger">Delete</a> <a
                                                        href="{{ 'edit/' . $student['id'] }}"
                                                        class="d-inline btn btn-primary">Update</a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            @else
                                <tbody class="text-center">
                                    <tr>
                                        <td colspan="6" class="py-1">No results found</td>
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
