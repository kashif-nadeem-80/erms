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
        <h4 class="m-0 text-dark">Active Projects Summarize Report</h4>
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
            <option value="0">First Select Project</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
         <div class="form-group">
          <label>City</label>
          <select class="form-control select2" onchange="getApplicantData()" name="city" id="city_id" required>
            <option value="all">All</option>
            <?php
            $fetchData = "SELECT * FROM city ORDER BY c_name ASC";
            $run = mysqli_query($connection,$fetchData);
            while ($row = mysqli_fetch_array($run)) {
              $id = $row['id'];
              $name = $row['c_name'];
            ?>
            <option value="<?php echo $id ?>"><?php echo $name ?></option>
          <?php } ?>
          </select>
        </div>
      </div>
    </div>

    <div class="row mb-0 pb-0" id="showExportSummary" style="display: none">
      <div class="col-md-12 text-right">
        <button type="button" class="btn btn btn-success" onclick="return export_all()"><i class="fa fa-file-excel"></i> Export to Excel</button>
        <!-- <button type="button" style="margin-right: 10px" class="btn btn-success" onclick="return export_specific()"><i class="fa fa-file-excel-o"></i> Export to Excel (Specific)</button> -->
      </div>
    </div>
    <hr class=" mt-0 pt-0">

      <div class="row">
          <div class="col-md-12">
              <div id="ajaxData" class="table-responsive">
              </div>
          </div>

      </div>
      <div class="row mb-2 mt-2 pb-0" id="showExportDetail" style="display: none">
          <div class="col-md-12 text-right">
              <button onclick="downloadSummarizeReport()" class="btn btn btn-success">
                  <i class="fa fa-file-excel"></i> Export Detail to Excel
              </button>
              <!-- <button type="button" style="margin-right: 10px" class="btn btn-success" onclick="return export_specific()"><i class="fa fa-file-excel-o"></i> Export to Excel (Specific)</button> -->
          </div>
      </div>
    <div class="row">
      <div class="col-md-12">

        <div class="table-responsive">
          <table class="table table-hover bg-white" id="ajaxDataTable" data-page-length="100" style="margin0; width: 100%;font-size: 11px">
            <thead class="bg-dark">
              <tr>
                  <th>S.No</th>
                  <th>Post</th>
                  <th>Name</th>
                  <th>Father Name</th>
                  <th>Contact #</th>
                  <th>Email</th>
                  <th>CNIC</th>
                  <th>DOB</th>
                  <th>Age</th>
                  <th>Gender</th>
                  <th>City</th>
                  <th>Address</th>
                  <th>Domicile</th>
                  <th>Quota</th>
                  <th>Education</th>
                  <th>Total Experience</th>
                  <th>Govt Employee</th>
                  <th>Eligible</th>
                  <th>Challan Submitted</th>
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
  function getPost()
  {
    var projId = $("#proj").val();
    $.ajax({
      method:'POST',
      url:'report_summarize_ajax.php',
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

  function downloadSummarizeReport() {
      var proj_id = $("#proj").val();
      var post_id = $("#post_id").val();
      var city_id = $("#city_id").val();
      if(proj_id != '') {
          window.open('report_summarize_download.php?proj_id='+proj_id+'&post_id='+post_id+'&city_id='+city_id);
      }

  }
  
  function getApplicantData()
  {

      getApplicantSummary();

      if ($.fn.DataTable.isDataTable('#ajaxDataTable')) {
          $('#ajaxDataTable').dataTable().fnClearTable();
          $('#ajaxDataTable').dataTable().fnDestroy();

      }


      $('#ajaxDataTable').DataTable({
          'processing': true,
          'serverSide': true,
          'serverMethod': 'post',

          'ajax': {
              'url':'report_summarize_ajax.php',
              'data': function(d) {
                  d.proj_id = $("#proj").val();
                  d.postId =  $("#post_id").val();
                  d.city_id = $("#city_id").val();
              }
          },
          'columns': [
              { data: 'sno' },
              { data: 'post_name' },
              { data: 'name' },
              { data: 'fatherName' },
              { data: 'contact_no' },
              { data: 'email' },
              { data: 'cnic' },
              { data: 'dob' },
              { data: 'age' },
              { data: 'gender' },
              { data: 'city' },
              { data: 'address' },
              { data: 'domicile' },
              { data: 'quota' },
              { data: 'education' },
              { data: 'total_exp' },
              { data: 'govt_emp' },
              { data: 'eligible' },
              { data: 'challan' },
          ],
          'drawCallback': function(setting) {
              $("#showExportDetail").show();
          }

      });

  }

  function getApplicantSummary() {
      var proj_id = $("#proj").val();
      var post_id = $("#post_id").val();
      var city_id = $("#city_id").val();
      if(proj_id != '' && post_id != '' && city_id != '')
      {
        $("#preloader").fadeIn(100);

        $.ajax({
          method:'POST',
          url:'report_summarize_ajax.php',
          data: {
              proj_id: proj_id,
              postId: post_id,
              city_id: city_id,
              summary: true
          },
          dataType: "html",
          success:function(result){
              $("#preloader").fadeOut(100);
              $("#showExportSummary").show();
              $("#ajaxData").html(result);
            // $(".datatable").DataTable();

          }
        }).done(function(){
          calculateTotal();
        });
      }
  }

  function calculateTotal() {
    var sum = 0;
    //iterate through each td based on class and add the values
    $(".male").each(function() {
      var value = $(this).text();
      //add only if the value is number
      if(!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
      }
    });
    $('#sumMale').text(sum);

    var sum = 0;
    //iterate through each td based on class and add the values
    $(".female").each(function() {
      var value = $(this).text();
      //add only if the value is number
      if(!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
      }
    });
    $('#sumFemale').text(sum);

    var sum = 0;
    //iterate through each td based on class and add the values
    $(".other").each(function() {
      var value = $(this).text();
      //add only if the value is number
      if(!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
      }
    });
    $('#sumOther').text(sum);
      var sum = 0;

      $(".notMention").each(function() {
          var value = $(this).text();
          //add only if the value is number
          if(!isNaN(value) && value.length != 0) {
              sum += parseFloat(value);
          }
      });
      $('#sumNotMention').text(sum);

    var sum = 0;
    //iterate through each td based on class and add the values
    $(".total").each(function() {
      var value = $(this).text();
      //add only if the value is number
      if(!isNaN(value) && value.length != 0) {
            sum += parseFloat(value);
      }
    });
    $('#sumTotal').text(sum); 
  }
</script>

<script type="text/javascript">
  // function export_specific()
  // {
  //   $("#studentsTable").tableHTMLExport({
  //     type:'csv',
  //     filename:'Students-Details-Specific.csv',
  //   });
  // }

  function export_all()
  {
    // $('.dataTable').DataTable().destroy();
    $("#export_table").tableHTMLExport({
      type:'csv',
      filename:'Summarize Report.csv',
    });
    // $('#export_table').DataTable();
  }
  function export_detail() {

      $("#export_table_full").tableHTMLExport({
          type:'csv',
          filename:'Detail Report.csv',
      });
  }
</script>