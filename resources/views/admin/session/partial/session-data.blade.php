<div class="text-center">
    <img src="{{ asset($imagePath) }}" class="border border-1 border-secondary rounded-1"
        style="height: 180px; width: 180px;" alt="ID Picture">
</div>
<h5 class="fw-bold mb-3 text-center">{{ $typeLabel }}</h5>
<div class="row p-2">
    <div class="col-9">
        <h6 class="d-inline fw-bolder"><i class="fa-solid fa-caret-right me-1"></i>Name:</h6>
        <h6 class="d-inline">{{ $fname }} {{ $mname }} {{ $lname }}</h6>
        <br>
        <hr class="mt-0">
        <h6 class="d-inline fw-bolder mt-1"><i class="fa-solid fa-caret-right me-1"></i>Course:</h6>
        <h6 class="d-inline">{{ $course }}</h6><br>
        <hr class="mt-0">
        <h6 class="d-inline fw-bolder mt-1"><i class="fa-solid fa-caret-right me-1"></i>Department:</h6>
        <h6 class="d-inline">{{ $department }}</h6><br>
        <hr class="mt-0">
    </div>
    <div class="col-3 text-center">
        <h6 class="font mt-1">Time</h6>
        <h2 class="mt-2 fw-bolder" style="color: #A50002;">
            @if (session('currentTime'))
                {{ session('currentTime') }}
            @endif
        </h2>
    </div>
</div>
