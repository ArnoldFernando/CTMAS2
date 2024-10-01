<x-app-layout>


    @section('content_header')
        <h1>update Faculty and Staff</h1>
    @stop

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
                    title: 'Data saved successfully!'
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
                    title: 'Faculty ID is Already Existing in System '
                })
            })()
        </script>
    @endif
    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('faculty.update', $faculty->faculty_id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="faculty_id" class="form-label">Faculty I.D</label>
                            <input type="text" name="faculty_id" placeholder="input Faculty I.D"
                                value="{{ $faculty->faculty_id }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="firstname" class="form-label">Faculty First Name</label>
                            <input type="text" name="first_name" placeholder="input faculty First Name"
                                value="{{ $faculty->first_name }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="Middle Initial" class="form-label">Faculty Middle Initial</label>
                            <input type="text" name="middle_initial" placeholder="input middle Initial"
                                value="{{ $faculty->middle_initial }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="Last Name" class="form-label">Faculty Last Name</label>
                            <input type="text" name="last_name" placeholder="{{ $faculty->last_name }}"
                                value="{{ $faculty->last_name }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="college_id" class="form-label">Faculty College</label>
                            <select name="college_id" id="college_id" class="form-control">
                                @foreach ($colleges as $college)
                                    <option value="{{ $college->college_id }}"
                                        style="background-color: {{ $college->bg_color }};"
                                        {{ $college->college_id === $faculty->college_id ? 'selected' : '' }}>
                                        {{ $college->college_id }} = {{ $college->college_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <span class="position-absolute end-0 top-50 translate-middle-y pe-3">
                                <i class="bi bi-caret-down-fill"></i>
                            </span>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Faculty Image</label>
                            <input type="file" name="image" placeholder="input faculty image"
                                value="{{ $faculty->image }}" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    /* Define custom background colors for colleges */
    .college-cbea {
        background-color: #F4CE14;
        color: #fff;
    }

    .college-ccje {
        background-color: #d9534f;
        color: #fff;
    }

    .college-chm {
        background-color: #FF4E88;
        color: #fff;
    }

    .college-cfas {
        background-color: #3795BD;
        color: #fff;
    }

    .college-cit {
        background-color: #1F316F;
        color: #fff;
    }

    .college-cics {
        background-color: #FF8343;
        color: #fff;
    }

    .college-cted {
        background-color: #5bc0de;
        color: #fff;
    }
</style>
