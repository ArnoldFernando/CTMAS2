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

    .most,
    .least {
        background-color: #921A40;
        color: #fff;
    }
</style>

<h4 class="text-center fw-semibold font pb-4">Student Records</h4>



<div class="container-fluid">
    <!-- Stat boxes -->
    <div class="row text-center">
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $dailyCount->count }}</h3>
                    <p>Total Daily Record</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $weeklyCount->count }}</h3>
                    <p>Total Weekly Record</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $monthlyCount->count }}</h3>
                    <p>Total Monthly Record</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $yearlyCount->count }}</h3>
                    <p>Total Yearly Record</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid font">
    <div class="row">
        <!-- Daily Records Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card">
                <h5 class="card-header bg-info fw-bold font">Daily Records</h5>
                <div class="card-body {{ count($dailyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                    <ul class="list-group scroll-list" id="daily-records-list">
                        @foreach ($dailyStudentCounts as $dailyCount)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                • {{ $dailyCount->course_id }}
                                <span class="badge badge-danger badge-pill">{{ $dailyCount->count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Weekly Records Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card">
                <h5 class="card-header bg-success fw-bold font">Weekly Records</h5>
                <div class="card-body {{ count($weeklyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                    <ul class="list-group scroll-list" id="weekly-records-list">
                        @foreach ($weeklyStudentCounts as $weeklyCount)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                • {{ $weeklyCount->course_id }}
                                <span class="badge badge-danger badge-pill">{{ $weeklyCount->count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Monthly Records Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card">
                <h5 class="card-header bg-warning fw-bold font">Monthly Records</h5>
                <div class="card-body {{ count($monthlyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                    <ul class="list-group scroll-list" id="monthly-records-list">
                        @foreach ($monthlyStudentCounts as $monthlyCount)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                • {{ $monthlyCount->course_id }}
                                <span class="badge badge-danger badge-pill">{{ $monthlyCount->count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Yearly Records Card -->
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card">
                <h5 class="card-header bg-danger fw-bold font">Yearly Records</h5>
                <div class="card-body {{ count($yearlyStudentCounts) > 2 ? '' : 'no-scroll' }}">
                    <ul class="list-group scroll-list" id="yearly-records-list">
                        @foreach ($yearlyStudentCounts as $yearlyCount)
                            <li
                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                • {{ $yearlyCount->course_id }}
                                <span class="badge badge-danger badge-pill">{{ $yearlyCount->count }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid font">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card">
                <h5 class="card-header fw-bold most">Most Visited Course</h5>
                <div class="card-body">
                    @if ($mostVisitedCourse)
                        <p><b>{{ $mostVisitedCourse->course_id }}: </b>{{ $mostVisitedCourse->count }} visits
                        </p>
                    @else
                        <p>No visits recorded</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <div class="card">
                <h5 class="card-header fw-bold least">Least Visited Course</h5>
                <div class="card-body">
                    @if ($leastVisitedCourse)
                        <p><b>{{ $leastVisitedCourse->course_id }}: </b>{{ $leastVisitedCourse->count }}
                            visits</p>
                    @else
                        <p>No visits recorded</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
