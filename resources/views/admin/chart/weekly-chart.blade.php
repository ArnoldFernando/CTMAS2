<x-app-layout>
    <div class="container">
        <!-- Navigation for Month Selection -->

        <!-- Chart Section for Course Visits -->
        <div class="chart-section" id="courseVisitsSection">
            <h2 class="text-center mb-2">Weekly Course Visits</h2>
            <div class="card mb-3">
                <div class="card-body ">
                    <canvas id="libraryCoursesWeeklyChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart Section for College Visits -->
        <div class="chart-section" id="collegeVisitsSection" style="display: none;">
            <h2 class="text-center mb-3">Weekly College Visits</h2>
            <div class="card mb-3 ">
                <div class="card-body">
                    <canvas id="libraryCollegeWeeklyChart"></canvas>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-4">
            <button id="prevMonth" class="btn btn-outline-primary me-2">⬅️</button>
            <span id="currentMonthLabel" class="fs-4 fw-bold">Current Month</span>
            <button id="nextMonth" class="btn btn-outline-primary ms-2">➡️</button>
        </div>



        <!-- Button Group for Visits Toggle -->
        <div class="text-center mb-4">
            <div class="btn-group" role="group" aria-label="Visits toggle">
                <button id="courseVisitsBtn" class="btn btn-primary">Show Course Visits</button>
                <button id="collegeVisitsBtn" class="btn btn-secondary" style="display: none;">Show College
                    Visits</button>
            </div>
        </div>
    </div>

    <style>
        .card {
            width: 100%;
            max-width: 800px;
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
