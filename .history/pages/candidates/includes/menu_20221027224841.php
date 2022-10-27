<?php
  
  if(!isset($_SESSION['candd_id']))
  {
    echo "<script>window.location.href = '../../online_registration.php'; </script>";
  }
  
  $canddate_id = $_SESSION['candd_id'];
  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<!-- Main Sidebar Container -->
<!-- <aside class="main-sidebar sidebar-dark-primary elevation-4 bg-cyan"> -->
<!-- <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:rgb(55,59, 99);"> -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color:rgb(25,60, 99);">
  <!-- Brand Logo -->
  <!-- Sidebar -->
  <div class="sidebar ">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info ml-5">
        <a href="dashboard.php">
          <img src="../../images/logo.png" style="width: 90px; height: 80px">
        </a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?php if($curPageName == 'dashboard.php') echo "active" ?>">
            <i class="nav-icon fa fa-clock"></i>
            <p>Dashboard</p>
          </a>
        </li>

        

        <!-- <li class="nav-item ">
          <a href="personal_info_view.php" class="nav-link <?php if($curPageName == 'personal_info_view.php') echo "active" ?>">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Profile
            </p>
          </a>
        </li> -->

        <!-- <li class="nav-item">
          <a href="personal_information.php"  class="nav-link <?php if($curPageName == 'personal_information.php') echo "active" ?>">
            <i class="nav-icon fa fa-user-edit"></i>
            <p>
             Update Profile
            </p>
          </a>
        </li> -->

        <!-- <li class="nav-item">
          <a href="education_add.php" class="nav-link <?php if($curPageName == 'education_add.php') echo "active" ?>">
            <i class="nav-icon fa fa-user-graduate"></i>
            <p>
              Education
            </p>
          </a>
        </li> -->

        <!-- <li class="nav-item">
          <a href="employement_experince.php" class="nav-link <?php if($curPageName == 'employement_experince.php') echo "active" ?>">
            <i class="nav-icon fa fa-business-time"></i>
            <p>
              Experience
            </p>
          </a>
        </li> -->

        
        <!-- <li class="nav-item">
          <a href="apply.php" class="nav-link <?php if($curPageName == 'apply.php' OR $curPageName == 'post_apply.php' OR $curPageName == 'candidate_bank_challan.php' ) echo "active" ?>">
            <i class="nav-icon fa fa-tasks"></i>
            <p>
            Posts to Apply 
            </p>
          </a>
        </li> -->

        <li class="nav-item">
          <a href="posts_applied.php" class="nav-link <?php if($curPageName == 'posts_applied.php' OR $curPageName == 'candidate_apply_info.php') echo "active" ?>">
            <i class="nav-icon fa fa-receipt"></i>
            <p>
              Print/Upload Chalan
            </p>
          </a>
        </li>

        <!-- <li class="nav-item">
          <a href="roll_no.php" class="nav-link <?php if($curPageName == 'roll_no.php' OR $curPageName == 'roll_no.php' OR $curPageName == 'roll_no_view.php') echo "active" ?>">
            <i class="nav-icon fa fa-scroll"></i>
            <p>
              Roll No
            </p>
          </a>
        </li> -->
        <!-- <li class="nav-item">
          <a href="change_city.php" class="nav-link <?php if($curPageName == 'change_city.php') echo "active" ?>">
            <i class="nav-icon fa fa-exchange-alt"></i>
            <p>
             Change Test City
            </p>
          </a>
        </li> -->
        
      
 <li class="nav-item">
 <a href="candidate_apply_info2.php?apply_id=<?php echo $canddate_id ?>&proj_id=<?php echo "33" ?>" 
 class="nav-link <?php if($curPageName == 'candidate_apply_info2.php') echo "active" ?> " > 
  <i class="nav-icon fa fa-scroll"></i>
            <p>
             Final Application
            </p>
          </a>
        </li>
         
        <li class="nav-item">
          <a href="change_password.php" class="nav-link <?php if($curPageName == 'change_password.php') echo "active" ?>">
            <i class="nav-icon fa fa-keyboard"></i>
            <p>
             Change Password
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="includes/logout.php" class="nav-link">
            <i class="nav-icon fa fa-sign-out-alt"></i>
            <p>
              Sign Out
            </p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>