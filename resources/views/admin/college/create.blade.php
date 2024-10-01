<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Add College</h5>
    @stop

    @section('content')
        @if (session('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
                (async () => {
                    await Toast.fire({
                        icon: 'success',
                        title: 'College added successfully!'
                    })
                })()
            </script>
        @endif

        @if (session('error'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 2500,
                    timerProgressBar: true,
                });
                (async () => {
                    await Toast.fire({
                        icon: 'warning',
                        title: 'College already exists!'
                    })
                })()
            </script>
        @endif

        <div class="py-4">
            <div class="container">
                <div class="row">
                    {{-- Form for adding new college --}}
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">Add College</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('store.college') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="college_id" class="form-label">College Acronym</label>
                                        <input type="text" required name="college_id" id="college_id"
                                            placeholder="Input College Acronym" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="college_name" class="form-label">College Name</label>
                                        <input type="text" required name="college_name" id="college_name"
                                            placeholder="Input College Name" class="form-control">
                                    </div>

                                    <div class="d-flex justify-content-start gap-2">
                                        <button type="submit" class="btn btn-primary px-5">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Existing Colleges List --}}
                    <div class="col-lg-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="mb-0">Existing Colleges</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>College Code</th>
                                            <th>College Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($colleges as $college)
                                            <tr>
                                                <td>{{ $college->college_id }}</td>
                                                <td>{{ $college->college_name }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="2" class="text-center">No colleges available</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
</x-app-layout>
