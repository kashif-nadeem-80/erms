<?php

include "includes/header.php";

$cand_id = base64_decode($_GET['id']);

$projId = base64_decode($_GET['id']);
//$projectId= $_GET['projid'];

echo $cand_id;
echo "project...";
echo $projId;
echo $canddate_id;
?>

<div class=" content-header ">

  <div class="container-fluid">

    <div class="row mb-2">

      <div class="col-md-6 ">

        <h4 class="m-0">Apply for Desired Post</h4>

      </div>

      <div class="col-md-6">

        <ol class="breadcrumb float-md-right">

          <li class="breadcrumb-item"><a href="index.php">Home /</a></li>

          <!-- <li class="breadcrumb-item active">Online Apply</li> -->

        </ol>

      </div>

    </div>

  </div>

</div>


<section class="content">

  <div class="row">

    <div class="col-md-12">

      <center>

      <div id="succ" class="bg-success text-white p-1 mb-2 rounded" style="display: none">

        <h5>Application Succcessfully Submit</h5>

        <p class="text-danger"><b>Now Download the Challan and pay amount in concern bank and then upload

        the paid challan picture,<br> otherwise your application will be reject</b></p>

      </div>

      <div class="bg-danger text-white p-1 mb-2 rounded" id="err" style="display: none">

        <h4>You have already applied for the same post!</h4>

      </div>

      <div class="bg-success text-white p-1 mb-2 rounded" id="succ2" style="display: none">

        <h4>Challan Successully Upload</h4>

      </div>

      <div class="bg-success text-white p-1 mb-2 rounded" id="succ3" style="display: none">

        <h4>Challan Successully Update</h4>

      </div>

      </center>

      <div class="card shadow card-soft">

        <div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">

          <div class="card-title"> </div>

        </div>

        <div class="card-body"> 

          <form method="post">

            <!-- <div class="row">

              <div class="col-md-12">

                <h5 class="text-danger">Before apply complete Your Profile and Education otherwise your Application shall be rejected</h5>

                <hr style="border: 1px solid #d9534f">

                <table class="table table-bordered">  <tr>

                    <td>A. Is age according to the prescribed age limit for the desired post</td>

                    <td>

                      <select id="test0" class="form-control" onchange="showDiv()">

                        <option value="1">Yes</option>

                        <option value="0">No</option>

                      </select>

                    </td>

                  </tr>

                  <tr>

                    <td>B. Do you have relevant / prescribed Qualification as mentioned in Advertisement?</td>

                    <td>

                      <select id="test1" class="form-control" onchange="showDiv()">

                        <option value="1">Yes</option>

                        <option value="0">No</option>

                      </select>

                    </td>

                  </tr>

                  <!-- <tr>

                    <td>C. Is your Domicile according to the desired post as mentioned in

                    Advertisment</td>

                    <td>

                      <select id="test2" class="form-control" onchange="showDiv()">

                        <option value="1">Yes</option>

                        <option value="0">No</option>

                      </select>

                    </td>

                  </tr> 

                </table>

                <span class="text-danger">If your reply is "Yes" to A & B above, only then please proceed further.Otherwise you are not eligible to apply.</span>

              </div>

            </div> -->

            <br>

            <div class="row">

              <div class="col-md-7">

                <div class="form-group">

                  <label>Selected Department / Project</label>

                  <select class="form-control" name="post" required>

                    <option value="">FFBL</option>
                    <option value="">FPCL</option>
                    <option value="">FML</option>

                    <?php

                    $query = "SELECT * FROM projects WHERE project_id = '$projId'";

                    $result = mysqli_query($connection,$query);

                    while ($row = mysqli_fetch_array($result)) {

                    $id = $row['id'];

                    $post_name = $row['post_name'];

                    $post_bps = $row['post_bps'];

                    echo "<option value='$id'>$post_name - BPS($post_bps)</option>";

                    }

                    ?>

                  </select>

                </div>

              </div>

              <!-- <div class="col-md-5">

                <div class="form-group">

                  <label>Desired Test City</label>

                  <select class="form-control select2" name="test_city" required>

                    <option value="">Choose</option>

                    <?php

                    $query = "SELECT c.id, c.c_name FROM city AS c WHERE c.test_center_status = '1' ORDER BY c.c_name ASC";

                    $result = mysqli_query($connection,$query);

                    while ($row = mysqli_fetch_array($result)) {

                    $id = $row['id'];

                    $c_name = $row['c_name'];

                    echo "<option value='$id'>$c_name</option>";

                    }

                    ?>

                  </select>

                </div>

              </div> -->

            </div>

            <div class="row">

              <div class="col-md-7">

                <div class="form-group">

                  <label>Select Post</label>

                  <select class="form-control" name="post" required>

                    <option value="">Choose</option>

                    <?php

                    $query = "SELECT * FROM projects_posts WHERE project_id = '$projId'";

                    $result = mysqli_query($connection,$query);

                    while ($row = mysqli_fetch_array($result)) {

                    $id = $row['id'];

                    $post_name = $row['post_name'];

                    $post_bps = $row['post_bps'];

                    echo "<option value='$id'>$post_name - BPS($post_bps)</option>";

                    }

                    ?>

                  </select>

                </div>

              </div>

              <div class="col-md-5">

                <div class="form-group">

                  <label>Desired Test City</label>

                  <select class="form-control select2" name="test_city" required>

                    <option value="">Choose</option>

                    <?php

                    $query = "SELECT c.id, c.c_name FROM city AS c WHERE c.test_center_status = '1' ORDER BY c.c_name ASC";

                    $result = mysqli_query($connection,$query);

                    while ($row = mysqli_fetch_array($result)) {

                    $id = $row['id'];

                    $c_name = $row['c_name'];

                    echo "<option value='$id'>$c_name</option>";

                    }

                    ?>

                  </select>

                </div>

              </div>

            </div>

            <hr>

            <div class="row">

              <div class="col-md-12">

                <h5>Undertaking......</h5>

                <p class="text-justify">

                  I do hereby solemnly declare that all the information provided by me in this

                  application form true to the best of my knowledge.

                </p>
                <p style="text-align: right; padding-right: 110px; ">
                
                <input type="checkbox" id="agree" style="height: 20px; width: 20px"

                onchange="undertaking()"> <b> Agreed </b> &nbsp; &nbsp;        
                <input type="submit" class="btn btn-success shadow" value="Submit Application"

