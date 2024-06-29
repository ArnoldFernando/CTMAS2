<x-app-layout>


    @section('content_header')
        <h1>Add faculty</h1>
    @stop


    <div class="py-2">
        <div class="container">
            <div class="bg-white shadow-sm rounded d-flex overflow-hidden">
                <div class="p-4 text-dark flex-fill">
                    <form action="{{ route('add.faculty') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="faculty_id" class="form-label">faculty I.D</label>
                            <input type="text" required name="faculty_id" id="faculty_id"
                                placeholder="input faculty I.D" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">faculty Name</label>
                            <input type="text" required name="name" id="name"
                                placeholder="input faculty name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="college" class="form-label">faculty college</label>
                            <input type="text" required name="college" id="college"
                                placeholder="input faculty college" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">faculty Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>

                        <div class="d-flex justify-content-start gap-2">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>

                    @if (session('failure'))
                        <div class="alert alert-danger mt-3">
                            {{ session('failure') }}
                        </div>
                    @elseif (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif

                </div>
                <div class="flex-fill p-2 d-flex align-items-center justify-content-center">
                    <img class="img-fluid w-50"
                        src="data:image/jpeg;base64,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"
                        alt="">
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
