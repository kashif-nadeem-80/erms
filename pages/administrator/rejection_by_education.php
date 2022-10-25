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
                        <a class="nav-link" id="no-req-edu-tab" data-toggle="tab" href="#no-req-edu" role="tab" aria-controls="with-challan" aria-selected="false">
                            No Required Education
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="eligible-can-tab" data-toggle="tab" href="#eligible-can" role="tab" aria-controls="without-challan" aria-selected="false">
                            Eligible Candidates
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="total-apply" role="tabpanel" aria-labelledby="home-tab"></div>
                    <div class="tab-pane fade" id="no-req-edu" role="tabpanel" aria-labelledby="profile-tab"></div>
                    <div class="tab-pane fade" id="eligible-can" role="tabpanel" aria-labelledby="contact-tab"></div>
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
    var edu_level = $("#edu_level").val();
    var candidateType = $(".nav-tabs .nav-item a.active").attr('id');

    if(post_id != '' && edu_level != '')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'rejection_by_edu_ajax.php',
        data: {
          postId: post_id,
          edu_level: edu_level,
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
      $("#total").html(0);
      $("#eligible").html(0);
      $("#no_edu").html(0);
    }
  }

</script>