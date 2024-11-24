<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <h1 class="text-center my-4">Chart Calculator</h1>

    <div class="container px-4">
        <form id="chart-form">
            @csrf
            <div id="inputs-container">
                <div class="input-group mb-3 align-items-center px-4">
                    <!-- Name Label and Input -->
                    <label class="form-label mb-0 me-2">Name:</label>
                    <input type="text" class="form-control" name="legend[]" required>

                    <!-- Value Label and Input -->
                    <label class="form-label mb-0 me-2 ms-3">Value:</label>
                    <input type="number" class="form-control" name="value[]" required>

                    <!-- Color Label and Input -->

                    <label class="form-label mb-0 me-2 ms-3 ">Color:</label>
                    <div class="rounder-circle">
                        <input type="color" class="form-control " name="color[]" required>

                    </div>



                    <!-- Remove Button -->
                    <button type="button" class="btn btn-danger ms-3 remove-input"
                        onclick="removeInput(this)">Remove</button>
                </div>
            </div>
            <style>
                .rounder-circle {
                    border-radius: 50%;
                    padding: 0;
                    width: 40px;
                    /* Adjust the size as needed */
                    height: 40px;
                    /* Adjust the size as needed */
                    border: none;
                    cursor: pointer;
                }
            </style>
            <div class="d-flex justify-content-between" id="chart-btn">
                <button type="text" class="btn btn-primary" onclick="addInput()">Add Another</button>
                <button type="submit" class="btn btn-success">Generate Chart</button>
            </div>
        </form>
    </div>

    <!-- Modal for displaying the chart -->
    <div class="modal fade" id="chartModal" tabindex="-1" aria-labelledby="chartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chartModalLabel">Generated Chart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="myChart" width="200" height="100"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go Back to Input</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let inputCount = 1; // Start with 1 set of inputs
        let chartInstance; // Global variable to hold the chart instance

        function addInput() {
            const container = document.getElementById('inputs-container');
            const newInput = `
                <div class="input-group mb-3 align-items-center px-4">
                    <!-- Name Label and Input -->
                    <label class="form-label mb-0 me-2">Name:</label>
                    <input type="text" class="form-control" name="legend[]" required>

                    <!-- Value Label and Input -->
                    <label class="form-label mb-0 me-2 ms-3">Value:</label>
                    <input type="number" class="form-control" name="value[]" required>

                    <!-- Color Label and Input -->

                    <label class="form-label mb-0 me-2 ms-3 ">Color:</label>
                    <div class="rounder-circle">
                        <input type="color" class="form-control " name="color[]" required>
                    </div>

                    <!-- Remove Button -->
                    <button type="button" class="btn btn-danger ms-3 remove-input"
                        onclick="removeInput(this)">Remove</button>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newInput);
            inputCount++;
        }

        function removeInput(button) {
            const inputGroup = button.closest('.input-group');
            inputGroup.remove();
        }

        document.getElementById('chart-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('/admin/chart', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Show the modal with the chart
                    const myChartModal = new bootstrap.Modal(document.getElementById('chartModal'));
                    myChartModal.show();

                    const ctx = document.getElementById('myChart').getContext('2d');

                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    // Create individual datasets, each corresponding to a legend item
                    const datasets = data.legends.map((legend, index) => ({
                        label: legend, // This will appear in the legend on the right
                        data: data.values.map((value, i) => (i === index ? value :
                            0)), // Only display the specific data point for this dataset
                        backgroundColor: data.colors[index]
                    }));

                    // Calculate the total value from all data (ensure values are numbers)
                    const totalValue = data.values.reduce((acc, value) => acc + Number(value), 0);

                    chartInstance = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: data.legends, // Legends as labels for the X-axis
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'right',
                                    align: 'start',
                                    labels: {
                                        generateLabels: function(chart) {
                                            const labels = Chart.defaults.plugins.legend.labels
                                                .generateLabels(chart);

                                            // Add value to each legend item
                                            labels.forEach((label, index) => {
                                                label.text += `: ${data.values[index]}`;
                                            });

                                            // Calculate and append the total value at the end of the legend
                                            const totalLabel = {
                                                text: `Total: ${totalValue}`,
                                                fillStyle: 'transparent', // Make it stand out
                                                strokeStyle: '#000', // Optional, for border styling
                                                lineWidth: 1,
                                            };

                                            labels.push(
                                                totalLabel); // Append the total label to the legend

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
                                        text: 'Categories' // X-axis title
                                    },
                                    ticks: {
                                        autoSkip: false // Ensure all labels are shown
                                    },
                                    stacked: true // Stack bars to prevent gaps
                                }
                            }
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
