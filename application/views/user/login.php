<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login - Smart Parking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #b067c6ff, #e3c7ecff);
            min-height: 100vh;
        }
        .main-content {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: calc(100vh - 76px);
                padding: 2rem 0;
            }
        .navbar {
            background: linear-gradient(90deg, #bd5aeaff, #e1b9e7ff) !important;
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
    <div class="container d-flex justify-content-center align-items-center">
        <div class="login-card">
                <h2 class="text-center mb-4">User Login</h2>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?php echo base_url('user/auth'); ?>" method="post">
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
                    <a href="<?php echo base_url('user/register'); ?>" class="text-decoration-none">Create Account</a>
                    <span class="mx-2">|</span>
                    <a href="<?php echo base_url(); ?>" class="text-decoration-none">← Back to Home</a>
                </div>
            </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
