<?php
include('includes/header.php');
?>
<style type="text/css">
.inner:hover {
    opacity: 0.6;
}
</style>
<br>
<div class="container align-content-center">
        <section class="content position-absolute">
        <div class="card " >
            <div class="card-body   ">
                <div class="row">

                    <p> <span style="font-size:x-large ; font-weight:bolder; color: black;"> PBM </span>  </p>

                    <div class="row col-md-12 ">

                                    <hr class="shadow float-left" style="border: 1px solid #007bff; width: 100%; ">

                                    <table class="table-hover  table-responsive table-striped table-bordered bg-white 
                                    text-center"  style="font-size: 11px; width: 100%;">

                                    <thead class="bg-gradient-cyan"  >
                                            <tr>
                                                <th style="width:130px ;">Provincekk</th>
                                                <th class="w-25">Name</th>
                                                <th style="width:100px ;">Father Name</th>
                                                <th style="width:100px ;">Department</th>
                                                <th style="width:100px ;">Post Applied</th>
                                                <th  style="width:90px ;" class=" bg-gradient-green ">Result</th>

                                            </tr>
                                        </thead>
                                        
                                        <?php
                 
                  $count = 0;
      // echo "this test line";
      $query_r = "SELECT prov.pro_name, ct.c_name, c.id, pw.`written_marks`, pw.`written_weightage`, pw.`typing_marks`, pw.`typing_weightage`, 
      pw.`shorthand_marks`, pw.`shorthand_weightage`, c.name, c.`cnic`, c.f_name, 
       c.`telephone`,  r.roll_no, r.written_result,p.project_name,
       r.typing_result, r.shorthand_result, r.physical_result, pp.post_name, pp.id as post_id FROM result AS r 
      INNER JOIN assigned_center AS a ON a.roll_no = r.roll_no INNER JOIN projects_posts AS pp ON pp.id = a.post_id 
      INNER JOIN projects AS p ON p.id = pp.project_id INNER JOIN project_weightage AS pw ON pw.project_id = p.id 
      INNER JOIN candidate_applied_post AS ca ON ca.id = a.cand_applied_id INNER JOIN candidates AS c ON c.id = ca.candidate_id 
      LEFT JOIN district AS d ON d.id = c.district_id LEFT JOIN 
      province AS prov ON prov.id = d.pro_id LEFT JOIN city AS ct ON ct.id = ca.city_id 
    --   WHERE c.id='3'
    --   WHERE c.id='1045'
      WHERE c.id='$candd_id'
      ";

      
      $runData_r = mysqli_query($connection,$query_r);
      $countData_r = mysqli_num_rows($runData_r);
  // echo $countData_r;
      if($countData_r != '0' OR $countData_r != 0)

      $center_name_r = '...';
      $pro_name_r ='...';
      $result_r = '...';
      $name_r = '...';
      $father_name_r ='...';
      $post_name_r = '...';
      $department_r ='...';
      $written_marks_r = '...';

      {
      while($rowData_r = mysqli_fetch_array($runData_r)) {

      $count++;

      $center_name_r = $rowData_r['c_name'];
      $pro_name_r = $rowData_r['pro_name'];
      $result_r = $rowData_r['written_result'];
      $name_r = $rowData_r['name'];
      $father_name_r = $rowData_r['f_name'];
      $post_name_r = $rowData_r['post_name'];
      $department_r = $rowData_r['project_name'];
      $written_marks_r = $rowData_r['written_marks'];
      
       ?>
                                       

                                            <tr style="">

                                                <!-- <td><b style="font-size: large; color: cyne ;"><?php echo $status_c?></b></td> -->
                                                <td><?php echo $pro_name_r ?></td>
                                                <td><?php echo $name_r ?></td>
                                                <td><?php  echo  $father_name_r ?></td>
                                                <td><?php echo $department_r ?></td>
                                                <td><?php echo $post_name_r ?></td>
                                                <td class=" text-danger font-weight-bolder"><?php echo $result_r."/".$written_marks_r; ?></td>

                                            </tr>

                                            <?php } ?>
                                       


                                      </table>

                                      <span>
                                     </div>
                </div>
            </div>
        </div>
        </section>
    </div>
    


                    <?php } ?>

 <?php  if ($countData_r =='0') {  ?>

<!-- /////////start condition if result not available then status //////////////// -->

</span> </p> 

                    <section class="content">
    <div class="container">
        <div class="card">
            <div class="card-body ">
                <div class="row">

                    <p> <span style="font-size:x-large ; font-weight:bolder; color: black;"> Application Status </span>  </p>

                    <div class="row col-md-12">

                            



                                    <hr class="shadow float-left" style="border: 1px solid #007bff; width: 100%; ">

                                    <table class="table-hover table-responsive table-striped table-bordered bg-white text-center" 
                                    style="font-size: 11px; width: 100%;">

                                        <thead class="bg-gradient-cyan" >
                                            <tr>
                                                <th class="w-25">Status</th>
                                                <th>Reason of Rejection</th>
                                                <th>Name</th>
                                                <th>Father Name</th>
                                                <th>Post Applied</th>
                                                <th>Department</th>
                                                <th>Desired Test City</th>

                                            </tr>
                                        </thead>
                                        <?php
                 
                  $count = 0;
      // echo "this test line";
      $query2 = "select ct.c_name as city,p.status,p.status_details, c.name as Name, c.f_name as Father_Name,  c.cnic,
       c.phone CellNo,  pp.post_name
      , pj.project_name as Department
      from candidates as c 
      join candidate_applied_post as p on c.id=p.candidate_id
      join city as ct on  p.city_id = ct.id
      join projects_posts as pp on p.post_id = pp.id
      join projects as pj on pj.id = pp.project_id
      where  ct.test_center_status =1
      and c.id= '$candd_id'  order by p.status desc";

      
      $runData = mysqli_query($connection,$query2);
      $countData = mysqli_num_rows($runData);
  // echo $countData;
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
      $status_detail = $rowData['status_details'];
      
       ?>
                                       

                                            <tr>

                                                <td><b style="font-size: large; color: cyne ;"><?php echo $status_c?></b></td>
                                                <td class=" text-danger text-bold"><?php echo $status_detail ?></td>
                                                <td><?php echo $name ?></td>
                                                <td><?php echo $father_name ?></td>
                                                <td><?php echo $post_name ?></td>
                                                <td><?php echo $department ?></td>
                                                <td><b><?php echo $city?></b></td>

                                            </tr>

                                            <?php } ?>
                                       


                                      </table>

                                      <span>
                          <?php  if ($status_c =='Accepted') {  ?>

                            <img src="../../images/news1.gif" width="50px" height="50px">
                             <a href="roll_no_slip.php" style="width:230px ; align-items: center;"
                                class="btn  badge-pill badge-info shadow">Download Roll No Slip</a>

                        <?php } ?>        
                        </span> </p> 
                                </div>

                  
    </div>
    


    <?php } ?>
    
    <?php } ?>        
     <!-- end of the result condition -->


                    <!-- <span><img src="../../images/news1.gif" width="40px" height="40px"></span>
                    <p> <span style="font-size:x-large ; font-weight:bolder; padding-right: 80px;">

                            Mr. .......... Your application is rejected due to ........ </span> <span
                            style="align-items:center ;">
                            <a href="posts_applied.php" style="width:150px ; align-items: center;"
                                class="btn  badge-pill badge-danger shadow">Upload Challan</a>
                        </span> </p> -->



                </div>
                <br>
                <!-- <hr class="bg-blue h-100 border-4 "> -->
                <br>
                <br>

                <!-- <div class="row">
                    <div class="col-md-12">
                        <p> <span style="font-size:x-large ; font-weight:bolder; padding-right: 80px;">
                                How to Apply </span> <span style="align-items:center ;">
                                <a href="change_city.php" style="width:150px ; align-items: center;"
                                    class="btn  badge-pill badge-success shadow">Change Test City</a>
                            </span> </p>
                        <div style="border: 1px solid lightblue; width: 100%"></div>
                        <br>
                        <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">
                            <b>Step 1: Update Your Profile</b>
                        </div>
                        <ul>
                            <li>First Update Your Profile Carefully Do Not Miss any Field otherwise Your Application
                                will Be Rejected.</li>
                        </ul>
                        <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">

                            <b>Step 2: Education</b>
                        </div>
                        <ul>
                            <li>Add Your Education From Lower Level to High Level e.g, Matriculation, Intermediate, etc
                            </li>
                        </ul>
                        <div style="border: 1px solid lavender; width: 100%; background-color:aquamarine">
                            <b>Step 3: Experince </b>
                        </div>
                        <ul>
                            <li>Not Applicable (N.A)</li>
                            <!-- <li>Upload you Experience Certificate( if Applicable)</li> -->
                        <!-- </ul>
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
                        <div
                            style="border: 1px solid lavender; align-items: center; width: 100%; background-color:aquamarine">
                            <!-- <b>Step 6: Roll No </b>
</div>
            <ul>
              <li>Click On "Eye icon" to View Your Roll Number</li>
              <li>Click On "Print" to Download Your Roll Number Slip</li>
            </ul> -->
                            <!-- <a href="personal_information.php" style="width:230px ; align-items: center;"
                                class="btn btn-warning shadow">Next</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
</section>

<?php include('includes/footer.php') ?>