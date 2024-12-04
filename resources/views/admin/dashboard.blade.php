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
                        <p>{{ now()->format('F') }} Total Time-In</p> <!-- Displays the current month -->
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
    </div>





    <div class="container border border-black-subtle">
        <div class="py-2 border-bottom">Average Monthly Time-In by Course</div>
        <canvas id="avgTimeChart" height="100"></canvas>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('avgTimeChart').getContext('2d');
            const data = {
                labels: @json($averageTimePerCourse->keys()),
                datasets: [{
                    label: 'Average Time (Minutes)',
                    data: @json($averageTimePerCourse->values()),
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            };

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
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
    </style>
</x-app-layout>
