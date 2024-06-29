<x-app-layout>


    @section('content_header')
        <h1>update Faculty and Staff</h1>
    @stop

    <div class="py-4">
        <div class="container">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form action="{{ route('update.faculty') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" placeholder="input faculty I.D"
                            value="{{ $Faculty_and_staff['id'] }}" class="form-control">

                        <div class="mb-3">
                            <label for="faculty_id" class="form-label">Faculty I.D</label>
                            <input type="text" name="faculty_id" placeholder="input faculty I.D"
                                value="{{ $Faculty_and_staff['faculty_id'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Faculty Name</label>
                            <input type="text" name="name" placeholder="input faculty name"
                                value="{{ $Faculty_and_staff['name'] }}" class="form-control">
                        </div>


                        <div class="mb-3">
                            <label for="college" class="form-label">Faculty college</label>
                            <input type="text" name="college" placeholder="input faculty college"
                                value="{{ $Faculty_and_staff['faculty_id'] }}" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Faculty Image</label>
                            <input type="file" name="image" placeholder="input faculty image"
                                value="{{ $Faculty_and_staff['image'] }}" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                    @if (session('success'))
                        <div id="success-message" class="alert alert-success mt-3">
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
