document.addEventListener("DOMContentLoaded", function () {
    const sections = {
        course: {
            btn: "courseVisitsBtn",
            section: "courseVisitsSection",
            chartId: "libraryCoursesMonthlyChart",
            dataUrl: "/admin/chart-data-course"
        },
        college: {
            btn: "collegeVisitsBtn",
            section: "collegeVisitsSection",
            chartId: "libraryCollegeMonthlyChart",
            dataUrl: "/admin/chart-data-college"
        }
    };

    const currentYearElement = document.getElementById("currentYear");
    let currentYear = parseInt(currentYearElement.textContent);
    let activeSection = 'course';
    let chartInstance = null;

    const fetchDataForYear = (year, sectionKey) => {
        const {
            dataUrl,
            chartId
        } = sections[sectionKey];
        fetchData(`${dataUrl}?year=${year}&timestamp=${new Date().getTime()}`, chartId); // Adding timestamp to avoid caching
    };

    const updateYearAndFetchData = (newYear) => {
        currentYear = newYear;
        currentYearElement.textContent = currentYear;
        fetchDataForYear(currentYear, activeSection);
    };

    // Year navigation buttons
    document.getElementById("previousYearBtn").addEventListener("click", function () {
        updateYearAndFetchData(currentYear - 1);
    });

    document.getElementById("nextYearBtn").addEventListener("click", function () {
        updateYearAndFetchData(currentYear + 1);
    });

    // Toggle between course and college visits
    Object.keys(sections).forEach(sectionKey => {
        const {
            btn,
            section
        } = sections[sectionKey];
        document.getElementById(btn).addEventListener("click", function () {
            activeSection = sectionKey;
            document.getElementById(section).style.display = "block";
            document.getElementById(btn).style.display = "none";
            const otherSection = Object.keys(sections).find(key => key !== sectionKey);
            document.getElementById(sections[otherSection].section).style.display = "none";
            document.getElementById(sections[otherSection].btn).style.display = "inline-block";

            fetchDataForYear(currentYear, sectionKey);
        });
    });

    const colors = [
        'rgba(75, 192, 192, 0.5)', // Aqua
        'rgba(255, 99, 132, 0.5)', // Pink
        'rgba(255, 206, 86, 0.5)', // Yellow
        'rgba(54, 162, 235, 0.5)', // Blue
        'rgba(153, 102, 255, 0.5)', // Lavender
        'rgba(255, 159, 64, 0.5)', // Orange
        'rgba(255, 0, 0, 0.5)', // Red
        'rgba(0, 255, 0, 0.5)', // Green
        'rgba(0, 0, 255, 0.5)', // Deep Blue
        'rgba(128, 0, 128, 0.5)', // Purple
        'rgba(0, 128, 128, 0.5)', // Teal
        'rgba(255, 165, 0, 0.5)' // Amber

    ];

    const createChart = (ctx, data) => {
        // Destroy previous chart instance if it exists
        if (chartInstance) {
            chartInstance.destroy();
        }

        const datasets = Object.keys(data).map((label, i) => {
            const visitsPerMonth = Object.values(data[label]); // Get the array of visits per month
            const totalVisits = visitsPerMonth.reduce((a, b) => a + b, 0); // Sum the visits for the dataset
            const formattedTotal = totalVisits.toLocaleString(); // Format the total visits with commas

            return {
                label: `${label}`, // Add formatted total visits to the label
                data: visitsPerMonth, // Ensure data is an array of numbers
                backgroundColor: colors[i % colors.length],
                borderColor: colors[i % colors.length].replace(/0.5/, '1'),
                borderWidth: 2
            };
        });

        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        align: 'start',
                        labels: {
                            generateLabels: function (chart) {
                                const datasets = chart.data.datasets;

                                // Map through the datasets to create individual labels
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

                                // Calculate the grand total only from visible datasets
                                const grandTotal = datasets.reduce((sum, dataset, i) => {
                                    if (chart.isDatasetVisible(i)) { // Only include visible datasets
                                        return sum + dataset.data.reduce((a, b) => a + b, 0);
                                    }
                                    return sum;
                                }, 0);
                                const formattedGrandTotal = grandTotal.toLocaleString();

                                // Append the dynamic grand total label to the legend
                                labels.push({
                                    text: `Total: ${formattedGrandTotal}`, // Display updated grand total
                                    fillStyle: 'transparent', // No color block for the total label
                                    hidden: false, // Static label for display
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
                            text: 'Months'
                        }
                    }
                }
            }
        });
    };


    const fetchData = (url, chartId) => {
        $.ajax({
            url,
            method: 'GET',
            success: data => {
                console.log('Fetched Data:', data); // Log the fetched data
                const ctx = document.getElementById(chartId).getContext('2d');
                createChart(ctx, data.data);
            },
            error: err => console.error(`Error fetching data from ${url}:`, err)
        });
    };


    // Initial fetch for the current year
    fetchDataForYear(currentYear, 'course');
});
