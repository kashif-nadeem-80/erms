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
        <h4 class="m-0 text-dark ">Change Status of All Candidates To <span class="text-info">Rejected</span> With No Challan</h4>
        <p class="text-danger">Before Rejection First Change Status To Under Inquiry</p>
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
                    <input type="submit" class="btn btn-info shadow" value="Reject" name="reject">
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
                    <a class="nav-link" id="with-challan-tab" data-toggle="tab" href="#with-challan" role="tab" aria-controls="with-challan" aria-selected="false">
                        Candidates with challan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="without-challan-tab" data-toggle="tab" href="#without-challan" role="tab" aria-controls="without-challan" aria-selected="false">
                        Candidates without challan
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="total-apply" role="tabpanel" aria-labelledby="home-tab"></div>
                <div class="tab-pane fade" id="with-challan" role="tabpanel" aria-labelledby="profile-tab"></div>
                <div class="tab-pane fade" id="without-challan" role="tabpanel" aria-labelledby="contact-tab"></div>
            </div>
        </div>
      </div>



    </form>
  </div>
</section>
<?php 
if(isset($_POST['reject']))
{
  $date       = date("Y-m-d H:i:s");
  $post = $_POST['post'];
  $query = "UPDATE candidate_applied_post SET status = 'Rejected', status_details = 'Challan is missing', update_date = '$date' WHERE post_id = '$post' AND challan_file IS NULL AND status != 'Accepted'";
  $run_query = mysqli_query($connection,$query);
  if($run_query)
  {
  echo "<!DOCTYPE html>
        <html>
          <body> 
          <script>
          Swal.fire(
            'Rejected !',
            'Candidates without challans, of selected post has been Rejected',
            'success'
          ).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'rejection_by_challan.php';
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
      var candidateType = $(".nav-tabs .nav-item a.active").attr('id');
    var post_id = $("#post_id").val();

    if(post_id != '')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'rejection_byChallan_ajax.php',
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
      $("#totalAp").html(0);
      $("#withChal").html(0);
      $("#withOutChal").html(0);
    }
  }

</script>