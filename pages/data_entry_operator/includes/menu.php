<?php
  session_start();
  if(!isset($_SESSION['DataEntryOperator']))
  {
    echo "<script>window.location.href = '../../index.php'; </script>";
  }
  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
  $dataEntryId = $_SESSION['DataEntryOperator'];

  $fetchDataG= "SELECT p.id FROM project_to_operator AS o INNER JOIN projects_posts AS p ON p.id = o.post_id WHERE o.status = '1' AND o.operator_id = '$dataEntryId'";
  $runDataG = mysqli_query($connection,$fetchDataG);
  @$totalProjG = mysqli_num_rows($runDataG);
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
      <?php if($totalProjG == 0)
      {
        echo '<p class="text-danger font-weight-bold ml-3">No Project Assigned</p>';
      }
      else
      { ?>
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item has-treeview <?php if($curPageName == 'application_add.php' OR $curPageName == 'application_list.php' OR $curPageName == 'application_summary.php') { echo "menu-open"; } ?>">
          <a href="#" class="nav-link" >
            <i class="nav-icon fa fa-tasks "></i>
            <p>
              Application
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="application_add.php" class="nav-link <?php if($curPageName == 'application_add.php') echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Application</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="application_list.php" class="nav-link <?php if($curPageName == 'application_list.php' ) echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>Application Details</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="application_summary.php" class="nav-link <?php if($curPageName == 'application_summary.php' ) echo "active bg-primary" ?> ">
                <i class="far fa-circle nav-icon"></i>
                <p>Sumarize Report</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    <?php } ?>
    </nav>
  </div>
</aside>