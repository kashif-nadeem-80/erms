<?php

session_start();
// $_SESSION['name']='kashif';
// echo "asdddddddddddddddddd".  print_r($_SESSION, TRUE) ;

// if (!isset($_SESSION['admin']) || $_SESSION['user_login_status'] != 1) {
if (!isset($_SESSION['admin']) ) {

  echo "<script>window.location.href = '../../index.php'; </script>";
  echo "<script> alert 'Check here....' </script>";

}

$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

?>

<!-- Main Sidebar Container -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->

  <!-- Sidebar -->

  <div class="sidebar">

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

          <a href="dashboard.php" class="nav-link <?php if ($curPageName == 'dashboard.php') echo "active" ?>">

            <i class="nav-icon fas fa-tachometer-alt"></i>

            <p>Dashboard</p>

          </a>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'project_add.php' or $curPageName == 'project_list.php' or $curPageName == 'project_list_inactive.php' or $curPageName == 'project_posts.php' or $curPageName == 'project_posts_edit.php' or $curPageName == 'project_edit.php' or $curPageName == 'projectPosts.php' or $curPageName == 'project_posts_edit2.php' or $curPageName == 'project_challan_view_post2.php' or $curPageName == 'project_view.php' or $curPageName == 'post_challan.php' or $curPageName == 'project_challan_view_post.php' or $curPageName == 'project_challan.php' or $curPageName == 'project_challan_edit.php'  or $curPageName == 'project_challan_view.php') { echo "menu-open"; } ?>">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-tasks "></i>

            <p>

              Projects

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">



            <li class="nav-item">

              <a href="project_add.php" class="nav-link <?php if ($curPageName == 'project_add.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Add Project

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="project_challan.php" class="nav-link <?php if ($curPageName == 'project_challan.php' or $curPageName == 'project_challan_edit.php' or $curPageName == 'project_challan_view.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Add Challan

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="projectPosts.php" class="nav-link <?php if ($curPageName == 'projectPosts.php' or $curPageName == 'project_posts_edit2.php' or $curPageName == 'project_challan_view_post2.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Add Post

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="project_list.php" class="nav-link <?php if ($curPageName == 'project_list.php' or $curPageName == 'project_posts.php' or $curPageName == 'project_posts_edit.php' or $curPageName == 'project_edit.php' or $curPageName == 'project_view.php' or $curPageName == 'post_challan.php' or $curPageName == 'project_challan_view_post.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Active Projects

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="project_list_inactive.php" class="nav-link <?php if ($curPageName == 'project_list_inactive.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  In-Active Projects

                </p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'applications_active.php' OR $curPageName == 'applications_expire.php' OR $curPageName == 'report_application_sumarize.php' OR $curPageName == 'report_overUnder_age.php') { echo "menu-open"; } ?>">

          <a href="#" class="nav-link ">

            <i class="nav-icon fa fa-print"></i>

            <p>

              Applications

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="report_application_sumarize.php" class="nav-link <?php if ($curPageName == 'report_application_sumarize.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Summarize Report

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="report_overUnder_age.php" class="nav-link <?php if ($curPageName == 'report_overUnder_age.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Over/Under Age</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="applications_active.php" class="nav-link <?php if ($curPageName == 'applications_active.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Active Projects

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="applications_expire.php" class="nav-link <?php if ($curPageName == 'applications_expire.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Expire Projects

                </p>

              </a>

            </li>
            <li class="nav-item">

              <a href="challan_thumbnail.php" class="nav-link <?php if ($curPageName == 'applications_expire.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Challan Thumnail

                </p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'rejection_under_inquiry.php' OR $curPageName == 'rejection_by_challan.php' OR $curPageName == 'rejection_by_age.php' OR $curPageName == 'rejection_age_relax.php' OR $curPageName == 'rejection_by_education.php' OR $curPageName == 'rejection_by_quota.php' OR $curPageName == 'rejection_accept_all.php' OR $curPageName == 'rejection_report.php') { echo "menu-open"; } ?>">

          <a href="#" class="nav-link ">

            <i class="nav-icon fa fa-window-close"></i>

            <p>

              Rejection Section

              <i class="right  fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="rejection_under_inquiry.php" class="nav-link <?php if ($curPageName == 'rejection_under_inquiry.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Status Under Inquiry</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="rejection_by_challan.php" class="nav-link <?php if ($curPageName == 'rejection_by_challan.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Rej. By Challan</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="rejection_by_age.php" class="nav-link <?php if ($curPageName == 'rejection_by_age.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Rej. Over/Under Age</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="rejection_age_relax.php" class="nav-link <?php if ($curPageName == 'rejection_age_relax.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Age Relaxation</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="rejection_by_quota.php" class="nav-link <?php if ($curPageName == 'rejection_by_quota.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Rej. By Quota</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="rejection_by_education.php" class="nav-link <?php if ($curPageName == 'rejection_by_education.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Rej. By Education</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="rejection_accept_all.php" class="nav-link <?php if ($curPageName == 'rejection_accept_all.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Status Accepted</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="rejection_report.php" class="nav-link <?php if ($curPageName == 'rejection_report.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Rej. Report</p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'assign_test_center.php' or $curPageName == 'assigned_test_center.php' or $curPageName == 'center_to_cadidates.php' or $curPageName == 'test_center.php' or $curPageName == 'test_center_edit.php' or $curPageName == 'test_center_details.php' or $curPageName == 'center_sessions.php' or $curPageName == 'merge_center_cities.php' or $curPageName == 'test_apply_info.php') { echo "menu-open"; } ?>">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-map-marker-alt"></i>

            <p>

              Assign Test Center

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="test_center.php" class="nav-link <?php if ($curPageName == 'test_center.php' or $curPageName == 'test_center_edit.php' or $curPageName == 'test_center_details.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Test Centers

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="center_sessions.php" class="nav-link <?php if ($curPageName == 'center_sessions.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Centers Sessions

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="test_apply_info.php" class="nav-link <?php if ($curPageName == 'test_apply_info.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Test Apply Info

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="merge_center_cities.php" class="nav-link <?php if ($curPageName == 'merge_center_cities.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Merge Center Cities

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="assign_test_center.php" class="nav-link <?php if ($curPageName == 'assign_test_center.php') echo " active bg-primary " ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>Assigning Center</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="assigned_test_center.php" class="nav-link <?php if ($curPageName == 'assigned_test_center.php') echo " active bg-primary " ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Assigned Center</p>

              </a>

            </li>

            <li class="nav-item">

              <a href="center_to_cadidates.php" class="nav-link <?php if ($curPageName == 'center_to_cadidates.php') echo " active bg-primary " ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>Center To Candidate</p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'roll_no_assign.php' or $curPageName == 'roll_no_list.php') { echo " menu-open "; } ?>">

          <a href="" class="nav-link">

            <i class="nav-icon fa fa-id-card-alt"></i>

            <p>

              Roll No

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="roll_no_assign.php" class="nav-link <?php if ($curPageName == 'roll_no_assign.php') echo "active bg-primary " ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Assign Roll No

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="roll_no_list.php" class="nav-link <?php if ($curPageName == 'roll_no_list.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Roll No Details

                </p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'candidate_list.php' or $curPageName == 'candidate_list2.php') { echo " menu-open "; } ?>">

          <a href="" class="nav-link">

            <i class="nav-icon fa fa-address-card"></i>

            <p>

              Attendance List

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <!-- <li class="nav-item">

              <a href="candidate_list.php" class="nav-link <?php if ($curPageName == 'candidate_list.php') echo "active bg-primary " ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>Post Wise List</p>

              </a>

            </li> -->

            <li class="nav-item">

              <a href="candidate_list2.php" class="nav-link <?php if ($curPageName == 'candidate_list2.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>Center Wise List</p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'result.php') { echo " menu-open "; } ?>">

          <a href="" class="nav-link">

            <i class="nav-icon fa fa-paste"></i>

            <p>

              Result

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="result.php" class="nav-link <?php if ($curPageName == 'result.php') echo "active bg-primary " ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Check Result

                </p>

              </a>

            </li>

          </ul>

        </li>



        <!-- <li class="nav-item has-treeview <?php if ($curPageName == 'challan_add.php' or $curPageName == 'challan_list.php') {

                                                echo "menu-open ";

                                              } ?> " >

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-receipt"></i>

            <p>

              Challan Form

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="challan_add.php" class="nav-link <?php if ($curPageName == 'challan_add.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Add Challan Form

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="challan_list.php" class="nav-link <?php if ($curPageName == 'challan_list.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Challan Details

                </p>

              </a>

            </li>

          </ul>

        </li> -->



        <li class="nav-item has-treeview <?php if ($curPageName == 'user_add.php' or $curPageName == 'user_list.php' or $curPageName == 'user_edit.php' or $curPageName == 'assign_project_operater.php' or $curPageName == 'assign_project_edit.php') {

                                            echo "menu-open";

                                          } ?>">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-users-cog"></i>

            <p>

              Management Users

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="user_add.php" class="nav-link <?php if ($curPageName == 'user_add.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Add Users

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="user_list.php" class="nav-link <?php if ($curPageName == 'user_list.php' or $curPageName == 'user_edit.php') echo "active bg-primary " ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Users Details

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="assign_project_operater.php" class="nav-link <?php if ($curPageName == 'assign_project_operater.php' or $curPageName == 'assign_project_edit.php') echo "active bg-primary " ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Assign Project

                </p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'registered_users.php' or $curPageName == 'registered_users_details.php') {

                                            echo "menu-open";

                                          } ?>">

          <a href="registered_users.php" class="nav-link <?php if ($curPageName == 'registered_users.php' or $curPageName == 'registered_users_details.php' or $curPageName == 'registered_user_update.php' OR $curPageName=='registered_education_update.php' OR $curPageName=='registered_exp_update.php' OR $curPageName =='registered_add_education.php' OR $curPageName == 'registered_add_experience.php') echo "active bg-primary" ?>">

            <i class="nav-icon fa fa-users"></i>

            <p>SignUp Candidates

              <i class="right fas"></i>

            </p>

          </a>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'report_dataentryoperator.php') {

                                            echo "menu-open";

                                          } ?>">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-chart-bar"></i>

            <p>

              Reports

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">

            <li class="nav-item">

              <a href="report_dataentryoperator.php" class="nav-link <?php if ($curPageName == 'report_dataentryoperator.php') echo "active bg-primary" ?>">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Operator Report

                </p>

              </a>

            </li>

          </ul>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'dbBackup.php') { echo "bg-primary rounded"; } ?>">

          <a href="dbBackup.php" class="nav-link">

            <i class="nav-icon fa fa-database"></i>

            <p>

              DB Backup

            </p>

          </a>

        </li>



        <li class="nav-item has-treeview <?php if ($curPageName == 'add_degree_level.php' or $curPageName == 'add_degree_level_edit.php' or $curPageName == 'add_degree.php' or $curPageName == 'add_degree_edit.php' or $curPageName == 'zone.php' or $curPageName == 'zone_edit.php' or $curPageName == 'domicile_province.php' or $curPageName == 'domicile_province_edit.php' or $curPageName == 'domicile_district.php' or $curPageName == 'domicile_district_edit.php' or $curPageName == 'test_city.php' or $curPageName == 'test_city_edit.php' or $curPageName == 'signatures.php') { echo "menu-open"; } ?>">

          <a href="#" class="nav-link">

            <i class="nav-icon fa fa-cog"></i>

            <p>

              Setting

              <i class="right fas fa-angle-left"></i>

            </p>

          </a>

          <ul class="nav nav-treeview">



            <li class="nav-item">

              <a href="add_degree_level.php" class="nav-link <?php if ($curPageName == 'add_degree_level.php' or $curPageName == 'add_degree_level_edit.php') echo "active bg-primary " ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Degree Level

                </p>

              </a>

            </li>

            <li class="nav-item">

              <a href="add_degree.php" class="nav-link <?php if ($curPageName == 'add_degree.php' or $curPageName == 'add_degree_edit.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Degree/Certificate

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="zone.php" class="nav-link <?php if ($curPageName == 'zone.php' or $curPageName == 'zone_edit.php') echo 'active bg-primary' ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Zone

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="domicile_province.php" class="nav-link <?php if ($curPageName == 'domicile_province.php' or $curPageName == 'domicile_province_edit.php') echo 'active bg-primary' ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Domicile Province

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="domicile_district.php" class="nav-link <?php if ($curPageName == 'domicile_district.php' or $curPageName == 'domicile_district_edit.php') echo "active bg-primary" ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Domicile District

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="test_city.php" class="nav-link <?php if ($curPageName == 'test_city.php' or $curPageName == 'test_city_edit.php') echo 'active bg-primary' ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  City & Test City's Name

                </p>

              </a>

            </li>



            <li class="nav-item">

              <a href="signatures.php" class="nav-link <?php if ($curPageName == 'signatures.php') echo 'active bg-primary ' ?> ">

                <i class="far fa-circle nav-icon"></i>

                <p>

                  Signatures

                </p>

              </a>

            </li>

          </ul>

        </li>



      </ul>

    </nav>

  </div>

</aside>