@extends('layouts.admin')

@section('content')
    <div class="container-fluid animate-fade-in">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="h2 mb-1" style="font-family: 'Playfair Display', serif; font-weight: 700;">Dashboard</h1>
                <p class="text-muted small mb-0">Welcome back to your collection overview.</p>
            </div>
            <div class="bg-white p-1 rounded-3 shadow-sm d-flex">
                <button class="btn btn-sm px-3 rounded-2 fw-medium btn-light text-muted">Day</button>
                <button class="btn btn-sm px-3 rounded-2 fw-medium btn-dark">Week</button>
                <button class="btn btn-sm px-3 rounded-2 fw-medium btn-light text-muted">Month</button>
            </div>
        </div>

        <!-- Widgets -->
        <div class="row g-4 mb-5">
            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="bg-soft-blush p-2 rounded-3" style="background: rgba(246, 166, 178, 0.1);">
                                <i class="fas fa-sack-dollar text-primary-custom"
                                    style="color: var(--color-primary-blush);"></i>
                            </div>
                            <small class="text-success fw-bold"><i class="fa-solid fa-arrow-up"></i> 12%</small>
                        </div>
                        <div class="text-muted small text-uppercase fw-bold mb-1"
                            style="font-size: 0.7rem; letter-spacing: 0.5px;">Total Revenue</div>
                        <div class="h3 mb-0 fw-bold text-dark">12,450 JOD</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="p-2 rounded-3" style="background: rgba(30, 30, 30, 0.05);">
                                <i class="fas fa-boxes-packing text-dark"></i>
                            </div>
                            <small class="text-success fw-bold"><i class="fa-solid fa-arrow-up"></i> 5%</small>
                        </div>
                        <div class="text-muted small text-uppercase fw-bold mb-1"
                            style="font-size: 0.7rem; letter-spacing: 0.5px;">Active Orders</div>
                        <div class="h3 mb-0 fw-bold text-dark">85</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="p-2 rounded-3" style="background: rgba(201, 162, 77, 0.1);">
                                <i class="fas fa-receipt text-gold"></i>
                            </div>
                            <small class="text-muted fw-bold">Average</small>
                        </div>
                        <div class="text-muted small text-uppercase fw-bold mb-1"
                            style="font-size: 0.7rem; letter-spacing: 0.5px;">Avg. Order Value</div>
                        <div class="h3 mb-0 fw-bold text-dark">146 JOD</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100 p-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div class="p-2 rounded-3" style="background: rgba(228, 139, 154, 0.1);">
                                <i class="fas fa-users-viewfinder" style="color: var(--color-dusty-rose);"></i>
                            </div>
                            <small class="text-danger fw-bold"><i class="fa-solid fa-arrow-down"></i> 1%</small>
                        </div>
                        <div class="text-muted small text-uppercase fw-bold mb-1"
                            style="font-size: 0.7rem; letter-spacing: 0.5px;">Conversion Rate</div>
                        <div class="h3 mb-0 fw-bold text-dark">3.2%</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-4">
            <!-- Sales Chart -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header py-4 bg-white border-0 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-dark">Performance Trends</h6>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-light border-0" data-bs-toggle="dropdown"><i
                                    class="fa-solid fa-ellipsis-vertical"></i></button>
                            <div class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                <a class="dropdown-item py-2" href="#"><i class="fa-solid fa-download me-2 small"></i>
                                    Download Report</a>
                                <a class="dropdown-item py-2" href="#"><i class="fa-solid fa-share me-2 small"></i> Share
                                    Stats</a>
                            </div>
                        </div>
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
                    <div class="card-header py-4 bg-white border-0">
                        <h6 class="m-0 fw-bold text-dark">Sales by Style</h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="chart-pie pt-4 pb-2" style="height: 250px; width: 100%;">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small w-100">
                            <div class="d-flex justify-content-around">
                                <span class="d-flex align-items-center small"><i class="fas fa-circle me-2"
                                        style="color: #F6A6B2; font-size: 8px;"></i> Soft</span>
                                <span class="d-flex align-items-center small"><i class="fas fa-circle me-2"
                                        style="color: #1E1E1E; font-size: 8px;"></i> Alt</span>
                                <span class="d-flex align-items-center small"><i class="fas fa-circle me-2"
                                        style="color: #C9A24D; font-size: 8px;"></i> Luxury</span>
                            </div>
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