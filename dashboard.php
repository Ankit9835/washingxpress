<?php 
  include('connectdb.php');
  session_start();
  if($_SESSION['useremail'] == ''){
    header('location:index.php');
  }
?>
<?php include('layout/header.php'); ?>
<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Admin Dashboard </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
     
          <div class = "row">
          <div class="col-lg-6 col-xs-6">
            <?php 
            $select = $pdo->prepare("select * from tbl_admin");
            $select->execute();

           $admin =  $select->rowCount();

           $selectcust = $pdo->prepare("select * from tbl_customer");
            $selectcust->execute();

           $customer =  $selectcust->rowCount();


           


            ?>
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $admin ?> </h3>

              <p>Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i> 
            </div>
            <a href="registration.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
          </div>
       


        <div class="col-lg-6 col-xs-6">
         
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $customer; ?><sup style="font-size: 20px"></sup></h3>

              <p>Customer</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="customer.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

       


        
         </div>
        <!-- /.box-footer-->
     
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>