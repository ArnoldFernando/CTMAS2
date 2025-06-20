<x-app-layout>
    <div class="container">


        <!-- Chart Section for Course Visits -->
        <div class="chart-section border border-black-subtle p-2 " id="courseVisitsSection">
            <div class="d-flex justify-content-between">
                <h3 class="text-start mb-2 p-2 border-bottom fw-normal">Weekly Visits</h3>
                <div class="d-flex align-items-center">
                    <button id="collegeVisitsBtn" class="btn btn-secondary" tyle="display: none;">Show College</button>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-body ">
                    <canvas id="libraryCoursesWeeklyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart Section for College Visits -->
        <div class="chart-section border border-black-subtle p-2 " id="collegeVisitsSection" style="display: none;">
            <div class="d-flex justify-content-between">
                <h3 class="text-start mb-2 p-2 border-bottom fw-normal">Weekly Visits</h3>
                <div class="d-flex align-items-center">
                    <button id="courseVisitsBtn" class="btn btn-primary">Show Course</button>
                </div>
            </div>

            <div class="card mb-3 ">
                <div class="card-body">
                    <canvas id="libraryCollegeWeeklyChart"></canvas>
                </div>
            </div>
        </div>

        <div class="">
            <div class="d-flex justify-content-center mb-4 mt-2">
                <button id="prevYear" class="btn btn-outline-primary me-2">⬅️ Year</button>
                <button id="prevMonth" class="btn btn-outline-primary me-2">⬅️ Month</button>
                <span id="currentMonthLabel" class="fs-4 fw-bold">Current Month Year</span>
                <button id="nextMonth" class="btn btn-outline-primary ms-2">➡️ Month</button>
                <button id="nextYear" class="btn btn-outline-primary ms-2">➡️ Year</button>
            </div>

            <!-- Button Group for Visits Toggle -->

        </div>

    </div>

    <style>
        .card {
            width: 100%;
            max-width: 1200px;
            height: 400px;
            margin: auto;
        }
    </style>

    <!-- Include jQuery and Chart.js libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include the chart handler script -->
    <script src="{{ asset('js/chart/weekly-chart.js') }}"></script>

</x-app-layout>
