<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Smart Parking Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            min-height: 100vh;
        }
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 76px);
        }
        .navbar {
            background: linear-gradient(90deg, #4e73df, #1cc88a) !important;
        }
        .role-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
        }
        .role-card:hover {
            transform: translateY(-10px);
        }
        .logo {
            max-width: 120px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
<?php $this->load->view('templates/header'); ?>

<div class="main-content">
    <div class="container">
    <div class="text-center mb-5">
        <img src="<?php echo base_url('assets/images/ico.png'); ?>" alt="Logo" class="logo">
        <h1 class="text-white mb-4">Smart Parking Management System</h1>
    </div>
    
    <div class="row justify-content-center">
        <!-- Admin/Manager Card -->
        <div class="col-md-5 col-lg-4 mb-4">
            <div class="role-card p-4 text-center">
                <i class="fas fa-user-tie fa-3x text-primary mb-3"></i>
                <h3>Parking Manager</h3>
                <p class="text-muted">Manage parking areas, monitor vehicles, and view reports</p>
                <a href="<?php echo base_url('admin/login'); ?>" class="btn btn-primary btn-lg w-100">Login as Manager</a>
            </div>
        </div>

        <!-- User Card -->
        <div class="col-md-5 col-lg-4 mb-4">
            <div class="role-card p-4 text-center">
                <i class="fas fa-car fa-3x text-success mb-3"></i>
                <h3>User</h3>
                <p class="text-muted">Find parking spots and manage your vehicles</p>
                <a href="<?php echo base_url('user/login'); ?>" class="btn btn-success btn-lg w-100 mb-2">Login</a>
                <a href="<?php echo base_url('user/register'); ?>" class="btn btn-outline-success w-100">Create Account</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>