<?php
if (isset($_POST['std_image1'])) {
$std_image1 = $_POST['std_image1'];
?>
<div class="modal-body" style="padding: 0px !important;  text-align: center;">
  <div class="row">
    <div class="col-md-12"><br>
      <img src="<?php echo $std_image1 ?>" width="100%" height="340px">
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
?>
