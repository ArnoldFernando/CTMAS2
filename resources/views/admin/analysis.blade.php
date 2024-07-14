<x-app-layout>




    @section('content')
        <div class="container">
            <h1>Attendance Analysis</h1>
            <form action="{{ route('analysis.result') }}" method="GET">
                <div class="form-group">
                    <label for="college">Select College:</label>
                    <select name="college" id="college" class="form-control">
                        <option value="">All Colleges</option>
                        @foreach ($colleges as $college)
                            <option value="{{ $college->college }}">{{ $college->college }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="course">Select Course:</label>
                    <select name="course" id="course" class="form-control">
                        <option value="">All Courses</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->course }}">{{ $course->course }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Student Name:</label>
                    <input type="text" name="name" id="name" class="form-control"
                        placeholder="Enter student name">
                </div>
                <button type="submit" class="btn btn-primary">Get Analysis</button>
            </form>

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
                    <p>Peak Check-In Time: {{ $peakCheckInTime->hour_in }}:00 ({{ $peakCheckInTime->count }} check-ins)
                    </p>
                @endif
                @if ($peakCheckOutTime)
                    <p>Peak Check-Out Time: {{ $peakCheckOutTime->hour_out }}:00 ({{ $peakCheckOutTime->count }}
                        check-outs)</p>
                @endif
            @endif
        </div>
    @endsection

</x-app-layout>
