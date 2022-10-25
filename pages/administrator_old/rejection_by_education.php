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
        <h5 class="m-0 text-dark ">Change Status of All Candidates To <span class="text-info">Rejected</span> Who's Have No Required Education</h5>
        <p class="text-danger">Before Rejection First Do Above Five Steps</p>
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
        <div class="col-md-4">
          <div class="form-group">
            <label>Posts</label>
            <select class="form-control select2" onchange="getApplicantData()" name="post" id="post_id" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>Minimun Education</label>
            <select class="form-control select2" onchange="getApplicantData()" name="education" id="edu_level" required>
              <option value="">Choose</option>
              <?php
              $fetchData = "SELECT * FROM edu_level ORDER BY id ASC";
              $run = mysqli_query($connection,$fetchData);
              while ($row = mysqli_fetch_array($run)) {
                $id = $row['id'];
                $name = $row['level_name'];
              ?>
              <option value="<?php echo $id ?>"><?php echo $name ?></option>
            <?php } ?>
            </select>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-12">
          <h5>Total Apply : <span id="totalAp" class="text-primary">0</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>No Required Education : <span id="no_edu" class="text-danger">0</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Eligible Candidates : <span id="eligible" class="text-success">0</span></h5>
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
  $post = $_POST['post'];
  $education = $_POST['education'];
  $date       = date("Y-m-d H:i:s");

  $fetch = "SELECT cp.id FROM candidate_applied_post AS cp
    INNER JOIN candidates AS c ON c.id = cp.candidate_id
    iNNER JOIN education AS e ON e.candi_id = c.id 
    INNER JOIN degree AS d ON d.id = e.degree_id
    INNER JOIN edu_level AS el ON el.id = d.level_id
    WHERE cp.post_id = '$post' AND cp.status != 'Rejected' AND cp.status != 'Accepted' GROUP BY cp.candidate_id HAVING MAX(el.id) < '$education'";
  $run = mysqli_query($connection,$fetch);
  while ($row = mysqli_fetch_array($run))
  {
    $applyId = $row['id'];
    $query1 = "UPDATE candidate_applied_post SET status = 'Rejected', status_details = 'Required education is missing', update_date = '$date' WHERE id = '$applyId'";
    $run_query1 = mysqli_query($connection,$query1);
  }

  $query2 = "UPDATE candidate_applied_post AS cp INNER JOIN candidates AS c ON c.id = cp.candidate_id LEFT JOIN education AS e ON e.candi_id = c.id SET cp.status = 'Rejected', cp.status_details = 'Required education is missing', cp.update_date = '$date' WHERE cp.post_id = '1' AND e.id IS NULL AND cp.status != 'Rejected' AND cp.status != 'Accepted'";
  $run_query2 = mysqli_query($connection,$query2);

  if($run)
  {
    echo "<!DOCTYPE html>
    <html>
      <body> 
      <script>
      Swal.fire(
        'Rejected !',
        'Candidates without required education, of selected post has been Rejected',
        'success'
      ).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'rejection_by_education.php';
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
    var edu_level = $("#edu_level").val();

    if(post_id != '' && edu_level != '')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'rejection_by_edu_ajax.php',
        data: {
          postId: post_id,
          edu_level: edu_level
        },
        dataType: "json",
        success:function(result){
          $("#totalAp").html(result.total);
          $("#no_edu").html(result.totalRej);
          $("#eligible").html(result.eligibleC);
          $("#preloader").fadeOut(100); 
        }
      });
    }
    else
    {
      $("#total").html(0);
      $("#eligible").html(0);
      $("#no_edu").html(0);
    }
  }

</script>