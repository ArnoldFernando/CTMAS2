<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Add Faculty</h5>
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
                        title: 'Faculty data saved successfully!'
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
                        title: 'Faculty ID already exists in the system!'
                    })
                })()
            </script>
        @endif

        <div class="py-2 font">
            <div class="container">
                <div class="bg-secondary bg-opacity-25 shadow-sm rounded d-flex overflow-hidden">
                    <div class="p-4 text-dark flex-fill">
                        <form action="{{ route('faculty.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Faculty ID -->
                            <div class="mb-3">
                                <label for="faculty_id" class="form-label">Faculty I.D</label>
                                <input type="text" required name="faculty_id" id="faculty_id"
                                    placeholder="Input Faculty I.D" class="form-control">
                                @error('faculty_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- First Name -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" required name="first_name" id="first_name"
                                    placeholder="Input First Name" class="form-control">
                                @error('first_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="middle_initial" class="form-label">Middle Initial</label>
                                <input type="text" name="middle_initial" id="middle_initial"
                                    placeholder="Input Middle Initial" class="form-control">
                                @error('middle_initial')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Last Name -->
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" required name="last_name" id="last_name" placeholder="Input Last Name"
                                    class="form-control">
                                @error('last_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="college_id" class="form-label">Faculty College</label>
                                <select required name="college_id" id="college_id" class="form-control">
                                    <option value="" disabled selected>Select College</option>
                                    @foreach ($colleges as $college)
                                        <option value="{{ $college->college_id }}" {{--  style="background-color: {{ $college->bg_color }};">  --}}
                                            style="color: black;">
                                            {{ $college->college_id }} = {{ $college->college_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('college_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                    <i class="bi bi-caret-down-fill"></i>
                                </span>
                            </div>

                            <!-- Faculty Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Faculty Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                @error('image')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-start gap-2">
                                <button type="submit" class="btn btn-primary px-5">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="flex-fill p-2 d-flex align-items-center justify-content-center">
                        <img class="img-fluid w-50" src="{{ asset('IMG/teacher-2.png') }}" alt="CSU LOGO">
                    </div>
                </div>
            </div>
        </div>
    @stop
</x-app-layout>
