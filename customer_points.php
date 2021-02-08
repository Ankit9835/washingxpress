<?php 
  include('connectdb.php');
  session_start();
  include('layout/header.php'); 
  if($_SESSION['username'] == ''){
    header('location:index.php');
  }

 
?>

<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Customer Point Form <small>it all starts here</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class = "box box-info">
            <div class = "box-header with-border">
              <h3 class = "box-title"> <a href = "productlist.php" class = "btn btn-primary" role = "button"> Back To Product List </a> </h3>
            </div>
            <form action = "" method = "post" name ="formname">
            <div class = "box-body">
              
                <div class = "col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Total Bill</label>
                    <input type="text" class="form-control" name = "txtbill" placeholder="Enter Bill Amount" required>
                  </div>

                

                <div class="form-group">
                  <label for="exampleInputEmail1">Point Percentage(5%)</label>
                  <input type="number" min = "1" step = "1" class="form-control" name = "txtpurchase" placeholder="Enter Purchase Price" readonly>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Total Point</label>
                  <input type="number" min = "1" step = "1" class="form-control" name = "txtsale" placeholder="Enter Sale Price" readonly>
                </div>

                </div>
                <div class = "col-md-6">
                  
                </div>
             
            </div>
            <div class = "box-footer">
              <button type="submit" name = "btnSave" class="btn btn-info">Add Product</button>
            </div>
             </form>
          </div>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>