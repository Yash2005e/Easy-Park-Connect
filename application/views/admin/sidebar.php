<style>
  /* Sidebar container */
  #sidebar {
    position: fixed;
    top: 56px; /* height of your header */
    left: 0;
    bottom: 0;
    width: 220px;
    overflow-y: auto;
    background-color: #1e1e2f; /* dark theme similar to admin */
    padding-top: 0.5rem;
  }

  /* Sidebar links */
  #sidebar .list-group-item-action {
    background-color: #1e1e2f;
    color: #ccc;
    border: none;
    padding: 12px 20px;
    transition: all 0.2s ease-in-out;
  }

  /* Hover effect */
  #sidebar .list-group-item-action:hover {
    background-color: #3b82f6; /* light blue/purple mix */
    color: #fff;
  }

  /* Active link */
  #sidebar .list-group-item-action.active {
    background-color: #3b82f6;
    color: #fff;
    font-weight: 500;
  }

  /* Icon spacing */
  #sidebar .list-group-item-action i {
    width: 20px;
  }

  /* Make scrollbar subtle */
  #sidebar::-webkit-scrollbar {
    width: 6px;
  }
  #sidebar::-webkit-scrollbar-thumb {
    background-color: rgba(255,255,255,0.2);
    border-radius: 3px;
  }

  /* Push content to the right of sidebar */
  #mainContent {
    margin-left: 220px;
    padding: 20px;
  }

  /* Optional: keep sidebar visible on small screens */
  @media (max-width: 768px) {
    #sidebar {
      width: 180px;
    }
    #mainContent {
      margin-left: 180px;
    }
  }
</style>

<div class="list-group list-group-flush" id="sidebar">
  <a class="list-group-item list-group-item-action border-0" style="pointer-events: none"></a>

  <a href="<?=base_url('admin/index');?>" 
     class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='index'){echo 'active';}?>">
     <i class="fas fa-tachometer-alt"></i>&nbsp; Dashboard
  </a>

  <a href="<?=base_url('admin/category');?>" 
     class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='category'){echo 'active';}?>">
     <i class="fas fa-box"></i>&nbsp; Category
  </a>

  <a href="<?=base_url('admin/add_vehicle');?>" 
     class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='add_vehicle'){echo 'active';}?>">
     <i class="fas fa-file-import"></i>&nbsp; Vehicle Entry
  </a>

  <a href="<?=base_url('admin/manage_vehicle');?>" 
     class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='manage_vehicle'){echo 'active';}?>">
     <i class="fas fa-tasks"></i>&nbsp; Manage Vehicles
  </a>

  <a href="<?=base_url('admin/reports');?>" 
     class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='reports'){echo 'active';}?>">
     <i class="fas fa-chart-line"></i>&nbsp; Reports
  </a>

  <a href="<?=base_url('admin/search');?>" 
     class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='search'){echo 'active';}?>">
     <i class="fas fa-search"></i>&nbsp; Search
  </a>

  <a href="<?=base_url('admin/setting');?>" 
     class="list-group-item list-group-item-action <?php if($this->uri->segment(2)=='setting'){echo 'active';}?>">
     <i class="fas fa-cog"></i>&nbsp; Account Setting
  </a>

  <a href="<?=base_url('admin/logout');?>" class="list-group-item list-group-item-action" id="sidebarLogout">
     <i class="fas fa-power-off"></i>&nbsp; Logout
  </a>
</div>

<!-- JS for logout confirmation -->
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

<!-- Wrap main content -->
<div id="mainContent">
  <!-- Your page content here -->
</div>
