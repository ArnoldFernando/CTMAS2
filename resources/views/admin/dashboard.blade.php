<x-app-layout>
    @section('css')
        {{-- Boostrap CDN --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            .card-body {
                position: relative;
                height: 150px;
                /* Adjust as needed */
                overflow: hidden;
            }

            .list-group {
                position: absolute;
                top: 0;
                width: 100%;
                transition: top 1s linear;
            }

            .list-group-item {
                display: block;
            }
        </style>
    @stop
    @section('content_header')
        <h5 class="fw-bold font"><i class="fa-solid fa-caret-right me-2 text-primary"></i>Dashboard</h5>
    @stop

    @section('content')
        <div class="border border-black border-1 rounded-3 mb-3">
            <section class="content font">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <h4 class="text-center fw-semibold mt-2">Student Records</h6>
                        <hr class="mt-0">
                        <div class="row">
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color: #96C9F4; height:100px;">
                                    <div class="inner">
                                        <h3> {{ $dailyCount }}</h3 <p>Total Daily Record</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-bag"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->
                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box" style="background-color: #9CDBA6; height:100px;">
                                    <div class="inner">
                                        <h3> {{ $weeklyCount }}</h3>
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
                                <div class="small-box" style="background-color:#FFF67E;height:100px;">
                                    <div class="inner">
                                        <h3> {{ $monthlyCount }}</h3>

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
                                <div class="small-box" style="background-color: #FF6D60; height:100px;">
                                    <div class="inner">
                                        <h3> {{ $yearlyCount }}</h3>

                                        <p>Total Yearly Record</p>
                                    </div>
                                    <div class="icon">
                                        <i class="ion ion-pie-graph"></i>
                                    </div>

                                </div>
                            </div>
                            <!-- ./col -->
                        </div>
                </div>
            </section>
            {{-- <hr class="mb-1"> --}}
            <div class="container-fluid mt-0 font p-0">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-info text-white fw-bold">Daily Records</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($dailyStudentCounts as $dailyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $dailyCount->course }}
                                            <span class="badge bg-danger">{{ $dailyCount->count }}</span>
                                        </li>
                                    @endforeach
                                    @foreach ($dailyStudentCounts as $dailyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $dailyCount->course }}
                                            <span class="badge bg-danger">{{ $dailyCount->count }}</span>
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
                {{-- <hr class="mt-0"> --}}
            </div>
            {{-- MOST VISITED COURSE --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Most Visited Course</h5>
                        <div class="card-body">
                            @if ($mostVisitedCourse)
                                <p><b>{{ $mostVisitedCourse->course }}: </b>{{ $mostVisitedCourse->count }} visits</p>
                            @else
                                <p>No visits recorded</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Least Visited Course</h5>
                        <div class="card-body">
                            @if ($leastVisitedCourse)
                                <p><b>{{ $leastVisitedCourse->course }}: </b>{{ $leastVisitedCourse->count }}
                                    Visits</p>
                            @else
                                <p>No visit recorded</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FACULTY RECORD --}}
        <section class="content font">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $facultydailyCount }}</h3>

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
                                <h3>{{ $facultyweeklyCount }}</h3>

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
                                <h3>{{ $facultymonthlyCount }}</h3>

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
                                <h3>{{ $facultyyearlyCount }}</h3>

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
        <div class="container-fluid">
            <h4 class="text-center fw-semibold font">Faculty Records</h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-info fw-bold font">Daily Records</h5>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($dailyFacultyCounts as $dailyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $dailyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $dailyCount->count }}</span>
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
                                    @foreach ($weeklyFacultyCounts as $weeklyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $weeklyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $weeklyCount->count }}</span>
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
                                    @foreach ($monthlyFacultyCounts as $monthlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $monthlyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $monthlyCount->count }}</span>
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
                                    @foreach ($yearlyFacultyCounts as $yearlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $yearlyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $yearlyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="row mt-5 mb-5 font">
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Most Visited Course</h5>
                            <div class="card-body">
                                @if ($mostVisitedCollege)
                                    <p><b>{{ $mostVisitedCollege->college ?? 'No College' }}:</b>
                                        {{ $mostVisitedCollege->count }}
                                        visits</p>
                                @else
                                    <p>No visits recorded</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Least Visited Course</h5>
                            <div class="card-body">
                                @if ($leastVisitedCollege)
                                    <p><b>{{ $leastVisitedCollege->college ?? 'No College' }}:</b>
                                        {{ $leastVisitedCollege->count }}
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

    @section('js')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function() {
                const $listGroup = $('.list-group');
                const itemHeight = $('.list-group-item').outerHeight(true);
                const itemsToShow = 2;
                const scrollHeight = itemHeight * itemsToShow;
                let currentIndex = 0;

                function autoScroll() {
                    currentIndex++;
                    const maxIndex = $('.list-group-item').length / 2;

                    if (currentIndex > maxIndex) {
                        currentIndex = 1;
                        $listGroup.css('transition', 'none');
                        $listGroup.css('top', '0'); // Reset to the top immediately
                        setTimeout(() => {
                            $listGroup.css('transition', 'top 1s linear');
                            $listGroup.css('top', -itemHeight + 'px'); // Move to the next item smoothly
                        }, 50);
                    } else {
                        const newTop = -currentIndex * itemHeight;
                        $listGroup.css('top', newTop + 'px'); // Animate to the new position
                    }
                }

                // Initial scroll to display the first set of items
                $listGroup.css('top', '0');

                // Set interval for auto-scrolling
                setInterval(autoScroll, 3000); // Adjust time interval as needed
            });
        </script>
    </x-app-layout>
