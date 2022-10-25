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
        <h4 class="m-0 text-dark ">Change Status of All Candidates To <span class="text-info">Accepted</span> Who's Have All Requirements Complete</h4>
        <p class="text-danger">Before Acception First Do All Above Steps</p>
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
          <div class="form-group text-right">
            <input type="submit" class="btn btn-info shadow" value="Accept" name="accept">
          </div>
        </div>
      </div>
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="total-apply-tab" data-toggle="tab" href="#total-apply" role="tab" aria-controls="total-apply" aria-selected="true">
                            Total Apply
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="eligible-tab" data-toggle="tab" href="#eligible" role="tab" aria-controls="with-challan" aria-selected="false">
                            Eligible Candidates
                        </a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="total-apply" role="tabpanel" aria-labelledby="home-tab"></div>
                    <div class="tab-pane fade" id="eligible" role="tabpanel" aria-labelledby="profile-tab"></div>
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
  $query = "UPDATE candidate_applied_post SET status = 'Accepted', status_details = 'Application Accepted' WHERE post_id = '$post' AND status != 'Accepted' AND status = 'Inquiry'";
  $run_query = mysqli_query($connection,$query);
  if($run_query)
  {
  echo "<!DOCTYPE html>
        <html>
          <body> 
          <script>
          Swal.fire(
            'Under Inquiry !',
            'All candidates of selected post has been Accepted',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'rejection_accept_all.php';
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
    $(document).ready(function(){
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            getApplicantData();
        });
    })
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
      var candidateType = $(".nav-tabs .nav-item a.active").attr('id');
    if(post_id != '')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'rejection_accept_all_ajax.php',
        data: {
          postId: post_id,
            candidateType: candidateType
        },
        dataType: "html",
        success:function(result){
            $("#"+candidateType.replace('-tab', '')).html(result);
          $("#preloader").fadeOut(100); 
        }
      });
    }
    else
    {
      $("#totalC").html(0);
      $("#eligibleC").html(0);
    }
  }

</script>