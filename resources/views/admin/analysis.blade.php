<x-app-layout>
    @section('content')
        <div class="container-fluid h-100">
            <h1>Attendance Analysis</h1>
            <div class="row h-100">
                <div class="col-md-6 overflow-auto">
                    <form action="{{ route('analysis.result') }}" method="GET">
                        <div class="form-group">
                            <label for="college">Select College:</label>
                            <select name="college" id="college" class="form-control">
                                <option value="">All Colleges</option>
                                @foreach ($colleges as $college)
                                    <option value="{{ $college }}">{{ $college }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="course">Select Course:</label>
                            <select name="course" id="course" class="form-control">
                                <option value="">All Courses</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course }}">{{ $course }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Student Name:</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Enter student name">
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Get Analysis</button>
                    </form>
                </div>

                <div class="col-md-6 overflow-auto">
                    @if ($totalAttendance !== null)
                        <h2>Analysis Results</h2>
                        <p>Total Attendance: {{ $totalAttendance }}</p>
                        <p>Average Attendance Time: {{ $averageTime }} minutes</p>
                        <p>Daily Attendance: {{ $dailyAttendance }}</p>
                        <p>Weekly Attendance: {{ $weeklyAttendance }}</p>
                        <p>Monthly Attendance: {{ $monthlyAttendance }}</p>

                        <h3>Attendance by Course</h3>
                        <ul>
                            @foreach ($attendanceByCourse as $course => $count)
                                <li>{{ $course }}: {{ $count }}</li>
                            @endforeach
                        </ul>

                        <h3>Attendance by College</h3>
                        <ul>
                            @foreach ($attendanceByCollege as $college => $count)
                                <li>{{ $college }}: {{ $count }}</li>
                            @endforeach
                        </ul>

                        <h3>Peak Check-In/Check-Out Times</h3>
                        @if ($peakCheckInTime)
                            <p>Peak Check-In Time: {{ $peakCheckInTime->hour_in }}:00 ({{ $peakCheckInTime->count }}
                                check-ins)
                            </p>
                        @endif
                        @if ($peakCheckOutTime)
                            <p>Peak Check-Out Time: {{ $peakCheckOutTime->hour_out }}:00 ({{ $peakCheckOutTime->count }}
                                check-outs)</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>

<style>
    html,
    body {
        height: 100%;
        margin: 0;
    }

    .container-fluid {
        height: 100%;
    }

    .overflow-auto {
        overflow: auto;
    }
</style>