id="saveid" name="saveUser" disabled="disabled"> </p>

              </div>

            </div>

            
            <!-- <div class="row">

              <div class="col-md-12">

                <input type="submit" class="btn btn-success shadow" value="Submit Application"

                id="saveid" name="saveUser" disabled="disabled">

              </div>

            </div> -->

          </form>

          <br>

          <?php

          if(isset($_POST['saveUser']))

          {

          $post       = $_POST['post'];

          $test_city  = $_POST['test_city'];

          date_default_timezone_set("Asia/Karachi");

          $date       = date("Y-m-d H:i:s");

          $fetchData = "SELECT * FROM candidate_applied_post WHERE candidate_id = '$canddate_id' AND post_id = '$post'";

          $runData = mysqli_query($connection,$fetchData);

          $countRow = mysqli_num_rows($runData);

          if($countRow == '0' OR $countRow == 0)

          {

          $insert = "INSERT INTO `candidate_applied_post`(`candidate_id`, `post_id`, `city_id`, `apply_date`) VALUES ('$canddate_id','$post','$test_city','$date')";

          $run = mysqli_query($connection,$insert);

          if($run)

          {

          echo "<!DOCTYPE html>

          <html>

            <body>

              <script>

              Swal.fire(

              'Submitted !',

              'Post Applied Successfully',

              'success'

              ).then((result) => {

              if (result.isConfirmed) {

              window.location.href = 'post_apply.php?id=$projId_enc';

              }

              });

              </script>

            </body>

          </html>";

          }

          }

          else

          {

          echo "<!DOCTYPE html>

          <html>

            <body>

              <script>

              Swal.fire(

              'Exist !',

              'You have already Applied for the same Post!',

              'error'

              ).then((result) => {

              if (result.isConfirmed) {

              window.location.href = 'post_apply.php?id=$projId_enc';

              }

              });

              </script>

            </body>

          </html>";

          }

          }

          ?>

          <div class="row">

            <div class="col-md-12 table-responsive">

              <h5>Applied Post Details</h5>

              <table class="table table-striped table-bordered bg-white text-center"

                style="font-size: 12px">

                <thead class="bg-secondary">

                  <tr>

                    <th>S.No</th>

                    <th>Post</th>

                    <th>Apply Date & Time</th>

                    <th>Application Status</th>

                    <th>Action</th>

                  </tr>

                  <?php

                  $count = 0;

                  $query2 = "SELECT ca.id,p.post_name,p.post_bps,ca.apply_date,ca.status,ca.challan_file FROM candidate_applied_post AS ca INNER JOIN projects_posts AS p ON p.id = ca.post_id WHERE ca.candidate_id = '$canddate_id' AND project_id = '$projId'";

                  $runData = mysqli_query($connection,$query2);

                  while($rowData = mysqli_fetch_array($runData)) {

                  $count++;

                  $id = $rowData['id'];

                  $encode_id = base64_encode($id);

                  $post_name  = $rowData['post_name'];

                  $status = $rowData['status'];

                  $apply_date   = date("d-m-Y h:i:s a", strtotime($rowData['apply_date']));

                  $post_bps     = $rowData['post_bps'];

                  $challan_fileU     = $rowData['challan_file'];

                  ?>

                </thead>

                <tbody>

                  <tr>

                    <td><?php echo $count; ?></td>

                    <td><b><?php echo $post_name." (BPS-".$post_bps.")"; ?></b></td>

                    <td><?php echo $apply_date; ?></td>

                    <td><?php echo $status; ?></td>

                    <td>

                      <?php if($challan_fileU == '' OR $challan_fileU == NULL)

                      { ?>

                      <a style="margin-top: 2px"

                        href="candidate_bank_challan.php?id=<?php echo $encode_id ?>&pid=<?php echo $projId_enc ?>"

                        class="btn btn-sm btn-primary shadow title"

                      title="Bank Challan">Download Challan</a>

                      <?php } if($challan_fileU == '' OR $challan_fileU == NULL)

                      { ?>

                      <a style="margin-top: 2px" data-id="<?php echo $id ?>" href="#edit"

                        data-toggle='modal' title="Upload File"

                      class="Data_Ajax btn btn-sm btn-success title shadow">Upload Challan</a>

                      <?php } else

                      { ?>

                      <a style="margin-top: 2px" data-id="<?php echo $id ?>" href="#edit"

                        data-toggle='modal' title="View Challan"

                        class="Data_Ajax2 btn btn-sm btn-info title shadow"><i

                      class="fa fa-eye"></i></a>

                      <a style="margin-top: 2px" data-id="<?php echo $id ?>" href="#edit"

                        data-toggle='modal' title="Update Challan"

                        class="Data_Ajax3 btn btn-sm btn-success title shadow"><i

                      class="fa fa-edit"></i></a>

                      <?php } ?>

                      <!-- <a href="candidate_apply_info2.php?apply_id=<?php echo $id ?>&proj_id=<?php echo $projId_enc ?>"

                        class="btn btn-sm btn-warning title shadow" title="All Details"><i

                      class="fa fa-eye"></i></a> -->

                    </td>

                  </tr>

                  <?php } ?>

                </tbody>

              </table>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</section>

