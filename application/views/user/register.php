<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Register - Easy Park Connect</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background: linear-gradient(135deg, #d1b1d6ff, #9562b9ff); /* light blue + purple */
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      padding: 2.5rem 2rem;
      width: 100%;
      max-width: 420px;
      text-align: center;
    }

    .register-card h2 {
      color: #6788eaff;
      margin-bottom: 1.5rem;
      font-weight: 700;
    }

    .form-control:focus {
      border-color: #6f42c1;
      box-shadow: 0 0 0 0.2rem rgba(111,66,193,.25);
    }

    .btn-register {
      background: #7c99f1ff;
      background: linear-gradient(90deg, #4e73df, #6f42c1);
      color: white;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-register:hover {
      background: linear-gradient(90deg, #6f42c1, #4e73df);
      color: white;
    }

    .links {
      margin-top: 1rem;
    }

    .links a {
      color: #89a5f8ff;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    .links a:hover {
      color: #6940b5ff;
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="register-card">
    <h2>Create Account</h2>

    <?php if($this->session->flashdata('error')): ?>
      <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('user/register_submit'); ?>" method="post">
      <div class="mb-3 text-start">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>

      <div class="mb-3 text-start">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="mb-3 text-start">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-register">Create Account</button>
      </div>
    </form>

    <div class="links">
      <a href="<?= base_url('user/login'); ?>">Already have an account? Login</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
