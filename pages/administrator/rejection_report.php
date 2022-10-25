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


      
    </form>
  </div>
  <div class="row printBlock">
    <div class="col-md-12">
      <div class="form-group text-right">
        <button class="btn btn-info shadow" onclick="dataPrint()">Print</button>
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
                    <a class="nav-link" id="reject-by-challan-tab" data-toggle="tab" href="#reject-by-challan" role="tab" aria-controls="with-challan" aria-selected="false">
                        Rejected By Challan
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reject-by-age-tab" data-toggle="tab" href="#reject-by-age" role="tab" aria-controls="without-challan" aria-selected="false">
                        Rejected By Age
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="reject-by-edu-tab" data-toggle="tab" href="#reject-by-edu" role="tab" aria-controls="without-challan" aria-selected="false">
                        Rejected By Education
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="eligible-tab" data-toggle="tab" href="#eligible" role="tab" aria-controls="without-challan" aria-selected="false">
                        Eligible Age
                    </a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="total-apply" role="tabpanel" aria-labelledby="home-tab"></div>
                <div class="tab-pane fade" id="reject-by-challan" role="tabpanel" aria-labelledby="profile-tab"></div>
                <div class="tab-pane fade" id="reject-by-age" role="tabpanel" aria-labelledby="contact-tab"></div>
                <div class="tab-pane fade" id="reject-by-edu" role="tabpanel" aria-labelledby="contact-tab"></div>
                <div class="tab-pane fade" id="eligible" role="tabpanel" aria-labelledby="contact-tab"></div>
            </div>
        </div>
    </div>
</section>
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
      var candidateType = $(".nav-tabs .nav-item a.active").attr('id');

    if(post_id != '')
    {
      $("#preloader").fadeIn(100);

      $.ajax({
        method:'POST',
        url:'rejection_report_ajax.php',
        data: {
          postId: post_id,
          projId: projId,
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