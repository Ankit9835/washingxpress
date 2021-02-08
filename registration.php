
<?php include('connectdb.php');
 session_start();
  include('layout/header.php');
   if($_SESSION['useremail'] == ''){
    header('location:index.php');
  }

  error_reporting(0);

  $id = $_GET['id'];

  $delete = $pdo->prepare("delete from tbl_admin where userid =" .$id);

  if($delete->execute()){
     echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Yaayy!!",
                  text: "You SuccessFully Deleted Your data",
                  icon: "success",
                  button: "Close",
                });
            });


        </script>';
       header('refresh:1;registration.php');
  }




  if(isset($_POST['btnSave'])){
    $name = $_POST['txtname'];
    $email = $_POST['txtemail'];
    $pass = $_POST['txtpassword'];
   

    //echo $name . " - " . $email . " - " . $pass . " - " . $role;

    $insert = $pdo->prepare("insert into tbl_admin(username, useremail, password)values(:name,:email,:pass)");

    $insert->bindparam(':name',$name);
    $insert->bindparam(':email',$email);
    $insert->bindparam(':pass',$pass);
    

    if(isset($_POST['txtemail'])){

    $select = $pdo->prepare("select useremail from tbl_admin where useremail = '$email'");
    $select->execute();

    if($select->rowCount()>0){
      echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "OOPS!!",
                  text: "Email Already Exists",
                  icon: "warning",
                  button: "Close",
                });
            });


        </script>';
    } else {
        if($insert->execute()){
          echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Awesome!!",
                  text: "You Are Registered SuccessFully",
                  icon: "success",
                  button: "Close",
                });
            });


        </script>';
        } else {
          echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "OOPS Something Went Wrong!!",
                  text: "Fill Form Again",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>';
       }
    }

  }

    
  }

 ?>

<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registration Form
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Registration Form</h3>
            </div>

      <div class="row">
         
        
        <!-- left column -->
        <div class="col-md-4">

          <!-- general form elements -->
          
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method = "post" action = "">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name = "txtname" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email Address</label>
                  <input type="email" class="form-control" name = "txtemail" placeholder="Enter Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Password</label>
                 <input type="password" class="form-control" name = "txtpassword" placeholder="Enter Password">

                 
                </div>

               
               
              </div>
              <!-- /.box-body -->

             
                <button type="submit" name = "btnSave" class="btn btn-info">Save</button>
             
            </form>
          </div>
          <!-- /.box -->

          <!-- Form Element sizes -->
          
          <!-- /.box -->

          
          <!-- /.box -->

          <!-- Input addon -->
         
          <!-- /.box -->

       

        <div class = "col-md-8">
          <table class = "table table-striped">
            <thead>
                <tr>
                  
                    <th> Name </th>
                    <th> Email </th>
                    <th> Password </th>
                  
                    <th> EDIT </th>
                 
                </tr>
            </thead>
            <tbody>
             <?php 
                  $select = $pdo->prepare("select * from tbl_admin where userid =" .$_SESSION['userid']);
                  $select->execute();

                  while($row = $select->fetch(PDO::FETCH_OBJ)){

                    echo '

                      <tr>
                        <td>' . $row->username . '</td>
                        <td>' . $row->useremail . '</td>
                        <td>' . $row->password . '</td>
                      
                         <td> <a href = "admin_edit.php?id='.$row->userid.'" class = "btn btn-success" role = "button">  <span class = "glyphicon glyphicon-edit" title = "delete"> </span> </a>  </td>
                      </tr>

                    ';
                  }
             ?>
               
            </tbody>
          </table>
        </div>
         </div>
        <!--/.col (left) -->
        <!-- right column -->
       
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php include('layout/footer.php'); ?>


