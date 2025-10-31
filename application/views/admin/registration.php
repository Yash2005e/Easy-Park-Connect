<?php include('header.php'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-3 px-0" style="position:fixed">
            <div class="card border-0 shadow-sm">
                <div class="card-body m-0 p-0">
                    <?php include('sidebar.php'); ?>
                </div>
            </div>
        </div>
        <div class="col-9 offset-3 mt-4">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="fas fa-user-plus"></i> Register New Admin</h5>
                        </div>
                        <div class="card-body">
                            <?php if($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?= $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?= $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>

                            <form action="<?= base_url('admin/register_admin'); ?>" method="post">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                    <?php echo form_error('username', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <?php echo form_error('password', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    <?php echo form_error('confirm_password', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="admin_role" class="form-label">Admin Role</label>
                                    <select class="form-select" id="admin_role" name="admin_role" required>
                                        <option value="super_admin">Super Admin</option>
                                        <option value="manager">Parking Manager</option>
                                        <option value="operator">Parking Operator</option>
                                    </select>
                                    <?php echo form_error('admin_role', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                                    <?php echo form_error('full_name', '<div class="text-danger">', '</div>'); ?>
                                </div>

                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Register Admin</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>