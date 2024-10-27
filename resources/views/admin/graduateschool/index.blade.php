<x-app-layout>

    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Graduate School List</h5>
    @stop

    @section('content')

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <x-existing-records-modal :records="session('existingRecords')" />

        <div class="container-fluid font">
            <div class="d-flex justify-content-end mb-2">
                <form action="{{ route('search.gradschool') }}" method="GET" class="d-flex">
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
                                    <th>GRADSCHOOL NAME</th>
                                    <th>COURSE</th>
                                    <th>IMAGE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            @if (isset($results) && count($results) > 0)
                                <tbody class="text-center">
                                    @foreach ($results as $gradschool)
                                        <tr>
                                            <td>{{ $gradschool->student_id }}</td>
                                            <td>{{ $gradschool->first_name }} {{ $gradschool->middle_initial }}
                                                {{ $gradschool->last_name }}</td>
                                            <td>{{ $gradschool->course_id }}</td>
                                            <td>
                                                @if ($gradschool->image)
                                                    <img src="{{ asset('student-images/' . $gradschool->image) }}"
                                                        alt="Gradschool Photo" class="img-fluid"
                                                        style="border-radius: 50%; height:25px; width:25px;">
                                                @else
                                                    {{--  <p class="py-0">No photo available</p>  --}}
                                                    <img src="{{ asset('IMG/default.jpg') }}" class="img-fluid"
                                                        alt="" style="border-radius: 50%; height:25px; width:25px;">
                                                @endif
                                            </td>
                                            <td>
                                                {{--  <a href="{{ 'delete/' . $gradschool['id'] }}"
                                                    class="d-inline btn btn-danger">Delete</a>  --}}
                                                <a href="{{ route('gradschool.edit', $gradschool->student_id) }}"
                                                    class="d-inline btn btn-primary">Update</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif (!isset($results))
                                <tbody class="text-center">
                                    @foreach ($GradSchool_lists as $group => $GradSchool_list)
                                        <tr class="bg-light">
                                            <td colspan="10" class="py-1 table-warning text-uppercase">
                                                {{ $group }}
                                            </td>
                                        </tr>
                                        @foreach ($GradSchool_list as $gradschool)
                                            <tr>
                                                <td>{{ $gradschool->student_id }}</td>
                                                <td>{{ $gradschool->first_name }} {{ $gradschool->middle_initial }}
                                                    {{ $gradschool->last_name }}</td>
                                                <td>{{ $gradschool->course_id }}</td>
                                                <td>
                                                    @if ($gradschool->image)
                                                        <img src="{{ asset('student-images/' . $gradschool->image) }}"
                                                            alt="Gradschool Photo" class="img-fluid"
                                                            style="border-radius: 50%; height:25px; width:25px;">
                                                    @else
                                                        {{--  <p class="py-0">No photo available</p>  --}}
                                                        <img src="{{ asset('IMG/default.jpg') }}" class="img-fluid"
                                                            alt=""
                                                            style="border-radius: 50%; height:25px; width:25px;">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{--  <a href="{{ 'delete-gradschool/' . $gradschool['id'] }}"
                                                        class="d-inline btn btn-danger">Delete</a>   --}}
                                                    <a href="{{ route('gradschool.edit', $gradschool->student_id) }}"
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
