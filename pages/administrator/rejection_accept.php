<?php
include "includes/header.php";
?>
<style>
  .modal { overflow: auto !important; }
  
</style>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">Accept All Candidate Post Wise</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Accept All</li>
        </ol>
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
        <div class="col-md-6">
          <div class="form-group">
            <label>Posts</label>
            <select class="form-control select2" onchange="getApplicantData()" name="post" id="post_id" required>
              <option value="">First Select Project</option>
            </select>
          </div>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center">Total Apply : <span id="ajaxData" class="text-success">0</span></h3>
        </div>
        <br><br>
        <div class="col-md-12">
          <div class="form-group text-center">
            <input type="submit" class="btn btn-info shadow" value="Accept" name="accept">
          </div>
        </div>
      </div>

    </form>
  </div>
</section>
<?php 
if(isset($_POST['accept']))
{
  $post = $_POST['post'];
  $query = "UPDATE candidate_applied_post SET status = 'Accepted', status_details = 'All requirements are complete' WHERE post_id = '$post'";
  $run_query = mysqli_query($connection,$query);
  if($run_query)
  {
  echo "<!DOCTYPE html>
        <html>
          <body> 
          <script>
          Swal.fire(
            'Accepted !',
            'All candidates of selected post has been accepted',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'rejection_accept.php';
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

    if(post_id != '')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'rejection_accept_ajax.php',
        data: {
            postId: post_id
        },
        dataType: "json",
        success:function(result){
          $("#ajaxData").html(result.totalApplicants);
          $("#preloader").fadeOut(100); 
        }
      });
    }
    else
    {
      $("#ajaxData").html("");
    }
  }

</script>