<?php
include "includes/header.php";
?>
<style>
  @media print
  {
    .printBlock
    {
      display: none;
    }
  }
  .modal { overflow: auto !important; }
  
</style>

<section class="content" style="overflow-x: hidden;">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-12 text-center">
        <h4 class="m-0 text-dark">Rejection Report</h4>
        <p class="text-danger">Before checking this report first do all above steps one by one</p>
        <hr class="shadow">
      </div>
    </div>
    <form method="post">
      <div class="row">
        <div class="col-md-5">
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

      <hr class="shadow">

      <div class="row">
        <div class="col-md-12">
          <h5>Total Apply : <span id="totalAp" class="text-primary">0</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Reject By Challan : <span id="challanC" class="text-danger">0</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Reject By Age : <span id="rejAge" class="text-danger">0</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Reject By Education : <span id="rejEdu" class="text-danger">0</span></h5>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <h5>Eligible Candidates : <span id="eligibleC" class="text-success">0</span></h5>
        </div>
      </div>
      <br><br>
      
    </form>
  </div>
  <div class="row printBlock">
    <div class="col-md-12">
      <div class="form-group text-center">
        <button class="btn btn-info shadow" onclick="dataPrint()">Print</button>
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
      url:'rejection_report_ajax.php',
      data: {
          projId_post: projId
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
    var projId = $("#proj").val();

    if(post_id != '')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'rejection_report_ajax.php',
        data: {
          postId: post_id,
          projId: projId
        },
        dataType: "json",
        success:function(result){
          $("#totalAp").html(result.total);
          $("#challanC").html(result.challan);
          $("#rejAge").html(result.age);
          $("#rejEdu").html(result.edu);
          $("#eligibleC").html(result.eligibleC);
          $("#preloader").fadeOut(100);
        }
      });
    }
    else
    {
      $("#total").html(0);
      $("#challanC").html(0);
      $("#rejAge").html(0);
      $("#rejEdu").html(0);
      $("#eligibleC").html(0);
    }
  }

  function dataPrint()
  {
    $('.select2').data('select2').destroy();
    window.print();
    $(".select2").select2({
      theme: 'bootstrap4'
    });
  }

</script>