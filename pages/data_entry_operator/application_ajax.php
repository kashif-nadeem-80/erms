<?php
include "includes/db.php";

if(isset($_POST['cnic_1']))
{
  $cnic_1 = $_POST['cnic_1'];
  $fetch = "SELECT * FROM candidates WHERE cnic = '$cnic_1'";
  $run = mysqli_query($connection,$fetch);
  $countRow = mysqli_num_rows($run);
  if($countRow == 0)
  {
    $data = array('record' => 0, 'cand_id' => 0);
  }
  else
  {
    $row = mysqli_fetch_array($run);
    $cand_id = $row['id'];
    $data = array('record' => $countRow, 'cand_id' => $cand_id);
  }
  echo json_encode($data);
}

if(isset($_POST['pro_domicile']))
{
  $pro_id = $_POST['pro_domicile'];
  $result = mysqli_query($connection, "SELECT * FROM district WHERE pro_id = '$pro_id'");
  echo "<option value=''>Choose</option>";
  while ($row = mysqli_fetch_array($result))
  {
    $id = $row["id"];
    $dis_name = $row['dis_name'];
    echo "<option value='$id'>$dis_name</option>";
  }
}
?>