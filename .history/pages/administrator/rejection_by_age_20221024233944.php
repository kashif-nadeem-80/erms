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

        <h5 class="m-0 text-dark ">Change Status of All Candidates To <span class="text-info">Rejected</span> Who's Under/Over Age</h5>

        <p class="text-danger">Before Rejection First Do Above Two Steps</p>

        <hr class="shadow">

      </div>

    </div>

  </div>

</div>

<section class="content" style="overflow-x: hidden;">

  <div class="container-fluid">

    <form method="post">

      <div class="row">

        <div class="col-md-4">

          <div class="form-group">

            <label>Project Title</label>

            <select class="form-control select2" id="proj" onchange="getPost()" name="projectId" required>

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

        <div class="col-md-5">

          <div class="form-group">

            <label>Posts</label>

            <select class="form-control select2" onchange="getApplicantData()" name="post" id="post_id" required>

              <option value="">First Select Project</option>

            </select>

          </div>

        </div>

        <div class="col-md-3">

          <div class="form-group">

            <label>Age Upto This Date</label>

            <input type="date" id="uptoDate" name="uptoD" class="form-control" onchange="getApplicantData()" value="<?php echo date('Y-m-d'); ?>">

          </div>

        </div>

        <input type="" name="age_lower" id="ageLower">

        <input type="hidden" name="age_upper" id="ageUpper">

      </div>



      <hr>



      <div class="row">

        <div class="col-md-12">

          <h5>Total Apply : <span id="totalAp" class="text-primary">0</span></h5>

        </div>

      </div>

      <div class="row">

        <div class="col-md-12">

          <h5>Under Age Candidates : <span id="underage" class="text-danger">0</span></h5>

        </div>

      </div>

      <div class="row">

        <div class="col-md-12">

          <h5>Over Age Candidates : <span id="overage" class="text-danger">0</span></h5>

        </div>

      </div>

      <div class="row">

        <div class="col-md-12">

          <h5>DOB Missing Candidates : <span id="dob_miss" class="text-warning">0</span></h5>

        </div>

      </div>

      <div class="row">

        <div class="col-md-12">

          <h5>Eligible Age Candidates : <span id="eligible" class="text-success">0</span></h5>

        </div>

      </div>

      <br><br>

      <div class="row">

        <div class="col-md-12">

          <div class="form-group text-center">

            <input type="submit" class="btn btn-info shadow" value="Reject" name="reject">

          </div>

        </div>

      </div>

    </form>

  </div>

</section>

<?php 

if(isset($_POST['reject']))

{

  $age_lower = $_POST['age_lower'];

  $age_upper = $_POST['age_upper'];

  $post = $_POST['post'];

  $uptoD = $_POST['uptoD'];

  $date       = date("Y-m-d H:i:s");



  $query3 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'D.O.B is missing', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND c.dob IS NULL";

  $run_query3 = mysqli_query($connection,$query3);



  $query1 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'Under Age', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND $age_lower > (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoD')/365.28),3)) ";

  $run_query1 = mysqli_query($connection,$query1);



  $query2 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id SET cp.status = 'Rejected', cp.status_details = 'Over Age', cp.update_date = '$date' WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND $age_upper < (ROUND((TIMESTAMPDIFF(DAY,c.dob,'$uptoD')/365.28),3))";

  $run_query2 = mysqli_query($connection,$query2);



  if($run_query3)

  {

    echo "<!DOCTYPE html>

    <html>

      <body> 

      <script>

      Swal.fire(

        'Rejected !',

        'Candidates Under/Over age, of selected post has been Rejected',

        'success'

      ).then((result) => {

        if (result.isConfirmed) {

          window.location.href = 'rejection_by_age.php';

        }

      });

      </script>

      </body>

    </html>";         

  }

} 

?>

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

        $("#post_id").html(result);

      }

    }).done(function(){

      getApplicantData();

    });

  }

  

  function getApplicantData()

  {

    var post_id = $("#post_id").val();

    var uptoDate = $("#uptoDate").val();



    if(post_id != '')

    {

      $("#preloader").fadeIn(100);



      $.ajax({

        method:'POST',

        url:'rejection_by_age_ajax.php',

        data: {

          postId: post_id,

          uptoDate: uptoDate

        },

        dataType: "json",

        success:function(result){

          $("#totalAp").html(result.total);

          $("#overage").html(result.overage);

          $("#underage").html(result.underage);

          $("#eligible").html(result.eligibleC);

          $("#dob_miss").html(result.dob_miss);

          $("#ageLower").val(result.age_lower);

          $("#ageUpper").val(result.age_upper);

          $("#preloader").fadeOut(100); 

        }

      });

    }

    else

    {

      $("#total").html(0);

      $("#overage").html(0);

      $("#underage").html(0);

      $("#eligible").html(0);

      $("#dob_miss").html(0);

    }

  }



</script>