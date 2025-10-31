<?php include('header.php');?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 px-0" style="position:fixed">
            <div class="card border-0 shadow-sm">
                <div class="card-body m-0 p-0">
                    <?php include('sidebar.php');?>
                </div>
            </div>
        </div>
        <div class="col-9 offset-3 mt-4">
            <div class="row">
                <div class="col-12">
                   <div class="alert alert-info rounded-0" role="alert">The report shown below ranges only for 10 days from 10 days ago.</div>

                    <!-- Generate Report -->
                    <div class="container-fluid mt-3">
                        <div class="row">
                            <div class="col-lg-12 mx-auto">
                                <div class="card rounded-0 shadow-none">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <div class="card-title h6 mb-0"><i class="fas fa-file-alt"></i>&nbsp; Generate Report</div>
                                    </div>
                                    <div class="card-body">
                                        <form action="<?= base_url('admin/reports_generate'); ?>" method="get" target="_blank">
                                            <div class="row g-3 align-items-end">
                                                <div class="col-md-4">
                                                    <label for="filter_by" class="form-label">Filter By</label>
                                                    <select id="filter_by" name="filter_by" class="form-select" required>
                                                        <option value="vehicle_no">Vehicle No</option>
                                                        <option value="vehicle_name">Vehicle Name</option>
                                                        <option value="slot_no">Slot No</option>
                                                        <option value="booking_no">Booking No</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="query" class="form-label">Value</label>
                                                    <input type="text" id="query" name="query" class="form-control" placeholder="Enter value to search" required>
                                                </div>
                                                <div class="col-md-2 d-grid">
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-file-download"></i>&nbsp; Generate</button>
                                                </div>
                                            </div>
                                            <div class="form-text mt-2">Choose a filter and enter its value. A formatted report will open in a new tab.</div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $dataPoints = $this->datawork->entry_report();
                        $categoryData = $this->datawork->get_vehicle_category_stats();
                    ?>

                        <!-- Vehicle Category Distribution -->
                        <div class="container-fluid mt-4">
                            <div class="row">
                                <div class="col-lg-12 mx-auto">
                                    <div class="card rounded-0 shadow-none">
                                        <div class="card-header">
                                            <div class="card-title h6 mb-0"><i class="fas fa-chart-pie"></i>&nbsp; Vehicle Category Distribution</div>
                                        </div>
                                        <div class="card-body">
                                            <div id="pieChartContainer" style="height: 370px; width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Vehicle Parked Entries -->
                        <div class="container-fluid mt-4">
                            <div class="row">
                                <div class="col-lg-12 mx-auto">
                                    <div class="card rounded-0 shadow-none">
                                        <div class="card-header">
                                            <div class="card-title h6 mb-0"><i class="fas fa-chart-line"></i>&nbsp; Vehicle Parked Entries</div>
                                        </div>
                                        <div class="card-body">
                                            <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            window.onload = function() {
                                // Initialize pie chart
                                var categoryData = <?php echo json_encode($categoryData, JSON_NUMERIC_CHECK); ?>;
                                var pieChart = new CanvasJS.Chart("pieChartContainer", {
                                    animationEnabled: true,
                                    animationDuration: 2000,
                                    theme: "light2",
                                    title: {
                                        text: "Parked Vehicles by Category",
                                        padding: 20
                                    },
                                    data: [{
                                        type: "pie",
                                        startAngle: 240,
                                        showInLegend: true,
                                        legendText: "{label}",
                                        indexLabel: "{label}: {y}",
                                        toolTipContent: "{label}: <strong>{y} vehicles</strong>",
                                        dataPoints: categoryData
                                    }]
                                });
                                pieChart.render();

                                // Initialize line chart
                                var chart = new CanvasJS.Chart("chartContainer", {
                                    animationEnabled: true,
                                    theme: "light2",
                                    axisX: {
                                        valueFormatString: "MMM DD, Y"
                                    },
                                    axisY: {
                                        title: "Vehicle Parked Entries",
                                    },
                                    data: [{
                                        type: "splineArea",
                                        color: "#6599FF",
                                        xValueType: "dateTime",
                                        yValueFormatString: "#,##0 Entry",
                                        dataPoints: <?php echo json_encode($dataPoints); ?>
                                    }]
                                });
                                chart.render();
                            }
                        </script>
                        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>
