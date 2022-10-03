<?php
include "includes/header.php";?>
<style>
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
        }
        .invoice {
            height: 460px;
        }
        .sizet {
            height: 482px !important;
        }
        .printClr
        {
          background: white;
        }

        .printBlock {
          display: none;
        }
    }
    
    input[type=checkbox] {
        height: 25px;
        width: 25px;
    }
    
    .verticalLine {
        border-width: 1px;
        border-color: grey;
        opacity: 0.5;
        border-style: solid;
        background: grey;
        height: 80px;
        margin-top: 40px;
    }
</style>
<?php
  $challan_id = $_GET['challan_id'];
  $fetchData= "SELECT cp.id,p.project_name,p.project_id,cp.test_amount,cp.amount_words,cp.bank1,cp.logo1,cp.branch1,cp.title1,cp.acc_no1,cp.bank2,cp.logo2,cp.branch2,cp.title2,cp.acc_no2,cp.bank3,cp.logo3,cp.branch3,cp.title3,cp.acc_no3,cp.challan_date,cp.challan_update,p.last_date FROM projects_challans AS cp INNER JOIN projects AS p ON p.id = cp.project_id WHERE cp.id = '$challan_id'";
  $runData = mysqli_query($connection,$fetchData);
  $rowData = mysqli_fetch_array($runData);
  $id       = $rowData['id'];
  $project_id       = $rowData['project_id'];
  $project_name       = $rowData['project_name'];
  $test_amount   = $rowData['test_amount'];
  $amount_words      = $rowData['amount_words'];

  $bank1      = $rowData['bank1'];
  $logo1      = $rowData['logo1'];
  $branch1      = $rowData['branch1'];
  $title1      = $rowData['title1'];
  $acc_no1      = $rowData['acc_no1'];

  $bank2      = $rowData['bank2'];
  $logo2      = $rowData['logo2'];
  $branch2      = $rowData['branch2'];
  $title2      = $rowData['title2'];
  $acc_no2      = $rowData['acc_no2'];

  $bank3      = $rowData['bank3'];
  $logo3      = $rowData['logo3'];
  $branch3      = $rowData['branch3'];
  $title3      = $rowData['title3'];
  $acc_no3      = $rowData['acc_no3'];
  $last_date      = date("d-m-Y",strtotime($rowData['last_date']));
