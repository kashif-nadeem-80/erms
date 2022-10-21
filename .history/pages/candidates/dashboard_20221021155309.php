<?php
include('includes/header.php');
?>
<style type="text/css">
  .inner:hover {
opacity: 0.6;
}
</style>
<br>
<section class="content">
  <div class="container">
    <div class="card"> 
      <div class="card-body">
        <div class="row">

        
        <div class="row p-0 m-0">

              <div class="col-md-12 text-center text-primary">

                <div class="row">

                  <div class="col-md-12 table-responsive">

                    <h4>Applied Post Details</h4>

                    <hr class="shadow" style="border: 1px solid #007bff; width: 120px; ">

                    <table class="table table-striped table-bordered bg-white text-center"

                      style="font-size: 12px">

                      <thead class="bg-gradient-green">

                        <tr>

                          <th>Post</th>

                          <th>Apply Date & Time</th>

                          <th>Desired Test City</th>

                        </tr>
                        </thead>
                        <?php
                  //  echo $empid = $apply_id;
                  // echo $canddate_id;
                   
                  $count = 0;
      // echo "this test line";

      $query2 = "select ct.c_name as city,p.status, c.name as Name, c.f_name as Father_Name,  c.cnic,
       c.phone CellNo,  pp.post_name
      , pj.project_name as Department
      from candidates as c 
      join candidate_applied_post as p on c.id=p.candidate_id
      join city as ct on  p.city_id = ct.id
      join projects_posts as pp on p.post_id = pp.id
      join projects as pj on pj.id = pp.project_id
      where  ct.test_center_status =1
      and c.cnic='42501-1920421-1'";

      $runData = mysqli_query($connection,$query2);

      $countData = mysqli_num_rows($runData);
   echo $countData;
      if($countData != '0' OR $countData != 0)

      {

      while($rowData = mysqli_fetch_array($runData)) {

      $count++;

      $city = $rowData['city'];
      $status_c = $rowData['status'];
      $name = $rowData['Name'];
      $father_name = $rowData['Father_Name'];
      $post_name = $rowData['post_name'];
      $department = $rowData['Department'];
      
       ?>


                      <tbody>

                        <tr>

                          <td><b><?php echo $city?></b></td>

                          <td><?php echo $name ?></td>

                          <td><?php echo $father_name ?></td>

                        </tr>

      <?php } ?>
    </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

      
            <?php } ?>
  

        <span><img src="../../images/news1.gif" width="40px" height="40px"></span>  
        <p> <span style="font-size:x-large ; font-weight:bolder; padding-right: 80px;"> 
        
            Mr. .......... Your application is rejected due to ........ </span> <span style="align-items:center ;">  
             <a href="posts_applied.php" style="width:150px ; align-items: center;" 
             class="btn  badge-pill badge-danger shadow" >Upload Challan</a>  
            </span> </p> 

        

        </div>
        <br>
        <hr class="bg-blue h-100 border-4 ">
        <br>
        <br>

        <div class="row">
          <div class="col-md-12">
           <p> <span style="font-size:x-large ; font-weight:bolder; padding-right: 80px;"> 
            How to Apply </span> <span style="align-items:center ;">  
             <a href="change_city.php" style="width:150px ; align-items: center;" class="btn  badge-pill badge-success shadow" >Change Test City</a>  
            </span> </p> 
            <div style="border: 1px solid lightblue; width: 100%"></div>
            <br>
            <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">
              <b >Step 1: Update Your Profile</b>
          </div>
            <ul>
              <li>First Update Your Profile Carefully Do Not Miss any Field otherwise Your Application will Be Rejected.</li>
            </ul>
            <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">

            <b>Step 2: Education</b>
            </div>
            <ul><li>Add Your Education From Lower Level to High Level e.g, Matriculation, Intermediate, etc</li>
            </ul>
            <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">
              <b>Step 3: Experince </b>
          </div>
            <ul><li>Not Applicable (N.A)</li> 
              <!-- <li>Upload you Experience Certificate( if Applicable)</li> -->
            </ul>
            <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">
              <b>Step 4: Apply For Posts</b>
</div>
            <ul>
              <li>Click on Apply Online</li>
              <li>Select Post</li>
              <li>Select Test City</li>
              <li>Make sure you go through the Agreement</li>
              <li>Submit Your Application</li>
            </ul>
            <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">
              <b>Step 5: Print e-Receipts</b>
</div>
            <ul>
              <li>First Download Your Bank Challan</li>
              <li>Submit Your Payment with Concerned Bank</li>
              <li>Then Upload Your paid UTS copy</li>
            </ul>
            <div style="border: 1px solid lavender; align-items: center; width: 100%; background-color:aquamarine">
              <!-- <b>Step 6: Roll No </b>
</div>
            <ul>
              <li>Click On "Eye icon" to View Your Roll Number</li>
              <li>Click On "Print" to Download Your Roll Number Slip</li>
            </ul> -->
            <a href="personal_information.php" style="width:230px ; align-items: center;" class="btn btn-warning shadow" >Next</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php') ?>