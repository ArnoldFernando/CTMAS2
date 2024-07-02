<x-app-layout>
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Dashboard</h5>
    @stop

    @section('content')
        <section class="content font">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Total Daily Record</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>53</h3>

                                <p>Total Weekly Record</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>44</h3>

                                <p>Total Monthly Record</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>65</h3>

                                <p>Total Yearly Record</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>

                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <hr class="mb-1">
        <div class="container-fluid mt-0 font p-0">
            <h4 class="text-center fw-semibold font">Student Records</h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-info fw-bold font">Daily Records</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($dailyStudentCounts as $dailyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $dailyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $dailyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-success fw-bold font">Weekly Records</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($weeklyStudentCounts as $weeklyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $weeklyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $weeklyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-warning fw-bold font">Monthly Records</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($monthlyStudentCounts as $monthlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $monthlyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $monthlyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-danger fw-bold font">Yearly Records</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($yearlyStudentCounts as $yearlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $yearlyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $yearlyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="card">
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
                        <div class="card">
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
            <h1 class=text-center">Faculty Records Count</h1>

            <div class="row">
                <div class="col-md-3">
                    <div class="card">
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
                    <div class="card">
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
                    <div class="card">
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
                    <div class="card">
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
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5">Most Visited College</h2>
                        </div>
                        <div class="card-body">
                            @if ($mostVisitedCollege)
                                <p>{{ $mostVisitedCollege->college ?? 'No College' }}: {{ $mostVisitedCollege->count }}
                                    visits</p>
                            @else
                                <p>No visits recorded</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5">Least Visited College</h2>
                        </div>
                        <div class="card-body">
                            @if ($leastVisitedCollege)
                                <p>{{ $leastVisitedCollege->college ?? 'No College' }}: {{ $leastVisitedCollege->count }}
                                    visits</p>
                            @else
                                <p>No visits recorded</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop
</x-app-layout>
