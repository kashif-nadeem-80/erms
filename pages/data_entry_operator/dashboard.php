<?php
include('includes/header.php');
?>
<style type="text/css">
  .inner:hover {
opacity: 0.6;
}
</style>
<br>
<?php
  $fetchDataG= "SELECT p.id FROM project_to_operator AS o INNER JOIN projects_posts AS p ON p.id = o.post_id WHERE o.status = '1' AND o.operator_id = '$dataEntryId'";
  $runDataG = mysqli_query($connection,$fetchDataG);
  @$totalProjG = mysqli_num_rows($runDataG);

?>
<section class="content">
  <div class="container-fluid">
    <?php if($totalProjG == 0)
    { ?>
    <div class="row">
      <div class="col-md-12 text-center">
        <b>No Project Assign</b>
      </div>
    </div>
    <?php } else {
    echo "<script>window.location.href='application_add.php'</script>";
    } ?>
  </div>
</section>

<?php include('includes/footer.php') ?>