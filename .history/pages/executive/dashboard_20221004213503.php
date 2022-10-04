<?php
include('includes/header.php');
print_r($_SESSION);
echo $_SESSION['admin'];
?>
<style type="text/css">
  .inner:hover {
opacity: 0.6;
}
</style>
<br>
<section class="content">
  <div class="container-fluid">
    <h2>Executive Dashboard</h2>
    <div class="card"> 
      <div class="card-body">
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-primary shadow">
              <div class="inner">
                <h3>
                  2333
                </h3>
                <p>Total Projects</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success shadow">
              <div class="inner">
                <h3>
                  2300
                </h3>
                <p>Active Projects</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="student_all.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col --> 
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning shadow">
              <div class="inner">
                <h3>
                  33
                </h3>

                <p><OBJECT>In-Active Projects</OBJECT></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- card body end -->
    </div>
    <!-- card end -->
  </div>
</section>

<?php include('includes/footer.php') ?>