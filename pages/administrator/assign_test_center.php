<?php
include "includes/header.php";
?>

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Assign Test Center</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Assigning</li>
        </ol>
      </div>
    </div>
  </div>
</div>
<section class="content">
  <div class="container-fluid">
    <div class="card card-dark">
      <div class="card-header">
        <div class="card-title">Assign Center Form</div>
      </div>
      <div class="card-body">
        <form method="post">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Project Title</label>
                <select class="form-control select2" id="proj" onchange="getPost()"required name="projId">
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
            <div class="col-md-4">
              <div class="form-group">
                <label>Posts</label>
                <select class="form-control select2" onchange="getApplid()" name="postId" id="post" required>
                  <option value="">First Select Project</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Test City</label>
                <select class="form-control select2" name="cityId" id="city" onchange="getApplid()" required>
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
            <div class="col-md-4">
              <div class="form-group">
                <label>Center</label>
                <select class="form-control select2" onchange="get_test_sesion()" id="center" name="centerId" required>
                  <option value="">First Select City</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Session</label>
                <select class="form-control select2" onchange="getCapacity()" id="sesion" name="sesionId" required>
                  <option value="">First Select Post & Center</option>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Total Capacity</label>
                <input type="text" readonly id="capacity" placeholder="Capacity" class="form-control" name="Tcapacity">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Assigned Capacity</label>
                <input type="text" readonly id="assign" placeholder="Assigned Capacity" class="form-control" name="Acapacity">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Un-assigned Capacity</label>
                <input type="text" readonly id="unassign" placeholder="Un-assigned" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Total Apply</label>
                <input type="text" id="total_apply" readonly placeholder="Total Apply" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Assigned To Center</label>
                <input type="text" id="assignA" readonly placeholder="Total Apply" class="form-control" name="Aapply">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Not Assign To Center</label>
                <input type="text" id="notassignA" readonly placeholder="Total Apply" class="form-control">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Capacity for this post</label>
                <input type="number" placeholder="Capacity for this post" class="form-control" required  id="assignCap" onkeyup="checkCapacity()" name="givenCap">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 ">
              <input type="submit" class="float-right btn btn-primary shadow" value="Assign" name="assign">
            </div>
          </div>
        </form>

        <?php
        if(isset($_POST['assign']))
        {
          echo"<script>$('#preloader').fadeIn(100);</script>";
          $projId = $_POST['projId'];
          $cityId = $_POST['cityId'];
          $postId = $_POST['postId'];
          $centerId = $_POST['centerId'];
          $sesionId = $_POST['sesionId'];
          $givenCap = $_POST['givenCap'];

          $Acapacity = $_POST['Acapacity'] + $givenCap;
          $Aapply = $_POST['Aapply'] + $givenCap;

          $fetch = "SELECT ca.id,ac.post_id FROM candidate_applied_post AS ca LEFT JOIN assigned_center As ac ON ac.cand_applied_id = ca.id LEFT JOIN center_session AS cs ON cs.id = ac.session_id  WHERE ca.post_id = '$postId' AND ca.city_id = '$cityId' AND ac.post_id IS NULL ORDER BY ca.id ASC LIMIT $givenCap";
          $runQ = mysqli_query($connection,$fetch);
          while ($row = mysqli_fetch_array($runQ)) {
            $cap_id = $row['id'];
            $rolNo = 0;
            $insert = "INSERT INTO `assigned_center`(`post_id`, `session_id`, `cand_applied_id`, `roll_no`) VALUES ('$postId','$sesionId','$cap_id','$rolNo')";
            $runI = mysqli_query($connection,$insert);
          }
          $fetch1 = "SELECT * FROM assigned_center_capacity_temp WHERE session_id = '$sesionId'";
          $run1 = mysqli_query($connection,$fetch1);
          $count1 = mysqli_num_rows($run1);
          if($count1 == 0)
          {
            $query1 = "INSERT INTO `assigned_center_capacity_temp`(`session_id`, `assigned_capacity`) VALUES ('$sesionId','$Acapacity')";
          }
          else
          {
            $query1 = "UPDATE `assigned_center_capacity_temp` SET `assigned_capacity` = '$Acapacity' WHERE session_id = '$sesionId'";
          }
          $runQuery1 = mysqli_query($connection,$query1);

          $fetch2 = "SELECT * FROM assigned_center_to_cand_temp WHERE post_id = '$postId' AND city_id = '$cityId'";
          $run2 = mysqli_query($connection,$fetch2);
          $count2 = mysqli_num_rows($run2);
          if($count2 == 0)
          {
            $query2 = "INSERT INTO `assigned_center_to_cand_temp`(`post_id`, `city_id`, `assigned_candidate`) VALUES ('$postId','$cityId', '$Aapply')";
          }
          else
          {
            $query2 = "UPDATE `assigned_center_to_cand_temp` SET `assigned_candidate` = '$Aapply' WHERE post_id = '$postId' AND city_id = '$cityId'";
          }
          $runQuery2 = mysqli_query($connection,$query2);
          echo"<script>$('#preloader').fadeOut(100);</script>";
          if($runQuery2)
          {
          echo "<!DOCTYPE html>
          <html>
            <body> 
            <script>
            Swal.fire(
              'Added !',
              'Assign Center has been added successfully',
              'success'
            ).then((result) => {
              if (result.isConfirmed) {
                window.location.href= 'assign_test_center.php';
              }
            });
            </script>
            </body>
          </html>";
              }
              else
              {
              echo "<!DOCTYPE html>
                    <html>
                      <body> 
                      <script>
                      Swal.fire(
                        'Error !',
                        'Assign Center not add, Some error occure',
                        'error'
                      ).then((result) => {
                        if (result.isConfirmed) {
                           window.location.href = 'assign_test_center.php';
                        }
                      });
                      </script>
                      </body>
                    </html>";
              }
        }
        ?>
      </div>
    </div>
  </div>
