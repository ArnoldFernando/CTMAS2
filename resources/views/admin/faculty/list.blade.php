<x-app-layout>


    @section('content_header')
        <h1>Faculty List</h1>
    @stop


    <div class="py-4">
        <div class="container">
            <div class="bg-white shadow-sm rounded overflow-auto" style="max-height: 24rem;">
                <div class="p-4 text-dark">
                    <div class="mb-4 text-dark">
                        <div class="d-flex justify-content-end">
                            <form action="{{ route('search.faculty') }}" method="GET" class="d-flex">
                                <input type="text" name="query" placeholder="Search..."
                                    class="form-control mr-2">
                                <button type="submit"
                                    class="btn btn-primary d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor" style="height: 1rem; width: 1rem;">
                                        <path fill-rule="evenodd"
                                            d="M13.293 14.707a1 1 0 0 1-1.414 1.414l-3-3a1 1 0 0 1 1.414-1.414l3 3z"
                                            clip-rule="evenodd" />
                                        <path fill-rule="evenodd"
                                            d="M12 10a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm-8 2a6 6 0 1 1 12 0 6 6 0 0 1-12 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="ml-1">Search</span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <table class="table table-striped mt-4">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th>ID</th>
                                <th>Faculty NAME</th>
                                <th>college</th>
                                <th>Image</th>
                                <th>Delete</th>
                                <th>Update</th>
                            </tr>
                        </thead>

                        @if (isset($results) && count($results) > 0)
                            <tbody class="text-center">
                                @foreach ($results as $faculty)
                                    <tr>
                                        <td>{{ $faculty['faculty_id'] }}</td>
                                        <td>{{ $faculty['name'] }}</td>
                                        <td>{{ $faculty['college'] }}</td>
                                        <td class="d-flex justify-content-center align-items-center">
                                            @if ($faculty->image)
                                                <img src="{{ asset('images/' . $faculty->image) }}"
                                                    alt="Student Photo" class="img-fluid" style="height: 3rem;">
                                            @else
                                                <p>No photo available</p>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ 'delete-faculty/' . $faculty['id'] }}"
                                                class="btn btn-danger">Delete</a>
                                        </td>
                                        <td>
                                            <a href="{{ 'edit-faculty/' . $faculty['id'] }}"
                                                class="btn btn-primary">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @elseif (!isset($results))
                            <tbody class="text-center">
                                @foreach ($Faculty_lists as $group => $Faculty_list)
                                    <tr class="bg-light">
                                        <td colspan="10" class="py-1">{{ $group }}</td>
                                    </tr>
                                    @foreach ($Faculty_list as $faculty)
                                        <tr>
                                            <td>{{ $faculty['faculty_id'] }}</td>
                                            <td>{{ $faculty['name'] }}</td>
                                            <td>{{ $faculty['college'] }}</td>
                                            <td class="d-flex justify-content-center align-items-center">
                                                @if ($faculty->image)
                                                    <img src="{{ asset('images/' . $faculty->image) }}"
                                                        alt="Student Photo" class="img-fluid" style="height: 3rem;">
                                                @else
                                                    <p>No photo available</p>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ 'delete-faculty/' . $faculty['id'] }}"
                                                    class="btn btn-danger">Delete</a>
                                            </td>
                                            <td>
                                                <a href="{{ 'edit-faculty/' . $faculty['id'] }}"
                                                    class="btn btn-primary">Update</a>
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
</x-app-layout>
