<?php
  session_start();
  unset($_SESSION['candd_id']);
  echo "<script>window.location.href = '../../../online_registration.php';</script>";

?>