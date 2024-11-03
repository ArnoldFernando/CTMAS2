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

    {{--  course  --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/admin/chart-data-course',
                method: 'GET',
                success: function(data) {
                    const ctx = document.getElementById('libraryCoursesMonthlyChart').getContext('2d');
                    const datasets = [];

                    // Define an array of colors to use for each course
                    const colors = [
                        'rgba(75, 192, 192, 0.5)', // teal
                        'rgba(255, 99, 132, 0.5)', // red
                        'rgba(255, 206, 86, 0.5)', // yellow
                        'rgba(54, 162, 235, 0.5)', // blue
                        'rgba(153, 102, 255, 0.5)', // purple
                        'rgba(255, 159, 64, 0.5)', // orange
                        'rgba(255, 0, 0, 0.5)', // bright red
                        'rgba(0, 255, 0, 0.5)', // green
                        'rgba(0, 0, 255, 0.5)', // blue
                        'rgba(128, 0, 128, 0.5)', // purple
                        'rgba(0, 128, 128, 0.5)', // teal
                        'rgba(255, 165, 0, 0.5)' // orange
                    ];

                    let colorIndex = 0;

                    for (const course in data.data) {
                        datasets.push({
                            label: course,
                            data: data.data[course],
                            backgroundColor: colors[colorIndex % colors
                                .length], // Cycle through colors
                            borderColor: colors[colorIndex % colors.length].replace(/0.5/,
                                '1'), // Use full opacity for border
                            borderWidth: 2,
                            hoverBackgroundColor: colors[colorIndex % colors.length].replace(
                                /0.5/, '0.7'), // Slightly darker on hover
                            hoverBorderColor: colors[colorIndex % colors.length].replace(/0.5/,
                                '1') // Full opacity on hover
                        });
                        colorIndex++;
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
                                    position: 'right', // Position legend to the right
                                    align: 'start',
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

    {{--  college  --}}
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/admin/chart-data-college',
                method: 'GET',
                success: function(data) {
                    const ctx = document.getElementById('libraryCollegeMonthlyChart').getContext('2d');
                    const datasets = [];

                    // Define an array of colors to use for each college
                    const colors = [
                        'rgba(75, 192, 192, 0.5)', // teal
                        'rgba(255, 99, 132, 0.5)', // red
                        'rgba(255, 206, 86, 0.5)', // yellow
                        'rgba(54, 162, 235, 0.5)', // blue
                        'rgba(153, 102, 255, 0.5)', // purple
                        'rgba(255, 159, 64, 0.5)', // orange
                        'rgba(255, 0, 0, 0.5)', // bright red
                        'rgba(0, 255, 0, 0.5)', // green
                        'rgba(0, 0, 255, 0.5)', // blue
                        'rgba(128, 0, 128, 0.5)', // purple
                        'rgba(0, 128, 128, 0.5)', // teal
                        'rgba(255, 165, 0, 0.5)' // orange
                    ];

                    let colorIndex = 0;

                    for (const college in data.data) {
                        datasets.push({
                            label: college,
                            data: data.data[college],
                            backgroundColor: colors[colorIndex % colors
                                .length], // Cycle through colors
                            borderColor: colors[colorIndex % colors.length].replace(/0.5/,
                                '1'), // Use full opacity for border
                            borderWidth: 2,
                            hoverBackgroundColor: colors[colorIndex % colors.length].replace(
                                /0.5/, '0.7'), // Slightly darker on hover
                            hoverBorderColor: colors[colorIndex % colors.length].replace(/0.5/,
                                '1') // Full opacity on hover
                        });
                        colorIndex++;
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
                                    position: 'right', // Position legend to the right
                                    align: 'start',
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


    <!-- Chart Navigation Controls -->
    <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
        <button id="prevMonth" style="margin-right: 10px;">⬅️</button>
        <span id="currentMonthLabel">Current Month</span>
        <button id="nextMonth" style="margin-left: 10px;">➡️</button>
    </div>

    <!-- Chart Canvas with Defined Container -->
    <div style="width: 80%; max-width: 800px; margin: 0 auto;">
        <canvas id="libraryCoursesMonthlyChart"></canvas>
    </div>

    <script>
        $(document).ready(function() {
            let currentMonth = new Date().getMonth() + 1; // Current month in numeric format (1-12)
            const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                'September', 'October', 'November', 'December'
            ];

            function updateChart(month) {
                $.ajax({
                    url: '/admin/chart-data-course-week',
                    method: 'GET',
                    data: {
                        month: month
                    },
                    success: function(data) {
                        const ctx = document.getElementById('libraryCoursesMonthlyChart').getContext(
                            '2d');
                        const datasets = [];
                        const colors = [
                            'rgba(75, 192, 192, 0.5)', // teal
                            'rgba(255, 99, 132, 0.5)', // red
                            'rgba(255, 206, 86, 0.5)', // yellow
                            'rgba(54, 162, 235, 0.5)', // blue
                            'rgba(153, 102, 255, 0.5)', // purple
                            'rgba(255, 159, 64, 0.5)', // orange
                        ];

                        let colorIndex = 0;
                        for (const course in data.data) {
                            datasets.push({
                                label: course,
                                data: Object.values(data.data[course]),
                                backgroundColor: colors[colorIndex % colors.length],
                                borderColor: colors[colorIndex % colors.length].replace(/0.5/,
                                    '1'),
                                borderWidth: 2,
                                hoverBackgroundColor: colors[colorIndex % colors.length]
                                    .replace(/0.5/, '0.7'),
                                hoverBorderColor: colors[colorIndex % colors.length].replace(
                                    /0.5/, '1')
                            });
                            colorIndex++;
                        }

                        if (window.myChart) window.myChart.destroy();
                        window.myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: data.labels,
                                datasets: datasets
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: true,
                                aspectRatio: 2, // Aspect ratio to keep the chart from stretching
                                plugins: {
                                    legend: {
                                        position: 'right',
                                        align: 'start',
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
                                            text: 'Month'
                                        }
                                    }
                                }
                            }
                        });

                        // Update the current month label
                        $('#currentMonthLabel').text(monthNames[month - 1]);

                        // Disable or enable navigation buttons based on the month
                        $('#prevMonth').prop('disabled', month === 1); // Disable if January
                        $('#nextMonth').prop('disabled', month === 12); // Disable if December
                    },
                    error: function(err) {
                        console.error('Error fetching data:', err);
                    }
                });
            }

            // Initial load for the current month
            updateChart(currentMonth);

            // Navigate to previous month
            $('#prevMonth').click(function() {
                if (currentMonth > 1) {
                    currentMonth--;
                    updateChart(currentMonth);
                }
            });

            // Navigate to next month
            $('#nextMonth').click(function() {
                if (currentMonth < 12) {
                    currentMonth++;
                    updateChart(currentMonth);
                }
            });
        });
    </script>













    {{--  pie chart  --}}
    {{--
    <div class="w-50">
        <div style="display: flex; justify-content: space-between;">
            <canvas id="myChart" style="width: 30%;"></canvas>
            <div id="legendContainer" style="width: 30%; padding-left: 20px;"></div>
            <!-- Optional: Custom legend container -->
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '/admin/chart-data-course', // Change to your actual endpoint
                method: 'GET',
                success: function(response) {
                    const datasets = [];
                    const courseNames = [];
                    const courseVisits = [];

                    // Prepare datasets for each course
                    for (const [courseId, visits] of Object.entries(response.data)) {
                        const totalVisits = Object.values(visits).reduce((acc, val) => acc + val,
                            0); // Sum up all visits for this course
                        courseNames.push(courseId); // Store course ID or name for the label
                        courseVisits.push(totalVisits); // Store total visits for the pie chart
                    }

                    const ctx = document.getElementById('myChart').getContext('2d');
                    const myChart = new Chart(ctx, {
                        type: 'pie', // Change type to pie
                        data: {
                            labels: courseNames, // Use course names as labels
                            datasets: [{
                                data: courseVisits, // Total visits for each course
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'right', // Change this to 'left', 'top', or 'bottom' as needed
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return `${tooltipItem.label}: ${tooltipItem.raw}`; // Show visits count in tooltip
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                error: function(err) {
                    console.error('Error fetching course visit data:', err);
                }
            });
        });
    </script>  --}}
</x-app-layout>
