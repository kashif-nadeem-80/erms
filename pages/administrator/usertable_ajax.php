<?php include "includes/db.php"; ?>

<?php
                $count = 0;
                $query = "SELECT d.dis_name, c.id, c.name, c.cnic, c.email, c.phone, c.password,c.image,c.signUpDate, c.f_name, c.gender, c.disability, c.dob, c.postal_address, c.telephone,c.religion, c.gov_employee, c.simple_exper, c.retired_pak, c.army_exper,c.widow_gov_emp,c.id,c.disable_file,c.widow_file,c.status FROM `candidates` AS c 
                LEFT JOIN district AS d ON d.id = c.district_id
                LEFT JOIN zone AS z ON z.id = d.zone_id
                LEFT JOIN province AS p ON p.id = d.pro_id
                WHERE c.created_by = '0' ORDER BY c.name ASC";
                $result = mysqli_query($connection, $query);
                while ($rowData = mysqli_fetch_array($result)) {
                  $count++;
                  $id = $rowData['id'];
                  $name = $rowData['name'];
                  $cnic = $rowData['cnic'];
                  $f_name = $rowData['f_name'];
                  $gender = $rowData['gender'];
                  if ($rowData['dob'] != '') {
                    $dob = date("d-m-Y", strtotime($rowData['dob']));
                  } else {
                    $dob = "";
                  }

                  $phone = $rowData['phone'];
                  $dis_name = $rowData['dis_name'];
                  $password = $rowData['password'];
                  $status = $rowData['status'];
                  $status = $rowData['status'];
                  $image = $rowData['image'];
                  $imagePath = "../../images/candidates/profile picture/".$image;
                ?>
                  <tr>
                    <td><?php echo $count ?></td>
                    <td>
                      <?php if($image == '') { echo "Image Not Found"; } else { ?>
                      <img src="<?php echo $imagePath; ?>" class="rounded" width="70px" height="70px">
                    <?php } ?>
                    </td>
                    <td><?php echo $name ?></td>
                    <td><?php echo $cnic ?></td>
                    <td><?php echo $f_name ?></td>
                    <td><?php echo $gender ?></td>
                    <td><?php echo $dob ?></td>
                    <td><?php echo $phone ?></td>
                    <td><?php echo $dis_name ?></td>
                    <td><?php echo $password ?></td>
                    <td>
                        <?php
                        if($status == 1)
                        {
                            echo "<i class='fa fa-check text-success'></i> Verified";
                        }
                        else
                        {
                            echo "<i class='fa fa-times text-danger'></i> Not Verified";
                        }
                        ?>
                    </td>
                    <td width="10%">
                      <a href="registered_users_details.php?id=<?php echo $id ?>" class="btn btn-xs btn-warning shadow title" title="Details"><span><i class="fa fa-plus"></i></span></a>

                      <a style="margin-top:3px" href="registered_user_update.php?u_id=<?php echo $id ?>" class="btn btn-xs btn-info shadow title" title="Edit"><span><i class="fa fa-edit"></i></span></a>

                      <a href="registered_add_education.php?u_id=<?php echo $id ?>" class="btn btn-xs btn-primary title shadow" style="margin-top: 2px" title="Add Education"><span><i class="fa fa-plus"></i></span></a>

                      <a href="registered_add_experience.php?u_id=<?php echo $id ?>" class="btn btn-xs btn-success title shadow" style="margin-top: 2px" title="Add Experience"><span><i class="fa fa-plus"></i></span></a>

                      <input type="hidden" id="pathImg<?php echo $id ?>" value="<?php echo $imagePath ?>">
                      <a onclick="deleteData(<?php echo $id ?>)" class="btn btn-xs btn-danger title shadow" style="margin-top: 2px" title="Delete"><span><i class="fa fa-trash"></i></span></a>
                    </td>
                  </tr>
                <?php } ?>