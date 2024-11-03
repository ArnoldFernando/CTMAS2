// public/js/chartHandler.js

document.addEventListener("DOMContentLoaded", function () {
    const courseVisitsBtn = document.getElementById("courseVisitsBtn");
    const collegeVisitsBtn = document.getElementById("collegeVisitsBtn");
    const courseVisitsSection = document.getElementById("courseVisitsSection");
    const collegeVisitsSection = document.getElementById("collegeVisitsSection");
    const prevMonthBtn = document.getElementById("prevMonth");
    const nextMonthBtn = document.getElementById("nextMonth");
    const currentMonthLabel = document.getElementById("currentMonthLabel");

    let currentMonth = new Date().getMonth() + 1; // Current month in numeric format (1-12)

    // Function to toggle between Course and College visits
    const toggleSections = (showCourses) => {
        courseVisitsSection.style.display = showCourses ? "block" : "none";
        collegeVisitsSection.style.display = showCourses ? "none" : "block";
        courseVisitsBtn.style.display = showCourses ? "none" : "inline-block";
        collegeVisitsBtn.style.display = showCourses ? "inline-block" : "none";
    };

    // Event Listeners for button clicks
    courseVisitsBtn.addEventListener("click", () => {
        toggleSections(true);
        updateChart(currentMonth, 'course');
    });

    collegeVisitsBtn.addEventListener("click", () => {
        toggleSections(false);
        updateChart(currentMonth, 'college');
    });

    // Month navigation function
    prevMonthBtn.addEventListener("click", () => navigateMonth(-1));
    nextMonthBtn.addEventListener("click", () => navigateMonth(1));

    function navigateMonth(direction) {
        currentMonth = Math.min(Math.max(currentMonth + direction, 1), 12);
        const type = collegeVisitsSection.style.display === "block" ? 'college' : 'course';
        updateChart(currentMonth, type);
        updateMonthLabel();
    }

    // Function to update chart data
    function updateChart(month, type) {
        const url = type === 'course' ? '/admin/chart-data-course-week' : '/admin/chart-data-college-week';
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                month: month
            },
            success: function (data) {
                const ctx = document.getElementById(type === 'course' ? 'libraryCoursesWeeklyChart' : 'libraryCollegeWeeklyChart').getContext('2d');
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
                for (const item in data.data) {
                    datasets.push({
                        label: item,
                        data: Object.values(data.data[item]),
                        backgroundColor: colors[colorIndex % colors.length],
                        borderColor: colors[colorIndex % colors.length].replace(/0.5/, '1'),
                        borderWidth: 2,
                        hoverBackgroundColor: colors[colorIndex % colors.length].replace(/0.5/, '0.7'),
                        hoverBorderColor: colors[colorIndex % colors.length].replace(/0.5/, '1')
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
                        aspectRatio: 2,
                        plugins: {
                            legend: {
                                position: 'right',
                                align: 'start'
                            },
                            tooltip: {
                                enabled: true
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

                $('#currentMonthLabel').text(monthNames[month - 1]);
                $('#prevMonth').prop('disabled', month === 1); // Disable if January
                $('#nextMonth').prop('disabled', month === 12); // Disable if December
            },
            error: function (err) {
                console.error('Error fetching data:', err);
                alert('Failed to fetch chart data. Please try again.');
            }
        });
    }

    // Function to update the month label
    function updateMonthLabel() {
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        currentMonthLabel.textContent = monthNames[currentMonth - 1];
    }

    // Initial load for course visits
    updateChart(currentMonth, 'course');
});
