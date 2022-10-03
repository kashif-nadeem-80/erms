<?php

include "includes/header.php";

?>

<div class="content-header">

  <div class="container-fluid">

    <div class="row mb-2">

      <div class="col-md-6">

        <h4 class="m-0 text-dark">Avaliable Jobs</h4>

      </div>
      
      <div class="col-md-6">

        <ol class="breadcrumb float-md-right">

          <li class="breadcrumb-item"><a href="index.php">Home</a></li>

          <li class="breadcrumb-item active">...</li>

        </ol>

      </div>

    </div>

  </div>

</div>

<section class="content">

      
<div class="m-0 card-header  bg-info shadow-lg p-1 mb-0 bg-primary text-danger rounded">
            <div class="card-title"> </div>
          </div>
          <br>
          

  <div class="container-fluid" class="text-center">

  <?php
     
      
     $query1 = "select * from education WHERE candi_id = '$canddate_id'";
     $result1 = mysqli_query($connection,$query1);
     $rowN = mysqli_num_rows($result1);
    //  $id_edu = $rowData1['id'];
    //  $degree = $rowData1['degree_id'];
    //  $passingYear = $rowData1['passing_year'];
    //  $obtMarks = $rowData1['obtain_marks'];
     
    //  echo "degree" , $degree;
    //  echo "year", $passingYear;
    //  echo "marks" , $obtMarks;
    echo $canddate_id;
     echo "Row NUm--" , $rowN;


     $query = "select * from candidates WHERE id = '$canddate_id'";
     $result = mysqli_query($connection,$query);
     $rowData = mysqli_fetch_array($result);
     $d_id = $rowData['id'];
     $gender = $rowData['gender'];
     $disability = $rowData['disability'];
     $dob = $rowData['dob'];
     $city = $rowData['city'];
     $cellno = $rowData['telephone'];
    //  echo $dob;
    //  echo $city;

      if ($rowN<0 and $disability==0 and $gender==0 and is_null($dob) and is_null($city) and is_null($cellno) )
      {
        // echo "First fill bio data form ";
        echo "<!DOCTYPE html>
        <html>
          <body> 
          <script>
          Swal.fire(
            'Back !',
            'Please fill your bio data form and education first',
            'warning'
          ).then((result) => {
            if (result.isConfirmed) {
              window.location.href = 'personal_information.php';
            }
          });
          </script>
          </body>
        </html>";
      
      
      }
      ?>

    <div class="row">

      <div class="col-md-12 table-responsive">

        <table class="table table-hover bg-white">

          <thead class=" ">

            <tr>

              <th width="6%">S.No</th>

              <th>Projects/Jobs</th>

              <th>Action</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $count = 0;

            $query2 = "SELECT * FROM projects WHERE status = '1' AND last_date >= CURRENT_DATE() ORDER BY id DESC";

            $runData = mysqli_query($connection,$query2);

            $countData = mysqli_num_rows($runData);

            if($countData != '0' OR $countData != 0)

            {

            while($rowData = mysqli_fetch_array($runData)) {

            $count++;

            $pid = $rowData['id'];

            $encodeId = base64_encode($pid);

            $project_name  = $rowData['project_name'];
            $enProjectId=base64_encode($project_name);

            $last_date = date("d-m-Y",strtotime($rowData['last_date']));

            $advertisement  = $rowData['advertisement'];

            $adver = "../../images/admin/project/advertisement/".$advertisement;

            $app_form       = $rowData['app_form'];

            $app = "../../images/admin/project/app_form/".$app_form;

            ?>

          

            <tr>

              <td><?php echo $count; ?></td>

              <td>

                <span><img src="../../images/news1.gif" width="40px" height="40px"></span>

                <b style="font-size: 18px;" class="text-primary"><?php echo $project_name; ?></b><br>

                <span style="margin-left: 8%"><b class="text-secondary">Last Date of Apply :</b> <b

                style="color: orangered"><?php echo $last_date; ?></b></span>

              </td>

              <td>
           
               <a style="margin-top: 2px"  href="post_apply.php?id=<?php echo $encodeId;?>&projId=<?php echo $enProjectId;?>"

                class="btn btn-success btn-sm">Online Apply</a>

                <a style="margin-top: 2px" href="<?php echo $adver ?>" class="btn btn-warning btn-sm">Advertisement</a>

                <!-- <a style="margin-top: 2px" href="<?php echo $app ?>" class="btn btn-info btn-sm">Application Form</a> -->

              </td>

            </tr>

           <?php } }

                    else

                    {

                  ?>

                  <tr>

                    <td colspan="3" class="text-center font-weight-bold text-danger">No Post Available For Apply</td>

                  </tr>

                  <?php } ?>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</section>

<?php

include "includes/footer.php";

?>