<?php

include "includes/footer.php";

?>

<script type="text/javascript">

function showDiv() {

  var check1 = $('#test0').val();

  var check2 = $('#test1').val();

  if (check1 != '0' && check2 != '0' && $('#agree').is(":checked")) {

    $('#saveid').attr('disabled', false);

  } else {

    $('#saveid').attr('disabled', true);

  }

}



function undertaking() {

  if ($('#agree').is(":checked") && $('#test0').val() != '0' && $('#test1').val() != '0') {

    $('#saveid').removeAttr('disabled');

  } else {

    $('#saveid').attr('disabled', 'disabled');

  }

}



$('.Data_Ajax').click(function() {

var apply_id = $(this).attr('data-id');

$.ajax({

method: 'POST',

url: 'candidate_ajax.php',

data: {

apply_id: apply_id

},

datatype: "html",

success: function(result) {

$(".modal-content").html(result);

}

});

});

$('.Data_Ajax2').click(function() {

var apply_id = $(this).attr('data-id');

$.ajax({

method: 'POST',

url: 'candidate_ajax.php',

data: {

apply_id2: apply_id

},

datatype: "html",

success: function(result) {

$(".modal-content").html(result);

}

});

});

$('.Data_Ajax3').click(function() {

var apply_id = $(this).attr('data-id');

$.ajax({

method: 'POST',

url: 'candidate_ajax.php',

data: {

apply_id3: apply_id

},

dataType: "html",

success: function(result) {

$(".modal-content").html(result);

}

});

});

