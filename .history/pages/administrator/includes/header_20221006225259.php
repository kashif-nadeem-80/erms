<?php
  include('includes/db.php');
  date_default_timezone_set("Asia/Karachi");
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
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

  <?php
    // include('menu.php');
  ?>
    <style>

      #preloader {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          z-index:1000;
          /* background: rgba(1,1,1,1); */
            width: 100%;
            z-index: 999;
                    height: 100%!important;
      }
      #loader {
          display: block;
          position: relative;
          left: 50%;
          top: 50%;
          width: 150px;
          height: 150px;
          margin: -75px 0 0 -75px;
          border-radius: 50%;
          border: 3px solid transparent;
          border-top-color: #00008B;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;
      }
      #loader:before {
          content: "";
          position: absolute;
          top: 5px;
          left: 5px;
          right: 5px;
          bottom: 5px;
          border-radius: 50%;
          border: 3px solid transparent;
          border-top-color: #191970;
          -webkit-animation: spin 3s linear infinite;
          animation: spin 3s linear infinite;
      }
      #loader:after {
          content: "";
          position: absolute;
          top: 15px;
          left: 15px;
          right: 15px;
          bottom: 15px;
          border-radius: 50%;
          border: 3px solid transparent;
          border-top-color: #0C274B;
          -webkit-animation: spin 1.5s linear infinite;
          animation: spin 1.5s linear infinite;
      }
      @-webkit-keyframes spin {
          0%   {
              -webkit-transform: rotate(0deg);
              -ms-transform: rotate(0deg);
              transform: rotate(0deg);
          }
          100% {
              -webkit-transform: rotate(360deg);
              -ms-transform: rotate(360deg);
              transform: rotate(360deg);
          }
      }
      @keyframes spin {
          0%   {
              -webkit-transform: rotate(0deg);
              -ms-transform: rotate(0deg);
              transform: rotate(0deg);
          }
          100% {
              -webkit-transform: rotate(360deg);
              -ms-transform: rotate(360deg);
              transform: rotate(360deg);
          }
      }
    </style>
  <div id="preloader">
    <div id="loader"></div>
  </div>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!--Mian Content start here--->

<?php

  if (isset($_POST['logOut']))
  {
    unset($_SESSION['admin']);
    echo "<script>window.location.href = '../../admin.php';</script>";
  }

?>