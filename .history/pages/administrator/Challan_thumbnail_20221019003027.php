<?php

include('includes/header.php');
// print_r($_SESSION);
// echo $_SESSION['admin'];

?>

<style type="text/css">

  .inner:hover {

opacity: 0.6;

}

</style>

<br>

<section class="content">

  <div class="container-fluid">

    <h2></h2> 
    <p> <span style="font-size:xx-large ; font-weight:bolder; padding-right: 580px;"> 
    View Challan in Thumbnail </span> <span  style="align-items:center ;">  
             <!-- <a href="applications_status.php" style="width:150px ; align-items: center;" class="btn  badge-pill badge-success shadow" >Search</a>  
            </span> </p>  -->

    <div class="card"> 

      <div class="card-body">

        
       <hr style="border:2px solid darkblue;">



        <div class="container-fluid">

          <div class="row">

            <div class="col-md-6">

              <div class="form-group">

                <label>Project Title</label>

                <select class="form-control select" id="proj" onchange="getPost()" name="projectId" required>

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

                <select class="form-control select" onchange="getApplicantData()" name="post" id="post_id" required>

                  <option value="0">First Select Project</option>

                </select>

              </div>

            </div>

            <div class="col-md-6">

              <div class="form-group">

                <label>Application Status</label>

                <select class="form-control select2" onchange="getApplicantData()" id="candStatus" required>

                  <option value="Pending">Pending</option>

                  <option value="Accepted">Accepted</option>

                  <option value="Inquiry">Inquiry</option>

                  <option value="Rejected">Rejected</option>

                </select>

              </div>

            </div>

            <div class="col-md-6">

               <div class="form-group">

                <label>City</label>

                <select class="form-control select2" onchange="getApplicantData()" name="city" id="city_id" required>

                  <option value="0">All</option>

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



          <hr>



          <div class="row">

            <div class="col-md-12">

              <div id="ajaxData">

                <table class="table table-hover datatable bg-white w-100" data-page-length="100" style="font-size: 11px; width: 100%;">

                  <thead class="bg-dark">

                    <tr>

                      <th width="6%">S.No</th>

                      <th>Name</th>

                      <th>Father Name</th>

                      <!-- <th>Gender</th> -->

                      <th>CNIC NO</th>

                      <th>Contact No</th>

                      <th>Test City</th>

                      <!-- <th>Apply Date</th>

                      <th>Application Status</th>

                      <th>Status Details</th> -->

                      <th>Image</th>

                      <th>Challan view</th>

                    </tr>

                  </thead>

                </table>

              </div>

            </div>

          </div>

        </div>

      </div>

      <!-- card body end -->

    </div>

    <!-- card end -->

  </div>

</section>



<?php include('includes/footer.php') ?>

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

    var city_id = $("#city_id").val();

    var candStatus = $("#candStatus").val();



    if(post_id != '0' && city_id != '0')

    {

      $("#preloader").fadeIn(100);



      $.ajax({

        method:'POST',

        url:'applications_data_challan_ajax.php',

        data: {

            postId: post_id,

            city_id: city_id,

            candStatus: candStatus

        },

        dataType: "html",

        success:function(result){

          $("#ajaxData").html(result);

          $(".datatable").DataTable();

          $("#preloader").fadeOut(100);

          

        }

      });

    }

    else if(post_id != '0' && city_id == '0')

    {

      $("#preloader").fadeIn(100);



      $.ajax({

        method:'POST',

        url:'applications_data_challan_ajax.php',

        data: {

            post_id2: post_id,

            candStatus: candStatus

        },

        dataType: "html",

        success:function(result){



          $("#ajaxData").html(result);

          $(".datatable").DataTable();

          $("#preloader").fadeOut(100);



        }

      });

    }

    else if(post_id == '' && city_id == '0')

    {

      $("#ajaxData").html("");

    }

  }



  function pic_view(id)

  {

    $("#preloader").fadeIn(100);



    var pic_name = $("#pic_name"+id).val();

    $.ajax({

      method:'POST',

      url:'applications_data_challan_ajax.php',

      data: {

        pic_name: pic_name

      },

      datatype: "html",

      success:function(result){



        $(".image_view").html(result);

    $("#preloader").fadeOut(100);



    }

    });

  }



</script>



<!--Pic View Modal Start-->

<div class="modal fade" id="image_view" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" style="width:450px" role="document">

    <div class="modal-content image_view">



    </div>

  </div>

</div>

<!-- Modal end -->



<script type="text/javascript">

function Data_Ajax1(id) {



  var applyId = $("#applyId"+id).val();

  var autoInc = $("#autoInc"+id).val();

  $.ajax({

    method: 'POST',

    url: 'admin_ajax.php',

    data: {

      applyId_for_status: applyId,

      autoInc: autoInc

    },

    datatype: "html",

    success: function(data) {

      $(".modal_data").html(data);

    }

  });

}



function insertData1(id)

{

  $.ajax({

    url: 'admin_ajax.php',

    type: 'POST',

    data: $('#form_submit1').serialize(),

    dataType: 'html',

    success: function(data){

    }

  }).done(function(){

    getApplicantData();

  });

}





function challan_view(id) {

  var applyId = $("#applyId"+id).val();

  $.ajax({

    method:'POST',

    url:'admin_ajax.php',

    data: {

      apply_id: applyId

    },

    datatype: "html",

    success:function(result){

      $(".modal_data").html(result);

  }

  });

}



function applicant_view(id){

  var cand_id = $("#cand_id"+id).val();

  $.ajax({

    method:'POST',

    url:'applicant_details_ajax.php',

    data: {

      applicant_id: cand_id

    },

    datatype: "html",

    success:function(result){

      $(".info_appl").html(result);

  }

  });

}



</script>



<!-- Modal Start-->

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">

    <div class="modal-content modal_data">



    </div>

  </div>

</div>

<!-- Modal end -->





<!-- Modal Start-->

<div class="modal fade" id="info_appl" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered mw-100 w-75" role="document" >

    <div class="modal-content info_appl" >



    </div>

  </div>

</div>

<!-- Modal end -->



<!-- Modal Start-->

<div class="modal fade" id="edit1" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog bg-white" style="border: blue 2px solid; border-radius: 8px" role="document">

    <div class="modal-content1">



    </div>

  </div>

</div>

<!-- Modal end -->