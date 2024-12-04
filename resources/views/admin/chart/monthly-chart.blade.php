<x-app-layout>
    <x-slot name="title">
        Monthly Library Visits by Course and College
    </x-slot>

    <div class="w-100 h-70">
        <div class="container border border-black-subtle p-3" id="courseVisitsSection">
            <h3 class="text-start mb-2 fw-normal p-2 border-bottom">Monthly Course Visits</h3>
            <div class="chart-container">
                <canvas id="libraryCoursesMonthlyChart"></canvas>
            </div>
        </div>

        <div class="container mt-1 border border-black-subtle p-3" id="collegeVisitsSection" style="display: none;">
            <h3 class="text-start mb-2 fw-normal p-2 border-bottom">Monthly College Visits</h3>
            <div class="chart-container">
                <canvas id="libraryCollegeMonthlyChart"></canvas>
            </div>
        </div>

        <div class="container text-center mt-3">
            <button id="previousYearBtn" class="btn btn-outline-primary me-2">⬅️ Year</button>
            <span id="currentYear" class="mx-3 font-weight-bold">{{ now()->year }}</span>
            <button id="nextYearBtn" class="btn btn-outline-primary ms-2">➡️ Year</button>
        </div>

        <div class="container mt-4 text-center">
            <div class="btn-group gap-4" role="group" aria-label="Visits toggle">
                <button id="courseVisitsBtn" class="btn btn-primary">Show Course Visits</button>
                <button id="collegeVisitsBtn" class="btn btn-secondary">Show College
                    Visits</button>
            </div>
        </div>
    </div>

    <style>
        .chart-container {
            width: 100%;
            max-width: 1200px;
            height: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        canvas {
            width: 100% !important;
            height: 100% !important;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .btn {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #007bff;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
        }
    </style>

    <!-- Include jQuery and Chart.js libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{ asset('js/chart/monthly-chart.js') }}"></script>
</x-app-layout>
