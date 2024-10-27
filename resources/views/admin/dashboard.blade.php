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


        <section class="content font pt-4 student">
            <h4 class="text-center fw-semibold font pb-4">Student Records</h4>

            <div class="container-fluid">
                <div class="row text-center">
                    @php
                        $records = [
                            [
                                'count' => $dailyCount,
                                'label' => 'Total Daily Record',
                                'bg' => 'bg-info',
                                'icon' => 'ion-bag',
                            ],
                            [
                                'count' => $weeklyCount,
                                'label' => 'Total Weekly Record',
                                'bg' => 'bg-success',
                                'icon' => 'ion-stats-bars',
                            ],
                            [
                                'count' => $monthlyCount,
                                'label' => 'Total Monthly Record',
                                'bg' => 'bg-warning',
                                'icon' => 'ion-person-add',
                            ],
                            [
                                'count' => $yearlyCount,
                                'label' => 'Total Yearly Record',
                                'bg' => 'bg-danger',
                                'icon' => 'ion-pie-graph',
                            ],
                        ];
                    @endphp

                    @foreach ($records as $record)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                            <div class="small-box {{ $record['bg'] }}">
                                <div class="inner">
                                    <h3>{{ $record['count'] }}</h3>
                                    <p>{{ $record['label'] }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion {{ $record['icon'] }}"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container-fluid font">
                <div class="row">
                    @php
                        $timeframes = [
                            'Daily' => $dailyStudentCounts,
                            'Weekly' => $weeklyStudentCounts,
                            'Monthly' => $monthlyStudentCounts,
                            'Yearly' => $yearlyStudentCounts,
                        ];
                        $colors = ['info', 'success', 'warning', 'danger'];
                    @endphp

                    @foreach ($timeframes as $key => $counts)
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card">
                                <h5 class="card-header bg-{{ array_shift($colors) }} fw-bold font">{{ $key }}
                                    Records</h5>
                                <div class="card-body {{ count($counts) > 2 ? '' : 'no-scroll' }}">
                                    <ul class="list-group scroll-list" id="{{ strtolower($key) }}-records-list">
                                        @foreach ($counts as $count)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $count->course_id }}
                                                <span class="badge badge-danger badge-pill">{{ $count->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container-fluid font">
                <div class="row">
                    @foreach (['Most Visited Course' => $mostVisitedCourse, 'Least Visited Course' => $leastVisitedCourse] as $title => $course)
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card">
                                <h5 class="card-header most fw-bold {{ strtolower(str_replace(' ', '-', $title)) }}">
                                    {{ $title }}</h5>
                                <div class="card-body">
                                    @if ($course)
                                        <p><b>{{ $course->course_id }}: </b>{{ $course->count }} visits</p>
                                    @else
                                        <p>No visits recorded</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>



        <section class="content font pt-4 faculty">
            <h4 class="text-center fw-semibold font pb-4">Faculty Records</h4>

            <div class="container-fluid">
                <div class="row text-center">
                    @php
                        $faculty_records = [
                            [
                                'count' => $facultydailyCount,
                                'label' => 'Total Daily Record',
                                'bg' => 'bg-info',
                                'icon' => 'ion-bag',
                            ],
                            [
                                'count' => $facultyweeklyCount,
                                'label' => 'Total Weekly Record',
                                'bg' => 'bg-success',
                                'icon' => 'ion-stats-bars',
                            ],
                            [
                                'count' => $facultymonthlyCount,
                                'label' => 'Total Monthly Record',
                                'bg' => 'bg-warning',
                                'icon' => 'ion-person-add',
                            ],
                            [
                                'count' => $facultyyearlyCount,
                                'label' => 'Total Yearly Record',
                                'bg' => 'bg-danger',
                                'icon' => 'ion-pie-graph',
                            ],
                        ];
                    @endphp

                    @foreach ($faculty_records as $record)
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                            <div class="small-box {{ $record['bg'] }}">
                                <div class="inner">
                                    <h3>{{ $record['count'] }}</h3>
                                    <p>{{ $record['label'] }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion {{ $record['icon'] }}"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container-fluid font">
                <div class="row">
                    @php
                        $faculty_timeframes = [
                            'Daily' => $dailyFacultyCounts,
                            'Weekly' => $weeklyFacultyCounts,
                            'Monthly' => $monthlyFacultyCounts,
                            'Yearly' => $yearlyFacultyCounts,
                        ];
                        $colors = ['info', 'success', 'warning', 'danger'];
                    @endphp

                    @foreach ($faculty_timeframes as $key => $counts)
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card">
                                <h5 class="card-header bg-{{ array_shift($colors) }} fw-bold font">{{ $key }}
                                    Records</h5>
                                <div class="card-body {{ count($counts) > 2 ? '' : 'no-scroll' }}">
                                    <ul class="list-group scroll-list" id="{{ strtolower($key) }}-records-list">
                                        @foreach ($counts as $count)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $count->college_id }}
                                                <span class="badge badge-danger badge-pill">{{ $count->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container-fluid font">
                <div class="row">
                    @foreach (['Most Visited Course' => $mostVisitedCollege, 'Least Visited Course' => $leastVisitedCollege] as $title => $college)
                        <div class="col-lg-3 col-md-6 col-12 mb-3">
                            <div class="card">
                                <h5 class="card-header most fw-bold {{ strtolower(str_replace(' ', '-', $title)) }}">
                                    {{ $title }}</h5>
                                <div class="card-body">
                                    @if ($college)
                                        <p><b>{{ $college->college_id }}: </b>{{ $college->count }} visits</p>
                                    @else
                                        <p>No visits recorded</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>


        {{--  <section class="content font faculty p-4 border border-1">
            <h4 class="text-center fw-semibold font pb-4">Faculty Records</h4>
            <div class="container-fluid">
                <!-- Stat Boxes Row -->
                <div class="row">
                    @foreach ([['info', $facultydailyCount, 'Total Daily Record', 'ion-bag'], ['success', $facultyweeklyCount, 'Total Weekly Record', 'ion-stats-bars'], ['warning', $facultymonthlyCount, 'Total Monthly Record', 'ion-person-add'], ['danger', $facultyyearlyCount, 'Total Yearly Record', 'ion-pie-graph']] as $box)
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-{{ $box[0] }}">
                                <div class="inner">
                                    <h3>{{ $box[1] }}</h3>
                                    <p>{{ $box[2] }}</p>
                                </div>
                                <div class="icon">
                                    <i class="ion {{ $box[3] }}"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Detailed Records Section -->
            <div class="container-fluid">
                <div class="row">
                    @foreach ([['Daily', 'info', $dailyFacultyCounts], ['Weekly', 'success', $weeklyFacultyCounts], ['Monthly', 'warning', $monthlyFacultyCounts], ['Yearly', 'danger', $yearlyFacultyCounts]] as $record)
                        <div class="col-md-3">
                            <div class="card">
                                <h5 class="card-header bg-{{ $record[1] }} fw-bold font">{{ $record[0] }} Records
                                </h5>
                                <div class="card-body {{ count($record[2]) > 2 ? '' : 'no-scroll' }}">
                                    <ul class="list-group scroll-list">
                                        @foreach ($record[2] as $count)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                • {{ $count->college ?? 'No College' }}
                                                <span class="badge badge-primary badge-pill">{{ $count->count }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if (count($record[2]) > 2)
                                        <!-- Clone for scrolling (if applicable) -->
                                        <ul class="list-group scroll-list">
                                            @foreach ($record[2] as $count)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center bg-secondary bg-opacity-50 text-black mb-1">
                                                    • {{ $count->college ?? 'No College' }}
                                                    <span class="badge badge-primary badge-pill">{{ $count->count }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="container">
                <div class="row font">
                    <div class="col-3"></div>
                    <div class="col-lg-3">
                        <div class="card">
                            <h5 class="card-header fw-bold most">Most Visited Course</h5>
                            <div class="card-body">
                                @if ($mostVisitedCollege)
                                    <p><b>{{ $mostVisitedCollege->college ?? 'No College' }}:</b>
                                        {{ $mostVisitedCollege->count }} visits</p>
                                @else
                                    <p>No visits recorded</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <h5 class="card-header fw-bold least">Least Visited Course</h5>
                            <div class="card-body">
                                @if ($leastVisitedCollege)
                                    <p><b>{{ $leastVisitedCollege->college ?? 'No College' }}:</b>
                                        {{ $leastVisitedCollege->count }} visits</p>
                                @else
                                    <p>No visits recorded</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
        </section>  --}}



    @stop
</x-app-layout>
