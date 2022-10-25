<?php
include "includes/header.php";
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.min.css" integrity="sha512-rxThY3LYIfYsVCWPCW9dB0k+e3RZB39f23ylUYTEuZMDrN/vRqLdaCBo/FbvVT6uC2r0ObfPzotsfKF9Qc5W5g==" crossorigin="anonymous" />
<form method="post">
<div class="row">
	
	<div class="col-md-4 ml-2 mt-5">
		<input type="text" class="form-control date" placeholder="DD/MM/YYYY" name="ddd">
		<input type="date" class="form-control" placeholder="DD/MM/YYYY" name="d1">
	</div>
	<input  type="submit" name="a">


</div>
</form>
<?php
	if(isset($_POST['a']))
	{

		echo date("Y-m-d",strtotime($_POST['ddd']));
		echo $_POST['d1']." \n";
		
	}
?>


<?php include "includes/footer.php"; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(".date").datepicker({
		autoclose: true,
        todayHighlight: true,
		format: 'dd-mm-yyyy'
	});
</script>