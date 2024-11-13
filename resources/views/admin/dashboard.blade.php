<x-app-layout>


    <div class="container-fluid">
        <div class="row">
            <!-- Small Boxes (Summary Statistics) -->
            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $dailyCount }}</h3>
                        <p>Daily Time-In Count</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-day"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $weeklyAverage }}</h3>
                        <p>Weekly Average Time-In</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-week"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $monthlyTotal }}</h3>
                        <p>October Total Time-In</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $courseCount }}</h3>
                        <p>Courses Tracked</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Large Box (Chart) -->
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Average Time-In by Course</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="timeInChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);

            const labels = [];
            const datasets = [];

            // Fixed color palette for 12 courses
            const fixedColors = [
                '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40',
                '#E74C3C', '#2ECC71', '#3498DB', '#F39C12', '#8E44AD', '#27AE60'
            ];

            let colorIndex = 0;

            for (const [course, data] of Object.entries(chartData)) {
                labels.push(...data.map(item => item.date));

                datasets.push({
                    label: course,
                    data: data.map(item => {
                        const [hours, minutes] = item.average_time.split(':');
                        return parseInt(hours) + parseInt(minutes) / 60; // Convert to hours
                    }),
                    backgroundColor: fixedColors[colorIndex % fixedColors.length], // Use fixed color
                    borderColor: fixedColors[colorIndex % fixedColors.length],
                    borderWidth: 1
                });

                colorIndex++;
            }

            const ctx = document.getElementById('timeInChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [...new Set(labels)].sort(),
                    datasets: datasets
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        }
                    },
                    scales: {
                        y: {
                            title: {
                                display: true,
                                text: 'Average Time-In (Hours)'
                            },
                            beginAtZero: true
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });
        });
    </script>


    <style>
        /* Ensures no scroll on page */
        .container-fluid {
            padding: 0 15px;
        }

        .small-box {
            color: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            height: 120px;
        }

        .small-box .icon {
            font-size: 60px;
            opacity: 0.4;
        }

        .card {
            height: 400px;
        }

        .card-body {
            position: relative;
            height: 100%;
        }
    </style>


</x-app-layout>
