<div class="container mt-1" id="collegeVisitsSection" style="display: none;">
    <h2 class="text-center mb-4">Monthly College Visits</h2>
    <div class="chart-container">
        <canvas id="m-college"></canvas>
    </div>
</div>



{{--  college  --}}
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/admin/chart-data-college',
            method: 'GET',
            success: function(data) {
                const ctx = document.getElementById('m-college').getContext('2d');
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