</script>

<!-- Modal Start-->

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content">

    </div>

  </div>

</div>

<!-- Modal end -->

<?php

// ///////////Upload Challan/////////////////

if(isset($_POST['upload']))

{



$apply_id = $_POST['apply_id'];

date_default_timezone_set("Asia/Karachi");

$date       = date("Y-m-d H:i:s");

if($_FILES['challan_file']['name'] == '')

{

$challan_file = '';

}

else

{

$challan_file = mt_rand().$_FILES['challan_file']['name'];

$temp_file  = $_FILES['challan_file']['tmp_name'];

$challan_path    = "../../images/candidates/challans/".$challan_file;

move_uploaded_file($temp_file,$challan_path);

}

$update = "UPDATE candidate_applied_post SET challan_file = '$challan_file', challan_upload_date = '$date' WHERE id = '$apply_id'";

$run = mysqli_query($connection, $update);



if($run)

{

echo "<!DOCTYPE html>

<html>

  <body>

    <script>

    Swal.fire(

    'Uploaded !',

    'Paid challan has been uploaded successfully',

    'success'

    ).then((result) => {

    if (result.isConfirmed) {

    window.location.href = 'post_apply.php?id=$projId_enc';

    }

    });

    </script>

  </body>

</html>";

}

}

/////////////Update Challan//////////////

if(isset($_POST['update']))

{



$apply_id = $_POST['apply_id'];

date_default_timezone_set("Asia/Karachi");

$date       = date("Y-m-d H:i:s");

$fetchData = "SELECT challan_file FROM candidate_applied_post WHERE id = '$apply_id'";

$runData = mysqli_query($connection,$fetchData);

$rowData = mysqli_fetch_array($runData);

$challan_pathOld    = "../../images/candidates/challans/".$rowData['challan_file'];

@unlink($challan_pathOld);

$challan_file = mt_rand().$_FILES['challan_file']['name'];

$temp_file  = $_FILES['challan_file']['tmp_name'];

$challan_pathNew    = "../../images/candidates/challans/".$challan_file;

move_uploaded_file($temp_file,$challan_pathNew);

$update = "UPDATE candidate_applied_post SET challan_file = '$challan_file', challan_upload_date = '$date' WHERE id = '$apply_id'";

$run = mysqli_query($connection, $update);



if($run)

{

echo "<!DOCTYPE html>

<html>

  <body>

    <script>

    Swal.fire(

    'Updated !',

    'Paid challan has been updated successfully',

    'success'

    ).then((result) => {

    if (result.isConfirmed) {

    window.location.href = 'post_apply.php?id=$projId_enc';

    }

    });

    </script>

  </body>

</html>";

}

}

?>

<script type="text/javascript">

var showImage1 = function(event) {

var uploadField = document.getElementById("file1");

if (uploadField.files[0].size > 200000) {

uploadField.value = "";

// alert("File is too big! Upload File under 200kB");

Swal.fire(

'Error !',

'File size is too big! upload file under 200kB !',

'error'

).then((result) => {

if (result.isConfirmed) {

}

});

}

}

</script>