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
        <h4 class="m-0 text-primary">QEC Operator's Report</h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Report</li>
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
            <select class="form-control select2" id="proj" onchange="getApplicantData()" required>
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
      </div>
    </form>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div id="ajaxData" class="table-responsive">
          <table class="table table-hover table-bordered datatable bg-white" data-page-length="100">
            <thead class="bg-dark">
              <tr>
                <th width="6%" class="text-center">S.No</th>
                <th>Operator Name</th>
                <th>Contact No</th>
                <th class="text-center">Total Applications Submitted</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
  include "includes/footer.php";
?>

<script type="text/javascript">

  function getApplicantData()
  {
    let proj_id = $("#proj").val();

    $("#preloader").fadeIn(100);
    $.ajax({
      method:'POST',
      url:'report_qec_ajax.php',
      data: {
          proj_id: proj_id
      },
      dataType: "html",
      success:function(result){
        $("#ajaxData").html(result);
        $(".datatable").DataTable();
      }
    }).done(function(){
      $("#preloader").fadeOut(10);
      calculateTotal();
    });
  }

  function calculateTotal() {
    var sum = 0;
    //iterate through each td based on class and add the values
    $(".totalApp").each(function() {
      var value = $(this).text();
      //add only if the value is number
      if(!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
      }
    });
    $('#sumtotal').text(sum);
  }
</script>