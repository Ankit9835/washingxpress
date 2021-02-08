 <?php include('connectdb.php');
 session_start();
  include('layout/header.php');
   if($_SESSION['useremail'] == ''){
    header('location:index.php');
  }

  $id = $_GET['id'];
  $select = $pdo->prepare("select * from tbl_admin where userid =" .$id);
  $select->execute();
  $row = $select->fetch(PDO::FETCH_OBJ);

  $name = $row->username;
  $email = $row->useremail;
  $password = $row->password;



              if(isset($_POST['btnUpdate'])){
                $name = $_POST['txtname'];
                $email = $_POST['txtemail'];
                $password = $_POST['txtpassword'];
                

                if(empty($name && $email && $password)){
                  $errorupdate = '

                      <script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Error",
                  text: "Fill All The Blanks",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>


                  ';
                  echo $errorupdate;
                }  if(!isset($errorupdate)){ 
                        $update = $pdo->prepare("update tbl_admin set username =:username, useremail =:email, password=:password where userid=".$id);
                        $update->bindparam(':username',$name);
                        $update->bindparam(':email',$email);
                        $update->bindparam(':password',$password);
                       

                        if($update->execute()){
                           echo '<script type = "text/javascript">
                            jQuery(function validation(){
                                swal({
                                    title: "Awesome",
                                    text: "Category Has Been Updated",
                                    icon: "success",
                                    button: "Close",
                                  });
                              });


        </script>';
      } else {
           echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Error",
                  text: "Please Try Again",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>';
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
        <div class="col-md-6">

          <!-- general form elements -->
          
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method = "post" action = "">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" value = "<?php echo $name; ?>" name = "txtname" placeholder="Enter Name">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Email Address</label>
                  <input type="email" class="form-control" value = "<?php echo $email; ?>" name = "txtemail" placeholder="Enter Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Password</label>
                 <input type="password" class="form-control" value = "<?php echo $password; ?>" name = "txtpassword" placeholder="Enter Password">

                 
                </div>

               
               
              </div>
              <!-- /.box-body -->

             
                <button type="submit" name = "btnUpdate" class="btn btn-info">Update</button>
             
            </form>
          </div>

        </div>