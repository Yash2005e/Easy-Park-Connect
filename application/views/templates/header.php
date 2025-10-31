<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-gradient fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="<?php echo base_url('user/login'); ?>">
            <img src="<?php echo base_url('assets/images/ico.png'); ?>" alt="Logo" height="30" class="me-2">
            Easy Park Connect
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-tie"></i> Manager
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo base_url('admin/login'); ?>">Login</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> User
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?php echo base_url('user/login'); ?>">Login</a></li>
                        <li><a class="dropdown-item" href="<?php echo base_url('user/register'); ?>">Register</a></li>
                    </ul>
                </li>
                <?php if($this->session->userdata('user_logged_in')): ?>
                <li class="nav-item ms-2">
                    <a class="nav-link" href="<?php echo base_url('user/logout'); ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div style="margin-top: 76px;"></div> <!-- Spacing for fixed navbar -->