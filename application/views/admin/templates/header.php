<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo base_url('admin'); ?>">
            <img src="<?php echo base_url('assets/images/ico.png'); ?>" alt="Logo" height="30" class="me-2">
            Admin Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left side menu -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url('admin'); ?>">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <!-- Add more admin menu items here -->
            </ul>
            
            <!-- Right side menu -->
            <ul class="navbar-nav ms-auto">
                <!-- User Login/Register Button -->
                <li class="nav-item me-3">
                    <a href="<?php echo base_url('user/login'); ?>" class="btn btn-light me-2">
                        <i class="fas fa-sign-in-alt"></i> User Login
                    </a>
                    <a href="<?php echo base_url('user/register'); ?>" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </li>
                
                <!-- Admin Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle btn btn-outline-light" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-tie"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo base_url('admin/profile'); ?>">
                            <i class="fas fa-user-circle"></i> Profile
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?php echo base_url('admin/logout'); ?>">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div style="margin-top: 76px;"></div> <!-- Spacing for fixed navbar -->

<style>
.navbar {
    background: linear-gradient(90deg, #4e73df, #1cc88a) !important;
    padding: 0.75rem 1rem;
}
.navbar .btn-outline-light {
    border-color: rgba(255,255,255,0.3);
}
.navbar .btn-outline-light:hover {
    background-color: rgba(255,255,255,0.1);
}
.navbar .btn-danger {
    background-color: #e74a3b;
    border-color: #e74a3b;
}
.navbar .btn-danger:hover {
    background-color: #d52a1a;
    border-color: #d52a1a;
}
</style>