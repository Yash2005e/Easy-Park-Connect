<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Smart Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fc;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .card-header {
            background: linear-gradient(90deg, #4e73df, #1cc88a);
            color: white;
            border: none;
            border-radius: 10px 10px 0 0 !important;
        }
        /* Navigation button styles */
        .navbar .btn-light {
            color: #4e73df;
            border-color: #fff;
            background-color: #fff;
        }
        .navbar .btn-light:hover {
            background-color: #f8f9fc;
        }
        .navbar .btn-success {
            background-color: #1cc88a;
            border-color: #1cc88a;
        }
        .navbar .btn-success:hover {
            background-color: #169b6b;
            border-color: #169b6b;
        }
    </style>
</head>
<body>

<?php $this->load->view('admin/templates/header'); ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <!-- Parking Areas Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Parking Areas</h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">7</div>
                            <div class="text-xs text-muted">Total Areas</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-parking fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicles Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold">Vehicles</h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
                            <div class="text-xs text-muted">Currently Parked</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add more dashboard cards as needed -->
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Add your main content here -->
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>