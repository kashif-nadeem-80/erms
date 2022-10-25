<?php
include "includes/header.php";
?>
<style>
  .modal { overflow: auto !important; }
  
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-12 text-center">
        <h5 class="m-0 text-dark ">Change Status of All Candidates To <span class="text-info">Rejected</span> Who's Have No Desire Domicile</h5>
        <p class="text-danger">Before Rejection First Do Above Four Steps</p>
        <hr class="shadow">
      </div>
    </div>
  </div>
</div>
<section class="content" style="overflow-x: hidden;">
  <div class="container-fluid">
    <form method="post">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Project Title</label>
            <select class="form-control" id="proj" onchange="getPost()" name="projectId" required>
              <option value="">Choose</option>
              <?php
              $fetchData = "SELECT * FROM projects WHERE status = '1' ORDER BY id DESC";
              $run = mysqli_query($connection,$fetchData);
              while ($row = mysqli_fetch_array($run)) {
                $id = $row['id'];
                $name = $row['project_name'];
              ?>
              <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php } ?>
            </select>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Posts</label>
            <select class="form-control" onchange="getApplicantData()" name="post" id="post_id" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
      </div>

      <hr class="shadow">

      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <label>Religion</label>
            <select class="form-control" name="religion" required>
              <option value="all">Eligible All</option>
              <option value="Muslim">Eligible Muslim</option>
              <option value="Non-Muslim">Eligible Non-Muslim</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Gender</label>
            <select class="form-control" name="gender" required>
              <option value="all">Eligible All</option>
              <option value="Male">Eligible Male</option>
              <option value="Female">Eligible Female</option>
              <option value="Other">Eligible Other</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Physical Eligibility</label>
            <select class="form-control" name="disability" required>
              <option value="all">Eligible All</option>
              <option value="Disabled">Eligible Only Disabled</option>
              <option value="Fit">Eligible Only Not Disabled</option>
            </select>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Azad Kashmir</label>
                <select class="form-control" name="province1" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row1">
            <div class="col-md-12" id="new_data11">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id1[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '8' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row1()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Balochistan</label>
                <select class="form-control" name="province2" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row2">
            <div class="col-md-12" id="new_data21">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id2[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '4' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row2()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>FATA</label>
                <select class="form-control" name="province3" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row3">
            <div class="col-md-12" id="new_data31">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id3[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '9' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row3()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="shadow">
      
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Gilgit Baltistan</label>
                <select class="form-control" name="province4" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row4">
            <div class="col-md-12" id="new_data41">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id4[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '5' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row4()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Islamabad</label>
                <select class="form-control" name="province5" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row5">
            <div class="col-md-12" id="new_data51">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id5[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '6' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row5()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Khyber Pakhtunkhwa</label>
                <select class="form-control" name="province6" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row6">
            <div class="col-md-12" id="new_data61">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id6[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '1' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row6()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="shadow">
      
      <div class="row">
        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Punjab</label>
                <select class="form-control" name="province7" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row7">
            <div class="col-md-12" id="new_data71">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id7[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '2' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row7()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Sindh (Rural)</label>
                <select class="form-control" name="province8" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row8">
            <div class="col-md-12" id="new_data81">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id8[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '7' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row8()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Sindh (Urban)</label>
                <select class="form-control" name="province9" required>
                  <option value="1">Eligible</option>
                  <option value="0">Not Eligible</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row" id="new_row9">
            <div class="col-md-12" id="new_data91">
              <div class="row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label>Domicile's District</label>
                    <select class="form-control" name="domicile_id9[]" required>
                      <option value="all">All</option>
                      <?php
                      $query2 = "SELECT * FROM `district` WHERE pro_id = '3' ORDER BY dis_name ASC";
                      $runData = mysqli_query($connection, $query2);
                      while ($rowData = mysqli_fetch_array($runData)) {
                        $id = $rowData['id'];
                        $dis_name  = $rowData['dis_name'];
                        echo "<option value='$id'>$dis_name</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group mt-2">
                    <br>
                    <button type="button" tabindex="-1" class="btn btn-success shadow title" onclick="add_row9()" title="Add More"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <br><br>
      <div class="row">
        <div class="col-md-12">
          <div class="form-group text-center">
            <input type="submit" class="btn btn-info shadow" value="Proceed" name="reject">
          </div>
        </div>
      </div>
    </form>
    <?php 
      if(isset($_POST['reject']))
      {
        echo"<script>$('#preloader').fadeIn(100);</script>";
        $post = $_POST['post'];

        $religion = $_POST['religion'];
        $gender = $_POST['gender'];
        $disability = $_POST['disability'];
        $date       = date("Y-m-d H:i:s");

        // Religion
        if($religion != 'all')
        {
          if($religion == 'Muslim')
          {
            $queryRelg = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'No Required Religion', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.religion = 'Non-Muslim'";
          }
          else
          {
            echo $queryRelg = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'No Required Religion', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.religion = 'Muslim'";
          }
          $run_relg = mysqli_query($connection,$queryRelg);
        }

        // Gender
        if($gender != 'all')
        {
          if($gender == 'Male')
          {
            $queryGend = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'No Required Gender', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.gender != 'Male'";
          }
          elseif($gender == 'Female')
          {
            $queryGend = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'No Required Gender', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.gender != 'Female'";
          }
          else
          {
            $queryGend = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'No Required Gender', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.gender != 'Other'";
          }
          $run_Gend = mysqli_query($connection,$queryGend);
        }

        // Disability
        if($disability != 'all')
        {
          if($disability == 'Disabled')
          {
            $queryDis = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'No Required Disability', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.disability != 'Yes'";
          }
          else
          {
            $queryDis = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'You are disabled', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.disability != 'No'";
          }

          $run_Dis = mysqli_query($connection,$queryDis);
        }

        $province1 = $_POST['province1'];
        $province2 = $_POST['province2'];
        $province3 = $_POST['province3'];
        $province4 = $_POST['province4'];
        $province5 = $_POST['province5'];
        $province6 = $_POST['province6'];
        $province7 = $_POST['province7'];
        $province8 = $_POST['province8'];
        $province9 = $_POST['province9'];

        $query = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'Domicile is missing', cp.reject_by_quota = 'reject', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.district_id IS NULL";
        $run_query = mysqli_query($connection,$query);

        // Azad Kashmir
        if($province1 == '1')
        {
          $countDomicile1 = COUNT($_POST['domicile_id1']);
          for($i = 0; $i < $countDomicile1; $i++)
          {
            $domicile_id = $_POST['domicile_id1'][$i];
            $query1 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '8'";
            $run_query1 = mysqli_query($connection,$query1);
          }

          $query12 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '8'";
          $run_query12 = mysqli_query($connection,$query12);
        }
        else
        {
          $query13 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '8'";
          $run_query13 = mysqli_query($connection,$query13);
        }

        // Balochistan
        if($province2 == '1')
        {
          $countDomicile2 = COUNT($_POST['domicile_id2']);
          for($i = 0; $i < $countDomicile2; $i++)
          {
            $domicile_id = $_POST['domicile_id2'][$i];
            $query2 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '4'";
            $run_query2 = mysqli_query($connection,$query2);
          }

          $query22 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '4'";
          $run_query22 = mysqli_query($connection,$query22);
        }
        else
        {
          $query23 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '4'";
          $run_query23 = mysqli_query($connection,$query23);
        }

        // FATA
        if($province3 == '1')
        {
          $countDomicile3 = COUNT($_POST['domicile_id3']);
          for($i = 0; $i < $countDomicile3; $i++)
          {
            $domicile_id = $_POST['domicile_id3'][$i];
            $query3 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '9'";
            $run_query3 = mysqli_query($connection,$query3);
          }

          $query32 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '9'";
          $run_query32 = mysqli_query($connection,$query32);
        }
        else
        {
          $query33 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '9'";
          $run_query33 = mysqli_query($connection,$query33);
        }


        // Gilgit Baltistan
        if($province4 == '1')
        {
          $countDomicile4 = COUNT($_POST['domicile_id4']);
          for($i = 0; $i < $countDomicile4; $i++)
          {
            $domicile_id = $_POST['domicile_id4'][$i];
            $query4 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '5'";
            $run_query4 = mysqli_query($connection,$query4);
          }

          $query42 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '5'";
          $run_query42 = mysqli_query($connection,$query42);
        }
        else
        {
          $query43 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '5'";
          $run_query43 = mysqli_query($connection,$query43);
        }

        // Islamabad
        if($province5 == '1')
        {
          $countDomicile5 = COUNT($_POST['domicile_id5']);
          for($i = 0; $i < $countDomicile5; $i++)
          {
            $domicile_id = $_POST['domicile_id5'][$i];
            $query5 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '6'";
            $run_query5 = mysqli_query($connection,$query5);
          }

          $query52 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '6'";
          $run_query52 = mysqli_query($connection,$query52);
        }
        else
        {
          $query53 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '6'";
          $run_query53 = mysqli_query($connection,$query53);
        }

        // Khyber Pakhtunkhwa
        if($province6 == '1')
        {
          $countDomicile6 = COUNT($_POST['domicile_id6']);
          for($i = 0; $i < $countDomicile6; $i++)
          {
            $domicile_id = $_POST['domicile_id6'][$i];
            $query6 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '1'";
            $run_query6 = mysqli_query($connection,$query6);
          }

          $query62 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '1'";
          $run_query62 = mysqli_query($connection,$query62);
        }
        else
        {
          $query63 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '1'";
          $run_query63 = mysqli_query($connection,$query63);
        }

        // Punjab
        if($province7 == '1')
        {
          $countDomicile7 = COUNT($_POST['domicile_id7']);
          for($i = 0; $i < $countDomicile7; $i++)
          {
            $domicile_id = $_POST['domicile_id7'][$i];
            $query7 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '2'";
            $run_query7 = mysqli_query($connection,$query7);
          }

          $query72 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '2'";
          $run_query72 = mysqli_query($connection,$query72);
        }
        else
        {
          $query73 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '2'";
          $run_query73 = mysqli_query($connection,$query73);
        }

        // Sindh (Rural)
        if($province8 == '1')
        {
          $countDomicile8 = COUNT($_POST['domicile_id8']);
          for($i = 0; $i < $countDomicile8; $i++)
          {
            $domicile_id = $_POST['domicile_id8'][$i];
            $query8 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '7'";
            $run_query8 = mysqli_query($connection,$query8);
          }

          $query82 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '7'";
          $run_query82 = mysqli_query($connection,$query82);
        }
        else
        {
          $query83 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '7'";
          $run_query83 = mysqli_query($connection,$query83);
        }

        // Sindh (Urban)
        if($province9 == '1')
        {
          $countDomicile9 = COUNT($_POST['domicile_id9']);
          for($i = 0; $i < $countDomicile9; $i++)
          {
            $domicile_id = $_POST['domicile_id9'][$i];
            $query9 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.reject_by_quota = 'accept' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND (c.district_id = '$domicile_id' OR '$domicile_id' = 'all') AND pro.id = '3'";
            $run_query9 = mysqli_query($connection,$query9);
          }

          $query92 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date', cp.reject_by_quota = 'reject' WHERE reject_by_quota != 'accept' AND pro.id = '3'";
          $run_query92 = mysqli_query($connection,$query92);
        }
        else
        {
          $query93 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id INNER JOIN district AS d ON d.id = c.district_id INNER JOIN province AS pro ON pro.id = d.pro_id SET cp.status = 'Rejected', cp.status_details = 'No Required Domicile', cp.update_date = '$date' WHERE pro.id = '3'";
          $run_query93 = mysqli_query($connection,$query93);
        }

        echo"<script>$('#preloader').fadeOut(100);</script>";


        echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Rejected !',
              'Candidates out of quota, of selected post has been Rejected',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
               window.location.href = 'rejection_by_quota.php';
              }
            });
            </script>
            </body>
          </html>";
      } 
      ?>
  </div>
</section>
<?php
  include "includes/footer.php";
?>

<script>
  var autoIncNo1 = 1;
  function add_row1() {
    autoIncNo1++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count1': autoIncNo1
      },
      success(data) {
        $('#new_row1').append(data);
      }
    });
  }

  function remove_exp1(id) {
    let div = '#new_data1'+id;
    $(div).remove();
  }

  var autoIncNo2 = 1;
  function add_row2() {
    autoIncNo2++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count2': autoIncNo2
      },
      success(data) {
        $('#new_row2').append(data);
      }
    });
  }

  function remove_exp2(id) {
    let div = '#new_data2'+id;
    $(div).remove();
  }

  var autoIncNo3 = 1;
  function add_row3() {
    autoIncNo3++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count3': autoIncNo3
      },
      success(data) {
        $('#new_row3').append(data);
      }
    });
  }

  function remove_exp3(id) {
    let div = '#new_data3'+id;
    $(div).remove();
  }

  var autoIncNo4 = 1;
  function add_row4() {
    autoIncNo4++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count4': autoIncNo4
      },
      success(data) {
        $('#new_row4').append(data);
      }
    });
  }

  function remove_exp4(id) {
    let div = '#new_data4'+id;
    $(div).remove();
  }

  var autoIncNo5 = 1;
  function add_row5() {
    autoIncNo5++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count5': autoIncNo5
      },
      success(data) {
        $('#new_row5').append(data);
      }
    });
  }

  function remove_exp5(id) {
    let div = '#new_data5'+id;
    $(div).remove();
  }

  var autoIncNo6 = 1;
  function add_row6() {
    autoIncNo6++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count6': autoIncNo6
      },
      success(data) {
        $('#new_row6').append(data);
      }
    });
  }

  function remove_exp6(id) {
    let div = '#new_data6'+id;
    $(div).remove();
  }

  var autoIncNo7 = 1;
  function add_row7() {
    autoIncNo7++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count7': autoIncNo7
      },
      success(data) {
        $('#new_row7').append(data);
      }
    });
  }

  function remove_exp7(id) {
    let div = '#new_data7'+id;
    $(div).remove();
  }

  var autoIncNo8 = 1;
  function add_row8() {
    autoIncNo8++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count8': autoIncNo8
      },
      success(data) {
        $('#new_row8').append(data);
      }
    });
  }

  function remove_exp8(id) {
    let div = '#new_data8'+id;
    $(div).remove();
  }

  var autoIncNo9 = 1;
  function add_row9() {
    autoIncNo9++;
    $.ajax({
      url: 'rejection_by_quota_row.php',
      method: 'POST',
      data: {
        'count9': autoIncNo9
      },
      success(data) {
        $('#new_row9').append(data);
      }
    });
  }

  function remove_exp9(id) {
    let div = '#new_data9'+id;
    $(div).remove();
  }
</script>
<script type="text/javascript">
  function getPost()
  {    
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'admin_ajax.php',
      data: {
          projId: projId
      },
      dataType: "html",
      success:function(result){
        $("#post_id").html(result);
      }
    });
  }

</script>

