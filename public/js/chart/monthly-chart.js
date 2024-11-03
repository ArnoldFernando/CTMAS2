document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("courseVisitsBtn").addEventListener("click", function () {
        document.getElementById("courseVisitsSection").style.display = "block";
        document.getElementById("collegeVisitsSection").style.display = "none";
        document.getElementById("courseVisitsBtn").style.display = "none";
        document.getElementById("collegeVisitsBtn").style.display = "inline-block";
    });

    document.getElementById("collegeVisitsBtn").addEventListener("click", function () {
        document.getElementById("courseVisitsSection").style.display = "none";
        document.getElementById("collegeVisitsSection").style.display = "block";
        document.getElementById("courseVisitsBtn").style.display = "inline-block";
        document.getElementById("collegeVisitsBtn").style.display = "none";
    });

    // Function to fetch course data
    function fetchCourseData() {
        $.ajax({
            url: '/admin/chart-data-course',
            method: 'GET',
            success: function (data) {
                const ctx = document.getElementById('libraryCoursesMonthlyChart').getContext('2d');
                const datasets = [];
                const colors = [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 0, 0, 0.5)',
                    'rgba(0, 255, 0, 0.5)',
                    'rgba(0, 0, 255, 0.5)',
                    'rgba(128, 0, 128, 0.5)',
                    'rgba(0, 128, 128, 0.5)',
                    'rgba(255, 165, 0, 0.5)'
                ];
                let colorIndex = 0;

                for (const course in data.data) {
                    datasets.push({
                        label: course,
                        data: data.data[course],
                        backgroundColor: colors[colorIndex % colors.length],
                        borderColor: colors[colorIndex % colors.length].replace(/0.5/, '1'),
                        borderWidth: 2,
                        hoverBackgroundColor: colors[colorIndex % colors.length].replace(/0.5/, '0.7'),
                        hoverBorderColor: colors[colorIndex % colors.length].replace(/0.5/, '1')
                    });
                    colorIndex++;
                }

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'
                        ],
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
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
                                    text: 'Months'
                                }
                            }
                        }
                    }
                });
            },
            error: function (err) {
                console.error('Error fetching course data:', err);
            }
        });
    }

    // Function to fetch college data
    function fetchCollegeData() {
        $.ajax({
            url: '/admin/chart-data-college',
            method: 'GET',
            success: function (data) {
                const ctx = document.getElementById('libraryCollegeMonthlyChart').getContext('2d');
                const datasets = [];
                const colors = [
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 0, 0, 0.5)',
                    'rgba(0, 255, 0, 0.5)',
                    'rgba(0, 0, 255, 0.5)',
                    'rgba(128, 0, 128, 0.5)',
                    'rgba(0, 128, 128, 0.5)',
                    'rgba(255, 165, 0, 0.5)'
                ];
                let colorIndex = 0;

                for (const college in data.data) {
                    datasets.push({
                        label: college,
                        data: data.data[college],
                        backgroundColor: colors[colorIndex % colors.length],
                        borderColor: colors[colorIndex % colors.length].replace(/0.5/, '1'),
                        borderWidth: 2,
                        hoverBackgroundColor: colors[colorIndex % colors.length].replace(/0.5/, '0.7'),
                        hoverBorderColor: colors[colorIndex % colors.length].replace(/0.5/, '1')
                    });
                    colorIndex++;
                }

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June',
                            'July', 'August', 'September', 'October', 'November', 'December'
                        ],
                        datasets: datasets
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
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
                                    text: 'Months'
                                }
                            }
                        }
                    }
                });
            },
            error: function (err) {
                console.error('Error fetching college data:', err);
            }
        });
    }

    // Fetch data on page load
    fetchCourseData();
    fetchCollegeData();
});