</section>


<?php
  include "includes/footer.php";
?>

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
      $("#post").html(result);
    }
  }).done(function(){
    getApplid();
  });
}

function getApplid()
{
  var post = $("#post").val();
  var city = $("#city").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
      city2: city,
      post: post
    },
    dataType: 'json',
    success:function(result){
      $("#total_apply").val(result.total_apply);
      $("#assignA").val(result.alocate);
      $("#notassignA").val(result.unalocate);
    }
  }).done(function(){
    getCenter();
  });
}

function getCenter()
{
  var city = $("#city").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
        city: city
    },
    dataType: "html",
    success:function(result){
      $("#center").html(result);
    }
  }).done(function(){
    get_test_sesion();
  });
}



function get_test_sesion()
{
  var center = $("#center").val();
  var post = $("#post").val();
  $.ajax({
    method:'POST',
    url:'admin_ajax.php',
    data: {
        center: center,
        post_id: post
    },
    dataType: "html",
    success:function(result){
      $("#sesion").html(result);
    }
  }).done(function(){
    getCapacity();
  });
}




function getCapacity()
{
  var sesion = $("#sesion").val();
  if(sesion != '')
  {
    $.ajax({
      method:'POST',
      url:'admin_ajax.php',
      data: {
        sesion: sesion
      },
      dataType: "json",
      success:function(result){
        $("#capacity").val(result.capacity);
        $("#assign").val(result.alocate);
        $("#unassign").val(result.unalocate);
        $("#assignCap").val("");
      }
    });
  }
  else
  {
    $("#capacity").val(0);
    $("#assign").val(0);
    $("#unassign").val(0);
    $("#assignCap").val("");
  }
}

function checkCapacity()
{
  var capacity = parseInt($("#unassign").val());
  var assignCap = parseInt($("#assignCap").val());
  var total_apply = parseInt($("#notassignA").val());
  if(assignCap > capacity)
  {

    Swal.fire(
              'Error !',
              'Capacity for this post, must be less than or equal to Un-assigned Capacity',
              'error'
            ).then((result) => {
              if (result.isConfirmed) {
                $("#assignCap").val(capacity);
              }
            });
}
  if(assignCap > total_apply)
  {

    Swal.fire(
              'Error !',
              'Capacity for this post, must be less than or equal to Not Assign To Center',
              'error'
            ).then((result) => {
              if (result.isConfirmed) {
                $("#assignCap").val(total_apply);
              }
            });
  }
}
</script>
