<?php
  session_start();
  if(!isset($_SESSION['executive']))
  {
    echo "<script>window.location.href = '../../index.php'; </script>";
  }
  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="dashboard.php"  class="d-block ml-5"><h4><center>U T S</center></h4></a>
      </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link <?php if($curPageName == 'dashboard.php') echo "active" ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- <li class="nav-item has-treeview <?php if($curPageName == '' OR $curPageName == 'project_add.php' OR $curPageName == 'project_list.php' OR $curPageName == 'project_list_inactive.php' OR $curPageName == 'project_posts.php' OR $curPageName == 'project_posts_edit.php' OR $curPageName == 'project_edit.php' OR $curPageName == 'project_view.php' OR $curPageName == 'post_challan.php' OR $curPageName == 'project_challan_view_post.php') { echo "menu-open"; } ?>">
          <a href="#" class="nav-link" >
            <i class="nav-icon fa fa-tasks "></i>
            <p>
              Projects
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="project_add.php" class="nav-link <?php if($curPageName == 'project_add.php') echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Add Project
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="project_list.php" class="nav-link <?php if($curPageName == 'project_list.php' OR $curPageName == 'project_posts.php' OR $curPageName == 'project_posts_edit.php' OR $curPageName == 'project_edit.php' OR $curPageName == 'project_view.php' OR $curPageName == 'post_challan.php' OR $curPageName == 'project_challan_view_post.php') echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Active Projects
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="project_list_inactive.php" class="nav-link <?php if($curPageName == 'project_list_inactive.php') echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  In-Active Projects
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview <?php if($curPageName == ''OR $curPageName == 'applications_active.php' OR $curPageName == 'applications_expire.php'  ) { echo "menu-open"; } ?>">
          <a href="#" class="nav-link ">
            <i class="nav-icon fa fa-print"></i>
            <p>
              Applications
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="applications_active.php" class="nav-link <?php if($curPageName=='applications_active.php') echo "active bg-primary" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Active Projects
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="applications_expire.php" class="nav-link <?php if($curPageName == 'applications_expire.php') echo "active bg-primary " ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Expire Projects
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview <?php if($curPageName == '' OR $curPageName == 'assign_test_center.php' OR $curPageName == 'assigned_test_center.php' OR $curPageName == 'center_to_cadidates.php') { echo "menu-open"; }?>">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-map-marker-alt"></i>
            <p>
              Assign Test Center
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="assign_test_center.php" class="nav-link <?php if($curPageName == 'assign_test_center.php') echo " active bg-primary " ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>Assigning Center</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="assigned_test_center.php" class="nav-link <?php if($curPageName == 'assigned_test_center.php') echo " active bg-primary " ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Assigned Center</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="center_to_cadidates.php" class="nav-link <?php if($curPageName == 'center_to_cadidates.php') echo " active bg-primary " ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Center To Candidate</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview">
          <a href="roll_no_list.php" class="nav-link <?php if($curPageName == 'roll_no_list.php') echo "active" ?>">
            <i class="nav-icon fa fa-id-card-alt"></i>
            <p>
              Roll No
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview <?php if($curPageName == '' OR $curPageName == 'candidate_list.php' OR $curPageName == 'candidate_list2.php') { echo " menu-open "; } ?>">
          <a href="" class="nav-link">
            <i class="nav-icon fa fa-address-card"></i>
            <p>
              Candidate List
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="candidate_list.php" class="nav-link <?php if($curPageName == 'candidate_list.php') echo "active bg-primary " ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Post Wise List
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="candidate_list2.php" class="nav-link <?php if($curPageName == 'candidate_list2.php') echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Project Wise List
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview <?php if($curPageName == '' OR $curPageName == 'challan_add.php' OR $curPageName == 'challan_list.php') { echo "menu-open "; }?> " >
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-receipt"></i>
            <p>
              Challan Form
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="challan_add.php" class="nav-link <?php if($curPageName == 'challan_add.php') echo "active bg-primary" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Add Challan Form
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="challan_list.php" class="nav-link <?php if($curPageName == 'challan_list.php') echo "active bg-primary" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Challan Details
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview <?php if($curPageName == '' OR $curPageName == 'user_add.php' OR $curPageName == 'user_list.php' OR $curPageName == 'user_edit.php') { echo "menu-open" ; } ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-users-cog"></i>
            <p>
              Management Users
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="user_add.php" class="nav-link <?php if($curPageName == 'user_add.php') echo "active bg-primary" ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Add Users
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="user_list.php" class="nav-link <?php if($curPageName == 'user_list.php' OR $curPageName == 'user_edit.php') echo "active bg-primary " ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Users Details
                </p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-item has-treeview <?php if($curPageName == '' OR $curPageName == 'registered_users.php' OR $curPageName == 'registered_users_details.php') { echo "menu-open"; } ?>">
          <a href="registered_users.php" class="nav-link <?php if($curPageName == 'registered_users.php' OR $curPageName == 'registered_users_details.php') echo "active bg-primary" ?>">
            <i class="nav-icon fa fa-users"></i>
            <p>
              Registered Users
              <i class="right fas"></i>
            </p>
          </a>
        </li>

        <li class="nav-item has-treeview <?php if($curPageName == '' OR $curPageName == 'add_degree_level.php' OR $curPageName == 'add_degree.php' OR $curPageName == 'project_challan.php' OR $curPageName == 'project_challan_edit.php' OR $curPageName == 'project_challan_view.php' OR $curPageName == 'test_center.php' OR $curPageName == 'test_center_edit.php' OR $curPageName == 'center_sessions.php' OR $curPageName == 'zone.php' OR $curPageName == 'zone_edit.php' OR $curPageName == 'domicile_province.php' OR $curPageName == 'domicile_province_edit.php' OR $curPageName == 'domicile_district.php' OR $curPageName == 'domicile_district_edit.php' OR $curPageName == 'test_city.php' OR $curPageName == 'test_city_edit.php' OR $curPageName == 'signatures.php') { echo "menu-open"; } ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-cog"></i>
            <p>
              Setting
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="add_degree_level.php" class="nav-link <?php if($curPageName == 'add_degree_level.php') echo "active bg-primary " ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Degree Level
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="add_degree.php" class="nav-link <?php if($curPageName == 'add_degree.php') echo "active bg-primary" ?> " >
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Degree/Certificate
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="project_challan.php" class="nav-link <?php if($curPageName == 'project_challan.php' OR $curPageName == 'project_challan_edit.php' OR $curPageName == 'project_challan_view.php') echo "active bg-primary" ?> " >
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Posts Challan
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="test_center.php" class="nav-link <?php if($curPageName == 'test_center.php' OR $curPageName == 'test_center_edit.php') echo "active bg-primary" ?> " >
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Test Centers
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="center_sessions.php" class="nav-link <?php if($curPageName == 'center_sessions.php') echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Centers Sessions
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="zone.php" class="nav-link <?php if($curPageName == 'zone.php' OR $curPageName == 'zone_edit.php') echo 'active bg-primary' ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Zone
                </p>
              </a>
            </li>
            
            <li class="nav-item">
              <a href="domicile_province.php" class="nav-link <?php if($curPageName == 'domicile_province.php' OR $curPageName == 'domicile_province_edit.php') echo 'active bg-primary' ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Domicile Province
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="domicile_district.php" class="nav-link <?php if($curPageName == 'domicile_district.php' OR $curPageName == 'domicile_district_edit.php') echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Domicile District
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="test_city.php" class="nav-link <?php if($curPageName == 'test_city.php' OR $curPageName == 'test_city_edit.php') echo 'active bg-primary' ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Test City
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="signatures.php" class="nav-link <?php if($curPageName == 'signatures.php') echo 'active bg-primary '?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>
                  Signatures
                </p>
              </a>
            </li>
          </ul>
        </li> -->

      </ul>
    </nav>
  </div>
</aside>