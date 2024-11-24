<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Chart Type Selector</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Dynamic Chart with Type Selection</h1>

        <!-- Chart Type Selection -->
        <div class="mb-4">
            <label for="chart-type" class="form-label">Select Chart Type</label>
            <select id="chart-type" class="form-select">
                <option value="bar">Bar Chart</option>
                <option value="line">Line Chart</option>
                <option value="pie">Pie Chart</option>
                <option value="doughnut">Doughnut Chart</option>
                <option value="radar">Radar Chart</option>
                <option value="polarArea">Polar Area Chart</option>
                <option value="bubble">Bubble Chart</option>
                <option value="scatter">Scatter Chart</option>
            </select>
        </div>

        <!-- Form for multiple data inputs -->
        <form id="data-form">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Data Name</th>
                        <th>Data Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="data-rows">
                    <tr>
                        <td><input type="text" class="form-control data-name" placeholder="Data Name" required></td>
                        <td><input type="number" class="form-control data-value" placeholder="Data Value" required>
                        </td>
                        <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" id="add-row" class="btn btn-secondary">Add Row</button>
            <button type="button" id="update-chart" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#chartModal">Show Chart</button>
        </form>

        <!-- Chart Modal -->
        <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="chartModalLabel">Chart Preview</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Chart.js
        const ctx = document.getElementById('chart').getContext('2d');
        let chartType = 'bar'; // Default chart type is Bar
        const chart = new Chart(ctx, {
            type: chartType,
            data: {
                labels: [], // Labels for the chart (Data names)
                datasets: [] // Datasets will be added dynamically
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true, // Display the legend
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Generate random color for each dataset
        function getRandomColor() {
            const r = Math.floor(Math.random() * 255);
            const g = Math.floor(Math.random() * 255);
            const b = Math.floor(Math.random() * 255);
            return `rgba(${r}, ${g}, ${b}, 0.5)`;
        }

        // Add a new row for data input
        document.getElementById('add-row').addEventListener('click', () => {
            const row = `
                <tr>
                    <td><input type="text" class="form-control data-name" placeholder="Data Name" required></td>
                    <td><input type="number" class="form-control data-value" placeholder="Data Value" required></td>
                    <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                </tr>
            `;
            document.getElementById('data-rows').insertAdjacentHTML('beforeend', row);
        });

        // Remove a row
        document.getElementById('data-rows').addEventListener('click', (e) => {
            if (e.target.classList.contains('remove-row')) {
                e.target.closest('tr').remove();
            }
        });

        // Update Chart Type based on user selection
        document.getElementById('chart-type').addEventListener('change', (e) => {
            chartType = e.target.value;
            chart.config.type = chartType; // Update chart type
            chart.update(); // Re-render the chart
        });

        // Update Chart when the modal is triggered
        document.getElementById('update-chart').addEventListener('click', () => {
            const labels = [];
            const datasets = [];

            // Collect data from input fields
            document.querySelectorAll('#data-rows tr').forEach(row => {
                const name = row.querySelector('.data-name').value;
                const value = row.querySelector('.data-value').value;

                if (name && value) {
                    labels.push(name);

                    datasets.push({
                        label: name, // Display the data name as the legend
                        data: [Number(value)], // Each data point is a single value
                        backgroundColor: getRandomColor(), // Random color for each dataset
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    });
                }
            });

            // Update the chart
            chart.data.labels = labels; // Assign the labels for the X-axis
            chart.data.datasets = datasets; // Assign the datasets for the Y-axis
            chart.update();
        });
    </script>
</body>

</html>
