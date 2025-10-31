<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Easy Park Connect</title>
    <link rel="icon" href="<?=base_url('assets/images/ico.png');?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

    <style>
        body {
            font-family: Quicksand, sans-serif;
            background: linear-gradient(135deg, #d5c4e7ff, #8965b3ff);
            min-height: 100vh;
        }
        .card, .login-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            animation: fadeInUp 0.8s ease;
        }
        @keyframes fadeInUp {
            from {opacity:0; transform:translateY(30px);}
            to {opacity:1; transform:translateY(0);}
        }
        .form-control {
            border-radius: 10px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #6e96d7ff;
            box-shadow: 0 0 8px rgba(171, 200, 246, 0.5);
        }
        .btn-custom {
            background: linear-gradient(135deg, #628bcdff, #8967c8ff);
            border: none;
            color: white;
            border-radius: 50px;
            transition: 0.3s;
        }
        .btn-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(130,177,255,0.4);
        }
        .toggle-password {
            cursor: pointer;
            position: absolute;
            right: 15px;
            top: 55%;
            transform: translateY(-50%);
            color: gray;
        }
        .user-login {
            background: white;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <!-- Role Selection Modal -->
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content rounded-3 shadow">
          <div class="modal-header border-0">
            <h5 class="modal-title" id="roleModalLabel"><i class="fas fa-car-side text-primary"></i> Easy Park Connect</h5>
          </div>
          <div class="modal-body text-center">
            <p class="text-muted">Please choose your role to continue:</p>
            <button id="managerBtn" class="btn btn-custom btn-block my-2">I am a Parking Manager</button>
            <button id="userBtn" class="btn btn-secondary btn-block my-2">I am a User</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Admin Login Section -->
    <div class="container my-5" id="adminLoginSection" style="display:none;">
        <div class="row">
            <div class="col-lg-6 mx-auto mt-5">
                <?=$this->session->flashdata('error');?>
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="h5 text-center text-muted"><i class="fas fa-sign-in-alt text-primary"></i>&nbsp; Admin Login</h5>
                        <form id="adminLoginForm" action="<?=base_url('home/index');?>" method="post" class="mt-4">
                            <label class="m-0 p-0 text-muted">Username</label>
                            <input type="text" name="username" id="admin_username" class="form-control form-control-sm shadow-none" required>
                            <label class="m-0 p-0 mt-3 text-muted">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" id="admin_password" class="form-control form-control-sm shadow-none" required>
                                <i class="fas fa-eye toggle-password" id="toggleAdminPassword"></i>
                            </div>
                            <input type="submit" class="btn btn-custom btn-block mt-4 shadow-none" value="Login">
                        </form>
                        <div class="text-center mt-3">
                            <!-- Open admin registration modal (Bootstrap 4 syntax) -->
                            <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#adminRegisterModal">
                                <i class="fas fa-user-plus"></i> Register New Admin
                            </button>
                            <span class="mx-2">|</span>
                            <a href="<?=base_url();?>" class="text-decoration-none">← Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Login Section -->
    <div class="container my-5" id="userLoginSection" style="display:none;">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-card">
                    <h2 class="text-center mb-4">User Login</h2>
                    
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo base_url('user/auth'); ?>" method="post">
                        <div class="mb-3">
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="user_username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="user_password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                    
                    <div class="text-center mt-3">
                        <a href="<?php echo base_url('user/register'); ?>" class="text-decoration-none">Create Account</a>
                        <span class="mx-2">|</span>
                        <a href="<?php echo base_url(); ?>" class="text-decoration-none">← Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show modal on page load
        $(document).ready(function(){
            $('#roleModal').modal('show');
        });

        // Manager selected
        $('#managerBtn').on('click', function(){
            $('#roleModal').modal('hide');
            $('#adminLoginSection').fadeIn();
        });

        // User selected - redirect to user login page
        $('#userBtn').on('click', function(){
            window.location.href = '<?= base_url("user/login"); ?>';
        });

        // Toggle Admin Password
        const toggleAdminPassword = document.getElementById("toggleAdminPassword");
        const adminPassword = document.getElementById("admin_password");
        toggleAdminPassword.addEventListener("click", function () {
            const type = adminPassword.getAttribute("type") === "password" ? "text" : "password";
            adminPassword.setAttribute("type", type);
            this.classList.toggle("fa-eye-slash");
        });

        // Admin Form Validation
        document.getElementById("adminLoginForm").addEventListener("submit", function(e){
            const user = document.getElementById("admin_username").value.trim();
            const pass = document.getElementById("admin_password").value.trim();
            if(user.length < 3){
                alert("Username must be at least 3 characters long!");
                e.preventDefault();
            }
            if(pass.length < 4){
                alert("Password must be at least 4 characters long!");
                e.preventDefault();
            }
        });
    </script>
    
            <!-- Admin Registration Modal (Bootstrap 4 markup) -->
            <div class="modal fade" id="adminRegisterModal" tabindex="-1" role="dialog" aria-labelledby="adminRegisterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content rounded-3 shadow">
                        <div class="modal-header border-0">
                            <h5 class="modal-title" id="adminRegisterModalLabel"><i class="fas fa-user-shield text-primary"></i> Register New Admin</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="adminRegisterForm" action="<?= base_url('admin/register_admin'); ?>" method="post">
                                <div class="form-group text-left">
                                    <label for="reg_username">Admin Username</label>
                                    <input type="text" class="form-control" id="reg_username" name="username" required>
                                </div>
                                <div class="form-group text-left mt-2">
                                    <label for="reg_password">Password</label>
                                    <input type="password" class="form-control" id="reg_password" name="password" required>
                                </div>
                                <div class="form-group text-left mt-2">
                                    <label for="reg_confirm_password">Confirm Password</label>
                                    <input type="password" class="form-control" id="reg_confirm_password" name="confirm_password" required>
                                </div>
                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn btn-primary">Create Admin</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Simple client-side password match validation (works regardless of bootstrap version)
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
</body>
</html>
