<x-app-layout>
    @section('content')
        <style>
            .card-body {
                position: relative;
                height: 120px;
                overflow: hidden;
            }

            .scroll-list {
                display: flex;
                flex-direction: column;
                margin: 0;
                padding: 0;
                list-style: none;
                animation: scroll 20s linear infinite;
            }

            .card-body.no-scroll .scroll-list {
                animation: none;
            }

            .card-body:hover .scroll-list {
                animation-play-state: paused;
            }

            @keyframes scroll {
                0% {
                    transform: translateY(0);
                }

                100% {
                    transform: translateY(-100%);
                }
            }

            .list-group-item {
                height: 45px;
            }

            .student {
                height: 100vh;
            }

            .faculty {
                height: 100vh;
                padding-top: 1em;
            }

            .faculty h4 {
                padding-top: 2em;
            }

            .space {
                height: 10vh;
            }
        </style>
        <section class="content font p-4 border border-1 student">
            <h4 class="text-center fw-semibold font">Student Records</h4>

            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
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
                        <div class="small-box bg-success">
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
                        <div class="small-box bg-warning">
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
                        <div class="small-box bg-danger">
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
            </div><!-- /.container-fluid -->


            {{--  <hr class="mb-1">  --}}
            <div class="container-fluid mt-0 font p-4">
                {{--  <h4 class="text-center fw-semibold font">Student Records</h4>  --}}
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-info fw-bold font">Daily Records</h5>
                            <div class="card-body {{ count($dailyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="daily-records-list">
                                    @foreach ($dailyStudentCounts as $dailyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $dailyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $dailyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- Clone the list for infinite scrolling -->
                                @if (count($dailyStudentCounts) > 2)
                                    <ul class="list-group scroll-list" id="daily-records-list-clone">
                                        @foreach ($dailyStudentCounts as $dailyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $dailyCount->course }}
                                                <span class="badge badge-danger badge-pill">{{ $dailyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-success fw-bold font">Weekly Records</h5>
                            <div class="card-body {{ count($weeklyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="weekly-records-list">
                                    @foreach ($weeklyStudentCounts as $weeklyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $weeklyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $weeklyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($weeklyStudentCounts) > 2)
                                    <ul class="list-group scroll-list" id="weekly-records-list-clone">
                                        @foreach ($weeklyStudentCounts as $weeklyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $weeklyCount->course }}
                                                <span
                                                    class="badge badge-danger badge-pill">{{ $weeklyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-warning fw-bold font">Monthly Records</h5>
                            <div class="card-body {{ count($monthlyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="monthly-records-list">
                                    @foreach ($monthlyStudentCounts as $monthlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $monthlyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $monthlyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($monthlyStudentCounts) > 2)
                                    <ul class="list-group scroll-list" id="monthly-records-list-clone">
                                        @foreach ($monthlyStudentCounts as $monthlyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $monthlyCount->course }}
                                                <span
                                                    class="badge badge-danger badge-pill">{{ $monthlyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-danger fw-bold font">Yearly Records</h5>
                            <div class="card-body {{ count($yearlyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="yearly-records-list">
                                    @foreach ($yearlyStudentCounts as $yearlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $yearlyCount->course }}
                                            <span class="badge badge-danger badge-pill">{{ $yearlyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($yearlyStudentCounts) > 2)
                                    <ul class="list-group scroll-list" id="yearly-records-list-clone">
                                        @foreach ($yearlyStudentCounts as $yearlyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $yearlyCount->course }}
                                                <span
                                                    class="badge badge-danger badge-pill">{{ $yearlyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{--  <hr class="mt-0">  --}}
            <div class="container-fluid mt-0 font">
                {{-- MOST VISITED COURSE --}}
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <div class="card">
                            <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Most Visited Course
                            </h5>
                            <div class="card-body">
                                @if ($mostVisitedCourse)
                                    <p><b>{{ $mostVisitedCourse->course }}: </b>{{ $mostVisitedCourse->count }} visits
                                    </p>
                                @else
                                    <p>No visits recorded</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Least Visited Course
                            </h5>
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
        </section>

        {{-- FACULTY RECORD --}}
        <section class="content font faculty p-4 border border-1 ">
            <h4 class="text-center fw-semibold font">Faculty Records</h4>
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
            {{--  <hr class="mb-1">  --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-info fw-bold font">Daily Records</h5>
                            <div class="card-body {{ count($dailyFacultyCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="daily-record-list">
                                    @foreach ($dailyFacultyCounts as $dailyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $dailyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $dailyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($dailyFacultyCounts) > 2)
                                    <ul class="list-group scroll-list" id="daily-record-list-clone">
                                        @foreach ($dailyFacultyCounts as $dailyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $dailyCount->college ?? 'No College' }}
                                                <span
                                                    class="badge badge-primary badge-pill">{{ $dailyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-success fw-bold font">Weekly Records</h5>
                            <div class="card-body {{ count($weeklyFacultyCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="weekly-record-list">
                                    @foreach ($weeklyFacultyCounts as $weeklyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $weeklyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $weeklyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($weeklyFacultyCounts) > 2)
                                    <ul class="list-group scroll-list" id="weekly-record-list-clone">
                                        @foreach ($weeklyFacultyCounts as $weeklyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $weeklyCount->college ?? 'No College' }}
                                                <span
                                                    class="badge badge-primary badge-pill">{{ $weeklyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-warning fw-bold font">Monthly Records</h5>
                            <div class="card-body {{ count($monthlyFacultyCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="monthly-record-list">
                                    @foreach ($monthlyFacultyCounts as $monthlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $monthlyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $monthlyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($monthlyFacultyCounts) > 2)
                                    <ul class="list-group scroll-list" id="monthly-record-list-clone">
                                        @foreach ($monthlyFacultyCounts as $monthlyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $monthlyCount->college ?? 'No College' }}
                                                <span
                                                    class="badge badge-primary badge-pill">{{ $monthlyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <h5 class="card-header bg-danger fw-bold font">Yearly Records</h5>
                            <div class="card-body {{ count($yearlyFacultyCounts) > 2 ? '' : 'no-scroll' }}">
                                <ul class="list-group scroll-list" id="yearly-record-list">
                                    @foreach ($yearlyFacultyCounts as $yearlyCount)
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                            • {{ $yearlyCount->college ?? 'No College' }}
                                            <span class="badge badge-primary badge-pill">{{ $yearlyCount->count }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                @if (count($yearlyFacultyCounts) > 2)
                                    <ul class="list-group scroll-list" id="yearly-record-list-clone">
                                        @foreach ($yearlyFacultyCounts as $yearlyCount)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $yearlyCount->college ?? 'No College' }}
                                                <span
                                                    class="badge badge-primary badge-pill">{{ $yearlyCount->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                {{--  <hr class="mt-0">  --}}
                <div class="row font">
                    <div class="col-3"></div>
                    <div class="col-3">
                        <div class="card">
                            <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Most Visited
                                Course</h5>
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
                    <div class="col-3">
                        <div class="card">
                            <h5 class="card-header fw-bold bg-secondary bg-opacity-50 text-black">Least Visited
                                Course</h5>
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
                    <div class="col-3"></div>
                </div>
            </div>
        </section>
    @stop
</x-app-layout>
