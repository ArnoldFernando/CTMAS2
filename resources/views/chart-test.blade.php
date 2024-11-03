<x-app-layout>
    <x-slot name="title">
        Monthly Library Visits by Course and College
    </x-slot>

    <div class=" w-100">


        <div class="container mt-1" id="courseVisitsSection" style="display: block;">
            <h2 class="text-center mb-4">Monthly Course Visits</h2>
            <div class="chart-container">
                <canvas id="libraryCoursesMonthlyChart"></canvas>
            </div>
        </div>

        <div class="container mt-1" id="collegeVisitsSection" style="display: none;">
            <h2 class="text-center mb-4">Monthly College Visits</h2>
            <div class="chart-container">
                <canvas id="libraryCollegeMonthlyChart"></canvas>
            </div>
        </div>

        <div class="container mt-1 text-center">
            {{--  <h1 class="mb-4">Library Visits Overview</h1>  --}}
            <div class="btn-group" role="group" aria-label="Visits toggle">
                <button id="courseVisitsBtn" class="btn btn-primary btn-lg">Show Course Visits</button>
                <button id="collegeVisitsBtn" class="btn btn-secondary btn-lg" style="display: none;">Show College
                    Visits</button>
            </div>
        </div>

    </div>

    <script>
        document.getElementById("courseVisitsBtn").addEventListener("click", function() {
            document.getElementById("courseVisitsSection").style.display = "block";
            document.getElementById("collegeVisitsSection").style.display = "none";
            document.getElementById("courseVisitsBtn").style.display = "none";
            document.getElementById("collegeVisitsBtn").style.display = "inline-block";
        });

        document.getElementById("collegeVisitsBtn").addEventListener("click", function() {
            document.getElementById("courseVisitsSection").style.display = "none";
            document.getElementById("collegeVisitsSection").style.display = "block";
            document.getElementById("courseVisitsBtn").style.display = "inline-block";
            document.getElementById("collegeVisitsBtn").style.display = "none";
        });
    </script>

    <style>
        .chart-container {
            width: 100%;
            max-width: 700px;
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
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }
    </style>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/admin/chart-data',
                method: 'GET',
                success: function(data) {
                    const ctx = document.getElementById('libraryCoursesMonthlyChart').getContext('2d');
                    const datasets = [];

                    for (const course in data.data) {
                        datasets.push({
                            label: course,
                            data: data.data[course],
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            hoverBackgroundColor: 'rgba(75, 192, 192, 0.7)',
                            hoverBorderColor: 'rgba(75, 192, 192, 1)'
                        });
                    }

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November',
                                'December'
                            ],
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    enabled: true,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Number of Visits'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Months'
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(err) {
                    console.error('Error fetching data:', err);
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/admin/chart-data-2',
                method: 'GET',
                success: function(data) {
                    const ctx = document.getElementById('libraryCollegeMonthlyChart').getContext('2d');
                    const datasets = [];

                    for (const college in data.data) {
                        datasets.push({
                            label: college,
                            data: data.data[college],
                            backgroundColor: 'rgba(75, 192, 192, 0.5)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            hoverBackgroundColor: 'rgba(75, 192, 192, 0.7)',
                            hoverBorderColor: 'rgba(75, 192, 192, 1)'
                        });
                    }

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June',
                                'July', 'August', 'September', 'October', 'November',
                                'December'
                            ],
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                tooltip: {
                                    enabled: true,
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    title: {
                                        display: true,
                                        text: 'Number of Visits'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Months'
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(err) {
                    console.error('Error fetching data:', err);
                }
            });
        });
    </script>
</x-app-layout>
