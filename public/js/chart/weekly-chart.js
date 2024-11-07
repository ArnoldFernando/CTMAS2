document.addEventListener("DOMContentLoaded", function () {
    const courseVisitsBtn = document.getElementById("courseVisitsBtn");
    const collegeVisitsBtn = document.getElementById("collegeVisitsBtn");
    const prevMonthBtn = document.getElementById("prevMonth");
    const nextMonthBtn = document.getElementById("nextMonth");
    const prevYearBtn = document.getElementById("prevYear");
    const nextYearBtn = document.getElementById("nextYear");
    const currentMonthLabel = document.getElementById("currentMonthLabel");

    let currentMonth = new Date().getMonth() + 1;
    let currentYear = new Date().getFullYear();
    let minYear, maxYear;

    // Toggle between course and college visit sections
    function toggleSections(showCourses) {
        document.getElementById("courseVisitsSection").style.display = showCourses ? "block" : "none";
        document.getElementById("collegeVisitsSection").style.display = showCourses ? "none" : "block";
        courseVisitsBtn.style.display = showCourses ? "none" : "inline-block";
        collegeVisitsBtn.style.display = showCourses ? "inline-block" : "none";
    }

    function updateMonthLabel() {
        const monthNames = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        currentMonthLabel.textContent = `${monthNames[currentMonth - 1]} ${currentYear}`;
    }

    function checkNavigationLimits() {
        prevMonthBtn.disabled = (currentYear === minYear && currentMonth === 1);
        nextMonthBtn.disabled = (currentYear === maxYear && currentMonth === 12);
        prevYearBtn.disabled = (currentYear === minYear);
        nextYearBtn.disabled = (currentYear === maxYear);
    }

    // Month navigation functions
    prevMonthBtn.addEventListener("click", () => navigateMonth(-1));
    nextMonthBtn.addEventListener("click", () => navigateMonth(1));
    prevYearBtn.addEventListener("click", () => navigateYear(-1));
    nextYearBtn.addEventListener("click", () => navigateYear(1));

    function navigateMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 1) {
            currentMonth = 12;
            currentYear -= 1;
        } else if (currentMonth > 12) {
            currentMonth = 1;
            currentYear += 1;
        }
        updateChart(currentMonth, currentYear, document.getElementById("collegeVisitsSection").style.display === "block" ? 'college' : 'course');
        updateMonthLabel();
        checkNavigationLimits();
    }

    function navigateYear(direction) {
        currentYear += direction;
        updateChart(currentMonth, currentYear, document.getElementById("collegeVisitsSection").style.display === "block" ? 'college' : 'course');
        updateMonthLabel();
        checkNavigationLimits();
    }

    function updateChart(month, year, type) {
        const url = type === 'course' ? '/admin/chart-data-course-week' : '/admin/chart-data-college-week';
        $.ajax({
            url: url,
            method: 'GET',
            data: {
                month: month,
                year: year
            },
            success: function (data) {
                minYear = data.minYear;
                maxYear = data.maxYear;

                const ctx = document.getElementById(type === 'course' ? 'libraryCoursesWeeklyChart' : 'libraryCollegeWeeklyChart').getContext('2d');
                const datasets = [];
                const colors = [
                    'rgba(75, 192, 192, 0.5)', 'rgba(255, 99, 132, 0.5)',
                    'rgba(255, 206, 86, 0.5)', 'rgba(54, 162, 235, 0.5)',
                    'rgba(153, 102, 255, 0.5)', 'rgba(255, 159, 64, 0.5)'
                ];

                let colorIndex = 0;
                for (const item in data.data) {
                    datasets.push({
                        label: item,
                        data: Object.values(data.data[item]),
                        backgroundColor: colors[colorIndex % colors.length],
                        borderColor: colors[colorIndex % colors.length].replace(/0.5/, '1'),
                        borderWidth: 2
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
                        maintainAspectRatio: false,
                        aspectRatio: 2,
                        plugins: {
                            legend: {
                                position: 'right',
                                align: 'start',
                                labels: {
                                    generateLabels: (chart) => {
                                        const datasets = chart.data.datasets;

                                        // Map through datasets to create individual labels
                                        const labels = datasets.map((dataset, i) => {
                                            const totalVisits = dataset.data.reduce((a, b) => a + b, 0);
                                            const formattedTotal = totalVisits.toLocaleString();
                                            return {
                                                text: `${dataset.label}: ${formattedTotal}`,
                                                fillStyle: dataset.backgroundColor,
                                                hidden: !chart.isDatasetVisible(i),
                                                lineCap: dataset.borderCapStyle,
                                                lineDash: dataset.borderDash,
                                                lineDashOffset: dataset.borderDashOffset,
                                                lineJoin: dataset.borderJoinStyle,
                                                strokeStyle: dataset.borderColor,
                                                pointStyle: dataset.pointStyle,
                                                datasetIndex: i
                                            };
                                        });

                                        // Calculate the grand total for visible datasets only
                                        const grandTotal = datasets.reduce((sum, dataset, i) => {
                                            if (chart.isDatasetVisible(i)) {
                                                return sum + dataset.data.reduce((a, b) => a + b, 0);
                                            }
                                            return sum;
                                        }, 0);
                                        const formattedGrandTotal = grandTotal.toLocaleString();

                                        // Append the grand total as the last label
                                        labels.push({
                                            text: `Total: ${formattedGrandTotal}`,
                                            fillStyle: 'transparent',
                                            hidden: false,
                                        });

                                        return labels;
                                    }
                                }
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
                                    text: 'Weeks'
                                }
                            }
                        }
                    }
                });

                updateMonthLabel();
                checkNavigationLimits();
            },
            error: function (err) {
                console.error('Error fetching data:', err);
                alert('Failed to fetch chart data. Please try again.');
            }
        });
    }

    // Event Listeners for toggling sections
    courseVisitsBtn.addEventListener("click", () => {
        toggleSections(true);
        updateChart(currentMonth, currentYear, 'course');
    });
    collegeVisitsBtn.addEventListener("click", () => {
        toggleSections(false);
        updateChart(currentMonth, currentYear, 'college');
    });

    // Initial load
    updateChart(currentMonth, currentYear, 'course');
    updateMonthLabel();
});
