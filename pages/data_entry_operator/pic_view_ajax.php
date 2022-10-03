<?php
include "includes/db.php";

//////////Disablilty Certificate///////////////
if(isset($_POST['disability']))
{
?>

<div class="modal-header bg-dark">
  <h5 class="modal-title">Disability Certificate</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $disability = $_POST['disability'];
  $path    = "../../images/candidates/disability certificate/".$disability;
?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <img src="<?php echo $path ?>" width = "100%" height="300px">
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<?php }




//////////Widow Certificate///////////////
if(isset($_POST['widow_file']))
{
?>

<div class="modal-header bg-dark">
  <h5 class="modal-title">Death's Certificate</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<?php 
  $widow_file = $_POST['widow_file'];
  $path    = "../../images/candidates/death certificate/".$widow_file;
?>

<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <img src="<?php echo $path ?>" width = "100%" height="300px">
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12 text-center">
      <button type="button" class="btn btn-danger shadow" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
<?php }

/////////// Education Degree Image ///////////////
if (isset($_POST['edu_image1'])) 
{

  $edu_image1 = $_POST['edu_image1'];
?>
<div class="modal-header bg-dark">
  <h5 class="modal-title">Education Certificate/Degree</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<div class="modal-body" style="padding: 0px !important;  text-align: center;">
  <div class="row">
    <div class="col-md-12"><br>
      <img src="<?php echo $edu_image1 ?>" width="98%" height="340px">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <center>
        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </center>
    </div>
  </div>
  <br>
</div>

<?php
}


//////////////// Experince Employement //////////////
if (isset($_POST['std_image1'])) {
$std_image1 = $_POST['std_image1'];
?>
<div class="modal-header bg-dark">
  <h5 class="modal-title">Experince Certificate</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true" class="text-white"><i class="fa fa-times"></i></span>
  </button>
</div>
<div class="modal-body" style="padding: 0px !important;  text-align: center;">
  <div class="row">
    <div class="col-md-12"><br>
      <img src="<?php echo $std_image1 ?>" width="98%" height="340px">
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <center>
      <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
      </center>
    </div>
  </div>
  <br>
</div>
<?php
} ?>