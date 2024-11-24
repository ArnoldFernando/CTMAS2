<x-app-layout>
    <div class="container font">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h1 class="mb-4">Insert Student List <small class="text-muted">(Excel file)</small></h1>

                        <!-- Success Message -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Error Message -->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="text-center p-2">
                            <img src="{{ asset('IMG/import-student.png') }}" alt="Import Student Format"
                                class="img-fluid mb-4 p-2 bg-success" style="height: 350px; width: 450px;">
                            <p class="text-muted mt-2">
                                PS. Ensure your Excel file matches the format shown above, with columns such as
                                <strong>student_id</strong>, <strong>first_name, middle_initial,
                                    last_name</strong>, and <strong>etc.</strong>.
                                Incorrect formatting may result in errors during the import process.
                            </p>
                        </div>



                        <form action="{{ route('import.student.data') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file" class="form-label">Choose Excel File</label>
                                <input type="file" required name="file" accept=".xls,.xlsx" class="form-control"
                                    id="file">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<style>
    body {
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }
</style>
