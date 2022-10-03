<?php

if(isset($_POST['count']))
{
	$count= $_POST['count'];
?>

<div class="col-md-12" id="exp_data_row<?php echo $count ?>">
  <hr>
  <div class="row">
    <div class="col-md-4">
      <div class="form-group">
        <label>Organization/ Company</label>
        <input type="text" class="form-control" name="exp_company[]" placeholder="Organization/ Company" >
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Job Title(Job Relevent Experince)</label>
        <input type="text" class="form-control" name="exp_job[]" placeholder="Job Experince" >
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Date From</label>
        <input type="date" id="dateFrom<?php echo $count ?>" class="form-control" name="exp_datefrom[]">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Date To</label><span class="float-right" style="font-size:12px"><b>Currently Working</b> <input type="checkbox" value="yes" id="expStatus<?php echo $count ?>" onchange="currentlyWrkExp(<?php echo $count ?>)"></span>
        <input type="date" class="form-control" onchange="dToChange(<?php echo $count ?>)" id="working<?php echo $count ?>">
        <input type="hidden" name="exp_dateto[]" id="work_hide<?php echo $count ?>">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Total Experience</label>
        <input type="text" name="exp_total[]" id="tExperience<?php echo $count ?>" class="form-control" placeholder="Total Experience" readonly>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Pay Package (Rs)</label>
        <input type="number" placeholder="Pay Package" class="form-control" name="exp_payment[]">
      </div>
    </div>
</div>
  <div class="row">
    <div class="col-md-2">
      <button type="button" class="btn btn-danger shadow" onclick="remove_exp(<?php echo $count ?>)"><i class="fa fa-trash"></i> Remove</button>
    </div>
  </div>
</div>

<?php } ?>