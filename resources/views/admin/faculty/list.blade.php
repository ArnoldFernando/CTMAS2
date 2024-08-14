<x-app-layout>

    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Faculty List</h5>
    @stop

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

    <div class="container-fluid font bg-secondary bg-opacity-50 rounded-1 p-2">
        <div class="d-flex justify-content-end mb-2">
            <form action="{{ route('search.faculty') }}" method="GET" class="d-flex">
                <input type="text" name="query" placeholder="Search..." class="form-control mr-2">
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
                                <th>Faculty NAME</th>
                                <th>College</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @if (isset($results) && count($results) > 0)
                            <tbody class="text-center">
                                @foreach ($results as $faculty)
                                    <tr>
                                        <td>{{ $faculty['faculty_id'] }}</td>
                                        <td>{{ $faculty['name'] }}</td>
                                        <td>{{ $faculty['college'] }}</td>
                                        <td>
                                            @if ($faculty->image)
                                                <img src="{{ asset('faculty-images/' . $faculty->image) }}"
                                                    alt="Faculty Photo" class="img-fluid" style="height: 3rem;">
                                            @else
                                                <img src="{{ asset('IMG/default.jpg') }}" class="img-fluid"
                                                    alt="" style="border-radius: 50%; height:25px; width:25px;">
                                            @endif
                                        </td>
                                        <td>
                                            {{--  <a href="{{ 'delete-faculty/' . $faculty['id'] }}"
                                                class="d-inline btn btn-danger">Delete</a>   --}}
                                            <a href="{{ 'edit-faculty/' . $faculty['id'] }}"
                                                class="d-inline btn btn-primary">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        @elseif (!isset($results))
                            <tbody class="text-center">
                                @foreach ($Faculty_lists as $group => $Faculty_list)
                                    <tr class="bg-light">
                                        <td colspan="10" class="py-1 table-warning text-uppercase">
                                            {{ $group }}
                                        </td>
                                    </tr>
                                    @foreach ($Faculty_list as $faculty)
                                        <tr>
                                            <td>{{ $faculty['faculty_id'] }}</td>
                                            <td>{{ $faculty['name'] }}</td>
                                            <td>{{ $faculty['college'] }}</td>
                                            <td>
                                                @if ($faculty->image)
                                                    <img src="{{ asset('faculty-images/' . $faculty->image) }}"
                                                        alt="Faculty Photo" class="img-fluid" style="height: 1.5rem;">
                                                @else
                                                    <img src="{{ asset('IMG/default.jpg') }}" class="img-fluid"
                                                        alt="" style="border-radius: 50%; height:25px;">
                                                @endif
                                            </td>
                                            <td>
                                                {{--  <a href="{{ 'delete-faculty/' . $faculty['id'] }}"
                                                    class="d-inline btn btn-danger">Delete</a>   --}}
                                                <a href="{{ 'edit-faculty/' . $faculty['id'] }}"
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

</x-app-layout>