?>
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6">
        <h4 class="m-0 text-dark">
          Challan Form
        </h4>
      </div>
      <div class="col-md-6">
        <ol class="breadcrumb float-md-right">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Challan Form</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
 <section class="content printClr">
  <div class="row printBlock">
    <div class="col-md-12">
      <a href="project_challan.php" class="btn btn-warning shadow mb-1">Back</a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="border border-dark invoice sizet">
      <div class="row">
        <div class="col-md-4">
          <img class="ml-2 mt-2" width="60px" height="50px" src="../../images/logo.png" alt="uts">
        </div>
        <div class="col-md-4">
          <h4>Universal Testing Services</h4>
          <p class="text- text-center"><span class="bg-dark uts text-white"> UTS Copy</span></p>
        </div>
        <div class="col-md-4">
          <span class="float-right"><b>Apply Last Date : <?php echo $last_date ?></b></span>
        </div>
      </div>
      <div class="row m-1">
        <div class="col-md-12">
          <p class="d-inline ">Date:_________________________</p>
          <p class="d-inline ml-5">Branch Code:__________________</p>
          <p class="d-inline float-right">Branch Name:_______________________________</p>
          <p class="float-right text-danger">نوٹ : برائی مہربانی فیس صرف ایک بینک میں جمع کروائیں.اور اس بینک کے دیۓ ہوۓ باکس پر نشان لگائیں۔ بینک مہر ہر کاپی پر ضروری ہے۔ براۓ مہربانی اصلی بینک سلپ یوٹی ایس کے پتہ پر بھجوادیں۔ یوٹی ایس کاپی کے بغیر درخواست نا مکمل سمجھی جائے
          گی۔ </p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table style="width: 100%">
            <tbody>
              <tr>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank1 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch1 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title1 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no1 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php if($bank2 != '') { ?>
                <td>
                  <div class="verticalLine"></div>
                </td>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank2 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo2 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch2 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title2 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no2 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php } ?>
                <?php if($bank3 != '') { ?>
                <td>
                  <div class="verticalLine"></div>
                </td>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank3 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch3 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title3 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no3 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row ml-1">
        <div class="col-md-5">
          <p><b>Applicant Name:</b>______________________________________</p>
        </div>
        <div class="col-md-4">
          <p><b>S/D of:</b>_______________________________</p>
        </div>
        <div class="col-md-3">
          <p><b>Cell No:</b>_____________________</p>
        </div>
      </div>
      <div class="row m-1 ">
        <div class="col-md-6">
          <p><b>CNIC No:</b>________________________________</p>
        </div>
        <div class="col-md-6">
          <p><b>Post Applied For:</b>_________________________________________________</p>
        </div>
      </div>
      <div class="row ml-1">
        <div class="col-md-3">
          <p><b>Amount RS:</b><b><u>&nbsp;<?php echo $test_amount ?> /-</u></b></p>
        </div>
        <div class="col-md-6">
          <p><b>Amount in Words:</b> <b><u><?php echo $amount_words ?>.</u></b></p>
        </div>
        <div class="col-md-3">
          <p><b>Project ID:</b> <b><u><?php echo $project_id ?></u></b></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-danger text-center">This Fee is non refundable and non transferable.</p>
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="col-md-12">
        <center><span>------------------------------------------------------------------------------------------------------------------------------------------------</span></center>
      </div>
    </div>
    <div class="border border-dark invoice">
      <div class="row">
        <div class="col-md-4">
          <img class="ml-2 mt-2" width="70px" height="60px" src="../../images/logo.png" alt="uts">
        </div>
        <div class="col-md-4">
          <h4>Universal Testing Services</h4>
          <p class="text- text-center"><span class="bg-dark uts text-white"> Candidate Copy </span></p>
        </div>
        <div class="col-md-4">
          <span class="float-right"><b>Apply Last Date : <?php echo $last_date ?></b></span>
        </div>
      </div>
      <div class="row m-1">
        <div class="col-md-12">
          <p class="d-inline ">Date:_________________________</p>
          <p class="d-inline ml-5">Branch Code:__________________</p>
          <p class="d-inline float-right">Branch Name:_______________________________</p>
          <p class="float-right text-danger">نوٹ : برائی مہربانی فیس صرف ایک بینک میں جمع کروائیں.اور اس بینک کے دیۓ ہوۓ باکس پر نشان لگائیں۔</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table style="width: 100%">
            <tbody>
              <tr>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span> <?php echo $bank1 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch1 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title1 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no1 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php if($bank2 != '') 
                { 
                 ?>
                <td>
                  <div class="verticalLine"></div>
                </td>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank2 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo2 ?>" alt="Logo"></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch2 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title2 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no2 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php 
                  } 
                ?>
                <?php if($bank3 != '') { ?>
                <td>
                  <div class="verticalLine"></div>
                </td>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank3 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch3 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title3 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no3 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row ml-1">
        <div class="col-md-5">
          <p><b>Applicant Name:</b>______________________________________</p>
        </div>
        <div class="col-md-4">
          <p><b>S/D of:</b>_______________________________</p>
        </div>
        <div class="col-md-3">
          <p><b>Cell No:</b>_____________________</p>
        </div>
      </div>
      <div class="row m-1 ">
        <div class="col-md-6">
          <p><b>CNIC No:</b>________________________________</p>
        </div>
        <div class="col-md-6">
          <p><b>Post Applied For:</b>_________________________________________________</p>
        </div>
      </div>
      <div class="row ml-1">
        <div class="col-md-3">
          <p><b>Amount RS:</b> <b><u><?php echo $test_amount ?> /-</u></b></p>
        </div>
        <div class="col-md-6">
          <p><b>Amount in Words:</b> <b><u><?php echo $amount_words ?>.</u></b></p>
        </div>
        <div class="col-md-3">
          <p><b>Project ID:</b> <b><u><?php echo $project_id ?></u></b></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-danger text-center">This Fee is non refundable and non transferable.</p>
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="col-md-12">
        <center><span>------------------------------------------------------------------------------------------------------------------------------------------------</span></center>
      </div>
    </div>
    <div class="border border-dark invoice">
      <div class="row">
        <div class="col-md-4">
          <img class="ml-2 mt-2" width="60px" height="50px" src="../../images/logo.png" alt="uts">
        </div>
        <div class="col-md-4">
          <h4>Universal Testing Services</h4>
          <p class="text- text-center"><span class="bg-dark uts text-white"> Bank Copy</span></p>
        </div>
        <div class="col-md-4">
          <span class="float-right"><b>Apply Last Date : <?php echo $last_date ?></b></span>
        </div>
      </div>
      <div class="row m-1">
        <div class="col-md-12">
          <p class="d-inline ">Date:_________________________</p>
          <p class="d-inline ml-5">Branch Code:__________________</p>
          <p class="d-inline float-right">Branch Name:_______________________________</p>
          <p class="float-right text-danger">نوٹ : برائی مہربانی فیس صرف ایک بینک میں جمع کروائیں.اور اس بینک کے دیۓ ہوۓ باکس پر نشان لگائیں۔</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <table style="width: 100%">
            <tbody>
              <tr>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank1 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo1 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch1 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title1 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no1 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php if($bank2 != '') { ?>
                <td>
                  <div class="verticalLine"></div>
                </td>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank2 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo2 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch2 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title2 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no2 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php } ?>
                <?php if($bank3 != '') { ?>
                <td>
                  <div class="verticalLine"></div>
                </td>
                <td>
                  <div class="row ml-1">
                    <div class="col-md-2">
                      <input type="checkbox">
                    </div>
                    <div class="col-md-6">
                      <span><?php echo $bank3 ?></span>
                    </div>
                    <div class="col-md-4">
                      <span><img height="50px" width="80px" src="../../images/admin/bank_logo/<?php echo $logo3 ?>" alt=""></span>
                    </div>
                  </div>
                  <div class="row ml-1">
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>Branch:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $branch3 ?></u></b></span>
                    </div>
                    <div class="col-md-12">
                      <label style="font-size: 12px;"><b>A/C Title:&nbsp;</b></label>
                      <span style="font-size: 12px;"><b><u><?php echo $title3 ?></u></b></span>
                    </div>
                    <div class=" col-md-12 ">
                      <label class=" " style="font-size: 12px;"><b>A/C No:&nbsp;</b></label>
                      <span style="font-size: 12px; "><b><u><?php echo $acc_no3 ?></u></b></span>
                    </div>
                  </div>
                </td>
                <?php } ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="row ml-1">
        <div class="col-md-5">
          <p><b>Applicant Name:</b>__________________________________________</p>
        </div>
        <div class="col-md-4">
          <p><b>S/D of:</b>_______________________________</p>
        </div>
        <div class="col-md-3">
          <p><b>Cell No:</b>_____________________</p>
        </div>
      </div>
      <div class="row m-1 ">
        <div class="col-md-6">
          <p><b>CNIC No:</b>________________________________</p>
        </div>
        <div class="col-md-6">
          <p><b>Post Applied For:</b>_________________________________________________</p>
        </div>
      </div>
      <div class="row ml-1">
        <div class="col-md-3">
          <p><b>Amount RS:</b> <b><u><?php echo $test_amount ?> /-</u></b></p>
        </div>
        <div class="col-md-6">
          <p><b>Amount in Words:</b> <b><u><?php echo $amount_words ?>.</u></b></p>
        </div>
        <div class="col-md-3">
          <p><b>Project ID:</b> <b><u><?php echo $project_id ?></u></b></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-danger text-center">This Fee is non refundable and non transferable.</p>
        </div>
      </div>
    </div>
    <br>
    <div class="row printBlock">
      <div class="col-md-12">
        <center>
          <button class="btn btn-info shadow" onclick="window.print();">Print</button>
          <a href="project_challan_edit.php?challan_id=<?php echo $challan_id ?>" class="btn btn-success shadow" title="Edit"><span>Edit</span></a>
        </center>
      </div>
    </div>
    <br>
  </div>
</section>

 <?php include "includes/footer.php"; ?>