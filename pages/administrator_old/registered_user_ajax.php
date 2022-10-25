<?php

include "includes/db.php";
include "includes/css_links.php";

if (isset($_POST['pro_domicile'])) {
    $pro_id = $_POST['pro_domicile'];
    $result = mysqli_query($connection, "SELECT * FROM district WHERE pro_id = '$pro_id'");
    echo "<option value=''>Choose</option>";
    while ($row = mysqli_fetch_array($result)) {
        $id = $row["id"];
        $dis_name = $row['dis_name'];
        echo "<option value='$id'>$dis_name</option>";
    }
}

?>