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

                    <hr class="shadow" style="border: 1px solid #007bff; width: 230px; ">

                    <table class="table table-striped table-bordered bg-white text-center"

                      style="font-size: 12px">

                      <thead class="bg-gray">

                        <tr>

                          <th>Post</th>

                          <th>Apply Date & Time</th>

                          <th>Desired Test City</th>

                        </tr>

                        <?php
                  //  echo $empid = $apply_id;
                  // echo $canddate_id;
                   
                        $query3 = "SELECT  pp.post_name,pp.post_bps,c.c_name,cap.apply_date FROM candidate_applied_post AS cap LEFT JOIN city AS c on c.id = cap.city_id

                        LEFT JOIN projects_posts AS pp ON pp.id= cap.post_id WHERE cap.candidate_id = '$canddate_id'";


                        $runData = mysqli_query($connection,$query3);
                        while($rowData = mysqli_fetch_array($runData)) {
                        // $count++;
                        $post_name = $rowData['post_name'];

                        $c_name = $rowData['c_name'];

                        $apply_date = date("d-m-Y h:i:s a", strtotime($rowData['apply_date']));

                        $post_bps = $rowData['post_bps'];
                          ?>

                      </thead>

                      <tbody>

                        <tr>

                          <td><b><?php echo $post_name." (BPS-".$post_bps.")"; ?></b></td>

                          <td><?php echo $apply_date; ?></td>

                          <td><?php echo $c_name; ?></td>

                        </tr>

                        <?php } ?>
                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

      

  

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