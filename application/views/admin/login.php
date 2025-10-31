<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Smart Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0px 6px 20px rgba(0,0,0,0.2);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
    </style>
</head>
<body>
<?php $this->load->view('templates/header'); ?>

<div class="main-content">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="login-card">
                <h2 class="text-center mb-4">Parking Manager Login</h2>
                
                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('admin/auth'); ?>" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                
                                <div class="text-center mt-3">
                                        <!-- Open admin registration modal -->
                                        <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#adminRegisterModal">
                                                Create Account
                                        </button>
                                        <a href="<?php echo base_url(); ?>" class="text-decoration-none">← Back to Home</a>
                                </div>
            </div>
        </div>
    </div>
</div>

<!-- Admin Registration Modal (same theme as admin login) -->
<div class="modal fade" id="adminRegisterModal" tabindex="-1" role="dialog" aria-labelledby="adminRegisterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="adminRegisterModalLabel"><i class="fas fa-user-shield text-primary"></i> Register New Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="adminRegisterForm" action="<?php echo base_url('admin/register_admin'); ?>" method="post">
                    <div class="mb-3 text-start">
                        <label for="reg_username" class="form-label">Admin Username</label>
                        <input type="text" class="form-control" id="reg_username" name="username" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="reg_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="reg_password" name="password" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label for="reg_confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="reg_confirm_password" name="confirm_password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Create Admin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Client-side validation for admin register modal
    document.addEventListener('DOMContentLoaded', function(){
        const form = document.getElementById('adminRegisterForm');
        if(form){
            form.addEventListener('submit', function(e){
                const p = document.getElementById('reg_password').value;
                const cp = document.getElementById('reg_confirm_password').value;
                if(p !== cp){
                    e.preventDefault();
                    alert('Password and Confirm Password do not match');
                }
            });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>