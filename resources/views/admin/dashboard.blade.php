@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 text-gray-800" style="font-family: 'Playfair Display', serif;">Dashboard & Analytics</h2>
            <div class="btn-group">
                <button class="btn btn-outline-secondary btn-sm">Day</button>
                <button class="btn btn-outline-secondary btn-sm active">Week</button>
                <button class="btn btn-outline-secondary btn-sm">Month</button>
            </div>
        </div>

        <!-- Widgets -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-3 border-start border-4 border-primary">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Revenue</div>
                                <div class="h4 mb-0 fw-bold text-dark">12,450 JOD</div>
                                <small class="text-success"><i class="fa-solid fa-arrow-up"></i> 12% vs last week</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sack-dollar fa-2x text-gray-300 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-3 border-start border-4 border-success">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-success text-uppercase mb-1">Orders</div>
                                <div class="h4 mb-0 fw-bold text-dark">85</div>
                                <small class="text-success"><i class="fa-solid fa-arrow-up"></i> 5% vs last week</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-boxes-packing fa-2x text-gray-300 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-3 border-start border-4 border-info">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-info text-uppercase mb-1">Avg. Order Value</div>
                                <div class="h4 mb-0 fw-bold text-dark">146 JOD</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-receipt fa-2x text-gray-300 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 py-3 border-start border-4 border-warning">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs fw-bold text-warning text-uppercase mb-1">Conversion Rate</div>
                                <div class="h4 mb-0 fw-bold text-dark">3.2%</div>
                                <small class="text-danger"><i class="fa-solid fa-arrow-down"></i> 1% vs last week</small>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users-viewfinder fa-2x text-gray-300 opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-4 mb-4">
            <!-- Sales Chart -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-primary">Sales Overview</h6>
                        <button class="btn btn-sm btn-light"><i class="fa-solid fa-download"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="chart-area" style="height: 350px;">
                            <canvas id="myAreaChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Style Pie Chart -->
            <div class="col-lg-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header py-3 bg-white">
                        <h6 class="m-0 fw-bold text-primary">Sales by Style Persona</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2" style="height: 250px;">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="me-2">
                                <i class="fas fa-circle text-primary"></i> Soft
                            </span>
                            <span class="me-2">
                                <i class="fas fa-circle text-dark"></i> Alt
                            </span>
                            <span class="me-2">
                                <i class="fas fa-circle text-warning"></i> Luxury
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Area Chart - Sales
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [{
                    label: "Revenue",
                    lineTension: 0.3,
                    backgroundColor: "rgba(246, 166, 178, 0.05)",
                    borderColor: "rgba(246, 166, 178, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(246, 166, 178, 1)",
                    pointBorderColor: "rgba(246, 166, 178, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(246, 166, 178, 1)",
                    pointHoverBorderColor: "rgba(246, 166, 178, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [1500, 2000, 1800, 2400, 2100, 3200, 3800],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: { padding: { left: 10, right: 25, top: 25, bottom: 0 } },
                scales: {
                    x: { grid: { display: false, drawBorder: false } },
                    y: { grid: { color: "rgb(234, 236, 244)", zeroLineColor: "rgb(234, 236, 244)", drawBorder: false }, ticks: { padding: 10, callback: function (value) { return value + ' JOD'; } } },
                },
                plugins: { legend: { display: false } }
            }
        });

        // Pie Chart - Styles
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ["Soft Girl", "Alt Girl", "Luxury", "Clean Girl"],
                datasets: [{
                    data: [45, 25, 20, 10],
                    backgroundColor: ['#F6A6B2', '#1E1E1E', '#C9A24D', '#E2E6EA'],
                    hoverBackgroundColor: ['#E48B9A', '#333333', '#D4AF37', '#D1D3E2'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: { backgroundColor: "rgb(255,255,255)", bodyFontColor: "#858796", borderColor: '#dddfeb', borderWidth: 1, xPadding: 15, yPadding: 15, displayColors: false, caretPadding: 10 },
                legend: { display: false },
                cutout: '70%',
            },
        });
    </script>
@endsection