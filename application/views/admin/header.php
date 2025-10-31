<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Easy Park Connect</title>
<link rel="icon" href="<?=base_url('assets/images/ico.png');?>">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>

<style>
html, body {
    height: 100%;
    width: 100%;
    font-family: Quicksand;
}

/* Header */
.navbar-nav .nav-link.btn-outline-light {
    color: white;
    transition: all 0.3s ease;
}
.navbar-nav .nav-link.btn-outline-light:hover {
    color: #6f42c1;
    background-color: white;
    border-color: #6f42c1;
}

/* Sidebar */
#sidebar {
    position: fixed;
    top: 56px; /* same as header height */
    left: 0;
    bottom: 0;
    width: 220px;
    overflow-y: auto;
    background-color: #1e1e2f;
    padding-top: 0.5rem;
}
#sidebar .list-group-item-action {
    background-color: #1e1e2f;
    color: #ccc;
    border: none;
    padding: 12px 20px;
    transition: all 0.2s;
}
#sidebar .list-group-item-action:hover {
    background-color: #3b82f6;
    color: #fff;
}
#sidebar .list-group-item-action.active {
    background-color: #3b82f6;
    color: #fff;
    font-weight: 500;
}
#sidebar .list-group-item-action i {
    width: 20px;
}
#sidebar::-webkit-scrollbar {
    width: 6px;
}
#sidebar::-webkit-scrollbar-thumb {
    background-color: rgba(255,255,255,0.2);
    border-radius: 3px;
}

/* Main content adjusts to sidebar */
#mainContent {
    margin-left: 220px;
    padding: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    #sidebar {
        width: 180px;
    }
    #mainContent {
        margin-left: 180px;
    }
}
</style>
</head>
<body class="bg-light">

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('admin/index') ?>">
            <img src="<?= base_url('assets/images/ico.png') ?>" alt="Logo" height="30" class="d-inline-block align-text-top me-2">
            Admin Dashboard
        </a>

        <ul class="navbar-nav ms-auto d-flex align-items-center">
            <li class="nav-item">
                <a href="<?= base_url('user/login') ?>" class="nav-link btn btn-sm btn-outline-light me-1">
                    <i class="fas fa-sign-in-alt"></i> User Login
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('user/register') ?>" class="nav-link btn btn-sm btn-success me-1">
                    <i class="fas fa-user-plus"></i> Register
                </a>
            </li>
            <li class="nav-item">
                <a href="<?=base_url('admin/logout');?>" class="nav-link btn btn-sm btn-primary">
                    <i class="fas fa-power-off"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- Sidebar -->
<div class="list-group list-group-flush" id="sidebar">
    <a class="list-group-item list-group-item-action border-0" style="pointer-events: none"></a>

    <a href="<?=base_url('admin/index');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='index'){echo 'active';}?>">
        <i class="fas fa-tachometer-alt"></i>&nbsp; Dashboard
    </a>

    <a href="<?=base_url('admin/category');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='category'){echo 'active';}?>">
        <i class="fas fa-box"></i>&nbsp; Category
    </a>

    <a href="<?=base_url('admin/add_vehicle');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='add_vehicle'){echo 'active';}?>">
        <i class="fas fa-file-import"></i>&nbsp; Vehicle Entry
    </a>

    <a href="<?=base_url('admin/manage_vehicle');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='manage_vehicle'){echo 'active';}?>">
        <i class="fas fa-tasks"></i>&nbsp; Manage Vehicles
    </a>

    <a href="<?=base_url('admin/reports');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='reports'){echo 'active';}?>">
        <i class="fas fa-chart-line"></i>&nbsp; Reports
    </a>

    <a href="<?=base_url('admin/search');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='search'){echo 'active';}?>">
        <i class="fas fa-search"></i>&nbsp; Search
    </a>

    <a href="<?=base_url('admin/setting');?>" class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='setting'){echo 'active';}?>">
        <i class="fas fa-cog"></i>&nbsp; Account Setting
    </a>

    <a href="<?=base_url('admin/logout');?>" class="list-group-item list-group-item-action" id="sidebarLogout">
        <i class="fas fa-power-off"></i>&nbsp; Logout
    </a>
</div>

<!-- Main content -->
<div id="mainContent">
    <!-- Your page content here -->
</div>

<script>
$(document).ready(function(){
    $("#sidebarLogout").on("click", function(e){
        e.preventDefault();
        let url = $(this).attr("href");
        if(confirm("Are you sure you want to logout?")){
            $("body").fadeOut(400, function(){
                window.location.href = url;
            });
        }
    });
});
</script>

</body>
</html>
