<?php
  include('includes/db.php');
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

<!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>UTS</title>
  <link rel="shortcut icon" href="../../images/logo.png" type="image/png">
  <?php
    include('css_links.php');
  ?>

</head>


<body class="sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Sign Out Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" title="Sign Out" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header bg-dark text-white">Sign Out</span>
          <div class="dropdown-divider"></div><br>
          <center>
             <img src="../../images/logo.png" width="100px" height="100px">
             <br>
             <a href="change_password.php"><u>Change Password</u></a><br>
             <br>
             <form method="post">
              <input type="submit" name="logOut" value="Sign Out" class="btn btn-primary text-white shadow">
             </form>
          </center><br>

        </div>
      </li>

      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <?php
    include('menu.php');
  ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!--Mian Content start here--->
   
<?php

  if (isset($_POST['logOut']))
  {
    unset($_SESSION['executive']);
    echo "<script>window.location.href = '../../index.php';</script>";
  }

?>