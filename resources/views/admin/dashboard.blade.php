<x-app-layout>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Student Records Count</h1>

        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Daily Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($dailyStudentCounts as $dailyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $dailyCount->course }}
                                    <span class="badge badge-primary badge-pill">{{ $dailyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Weekly Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($weeklyStudentCounts as $weeklyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $weeklyCount->course }}
                                    <span class="badge badge-primary badge-pill">{{ $weeklyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Monthly Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($monthlyStudentCounts as $monthlyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $monthlyCount->course }}
                                    <span class="badge badge-primary badge-pill">{{ $monthlyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Yearly Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($yearlyStudentCounts as $yearlyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $yearlyCount->course }}
                                    <span class="badge badge-primary badge-pill">{{ $yearlyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Most Visited Course</h2>
                    </div>
                    <div class="card-body">
                        @if ($mostVisitedCourse)
                            <p>{{ $mostVisitedCourse->course }}: {{ $mostVisitedCourse->count }} visits</p>
                        @else
                            <p>No visits recorded</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Least Visited Course</h2>
                    </div>
                    <div class="card-body">
                        @if ($leastVisitedCourse)
                            <p>{{ $leastVisitedCourse->course }}: {{ $leastVisitedCourse->count }} visits</p>
                        @else
                            <p>No visits recorded</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h1 class="mb-4 text-center">Faculty Records Count</h1>

        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Daily Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($dailyFacultyCounts as $dailyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $dailyCount->college ?? 'No College' }}
                                    <span class="badge badge-primary badge-pill">{{ $dailyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Weekly Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($weeklyFacultyCounts as $weeklyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $weeklyCount->college ?? 'No College' }}
                                    <span class="badge badge-primary badge-pill">{{ $weeklyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Monthly Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($monthlyFacultyCounts as $monthlyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $monthlyCount->college ?? 'No College' }}
                                    <span class="badge badge-primary badge-pill">{{ $monthlyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Yearly Records Count</h2>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($yearlyFacultyCounts as $yearlyCount)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $yearlyCount->college ?? 'No College' }}
                                    <span class="badge badge-primary badge-pill">{{ $yearlyCount->count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Most Visited College</h2>
                    </div>
                    <div class="card-body">
                        @if ($mostVisitedCollege)
                            <p>{{ $mostVisitedCollege->college ?? 'No College' }}: {{ $mostVisitedCollege->count }} visits</p>
                        @else
                            <p>No visits recorded</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="h5">Least Visited College</h2>
                    </div>
                    <div class="card-body">
                        @if ($leastVisitedCollege)
                            <p>{{ $leastVisitedCollege->college ?? 'No College' }}: {{ $leastVisitedCollege->count }} visits</p>
                        @else
                            <p>No visits recorded</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
