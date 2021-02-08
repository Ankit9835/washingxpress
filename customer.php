
<?php include('connectdb.php');
 session_start();
  include('layout/header.php');
  if($_SESSION['useremail'] == ''){
    header('location:index.php');
  }


  if(isset($_POST['btnSave'])){
    $customer = $_POST['txtcustomer'];
    $aadhar = $_POST['txtaadhar'];
    $adminid = $_POST['adminid'];
    $contact = $_POST['txtcontact'];
    $card = $_POST['txtcard'];
    $customer_id='';


    if(empty($customer && $aadhar && $contact && $card)){
      $error = '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "OOPS!! Something Missing.",
                  text: "Fill All The Label",
                  icon: "warning",
                  button: "Close",
                });
            });


        </script>';
        echo $error;
    }

    if(!isset($error)){
      $insert = $pdo->prepare("insert into tbl_customer(customer_name,aadhar_number,admin_id,contact_number,card_number)values(:customer,:aadhar,:adminid,:contact,:card)");
      $insert->bindparam(':customer',$customer);
      $insert->bindparam(':aadhar',$aadhar);
      $insert->bindparam(':adminid',$adminid);
      $insert->bindparam(':contact',$contact);
      $insert->bindparam(':card',$card);
     
      $insert->execute();


      $customer_id = $pdo->lastInsertId();
     
    
      if($customer_id!=null){
        //print_r($customer_id);
          $insert = $pdo->prepare("insert into tbl_point(customer_id,total_point,redeem_point,current_point)values('$customer_id','0','0','0')");
          //$insert->bindparam(':customer',$customer_id);
          //$insert->bindValue(':total', null, PDO::PARAM_INT);
          //$insert->bindValue(':redeem', null, PDO::PARAM_INT);
          //$insert->bindValue(':current', null, PDO::PARAM_INT);
         
             $insert->execute();
              include('sms.php');
      }
    }
      echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Awesome!",
                  text: "You Are Registered SuccessFully!",
                  icon: "success",
                  button: "Close",
                });
            });


        </script>';
        header('refresh:2;customer.php');
  }

 ?>



 

<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Customer Form
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
      <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Customer Form</h3>
            </div>

      <div class="row">



           <div class="box-body">
                 <form role="form" method = "post" action = "">
                  <?php
                    if(isset($_POST['btn-edit'])){
                      $select = $pdo->prepare("select * from tbl_customer where id=".$_POST['btn-edit']);

                      $select->execute();

                      if($select){
                        $row = $select->fetch(PDO::FETCH_OBJ);
                         echo '
                          <div class="col-md-4">

          <!-- general form elements -->
          
            <!-- /.box-header -->
            <!-- form start -->
           
            
                <div class="form-group">
                 
                  <label for="exampleInputEmail1">Customer Name</label>
                  <input type="hidden" class="form-control" value = "'.$row->id.'" name = "txtid">
                  <input type="text" class="form-control" value = "'.$row->customer_name.'" name = "txtcustomer" placeholder="Enter Customer">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Aadhar Number</label>
                  <input type="text" class="form-control" value = "'.$row->aadhar_number.'" name = "txtaadhar" placeholder="Enter Aadhar Number">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Contact Number</label>
                  <input type="number" class="form-control" value = "'.$row->contact_number.'" name = "txtcontact" placeholder="Enter Contact Number">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Card Number</label>
                  <input type="text" class="form-control" value = "'.$row->card_number.'" name = "txtcard" placeholder="Enter Card Number">
                </div>
               
                 <button type="submit" name = "btnUpdate" class="btn btn-warning">Update</button>
               
              </div>

                      ';
                      }

                    } else {
                      echo '
                          <div class="col-md-4">

          <!-- general form elements -->
          
            <!-- /.box-header -->
            <!-- form start -->
           
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Customer Name</label>
                    <input type = "hidden" name = "adminid" value = "'.$_SESSION['userid'].'" class = "form-control">
                  <input type="text" class="form-control" name = "txtcustomer" placeholder="Enter Customer">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Aadhar Number</label>
                  <input type="number" class="form-control" name = "txtaadhar" placeholder="Enter Aadhar Number">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Contact Number</label>
                  <input type="number" class="form-control" name = "txtcontact" placeholder="Enter Contact Number">
                </div>

                 <div class="form-group">
                  <label for="exampleInputEmail1">Card Number</label>
                  <input type="text" value = "WE/2019-20/" class="form-control" name = "txtcard" placeholder="Enter Card Number">
                </div>
               
                 <button type="submit" name = "btnSave" class="btn btn-warning">Save</button>
               
              </div>

                      ';
                    }
                  ?>
        
        <!-- left column -->
        
              <!-- /.box-body -->

            <?php
              if(isset($_POST['btnUpdate'])){
                $customer = $_POST['txtcustomer'];
                $aadhar = $_POST['txtaadhar'];
                $id = $_POST['txtid'];
                $contact = $_POST['txtcontact'];
                $card = $_POST['txtcard'];

                if(empty($customer && $aadhar && $contact && $card)){
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
                        $update = $pdo->prepare("update tbl_customer set customer_name =:customer, aadhar_number =:aadhar, contact_number=:contact, card_number=:card where id=".$id);
                        $update->bindparam(':customer',$customer);
                        $update->bindparam(':aadhar',$aadhar);
                        $update->bindparam(':contact',$contact);
                        $update->bindparam(':card',$card);

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
               
             
            
          <!-- /.box -->

          <!-- Form Element sizes -->
          
          <!-- /.box -->

          
          <!-- /.box -->

          <!-- Input addon -->
         
          <!-- /.box -->

       

        <div class = "col-md-8">
          <table id = "example1" class = "table table-striped">
            <thead>
                <tr>
                  
                    <th> Customer Name </th>
                    <th> Aadhar Number </th>
                    <th> Contact Number </th>
                    <th> Card Number </th>
                    <th> EDIT </th>
                    
                    <th> DELETE </th>
                 
                </tr>
            </thead>
            <tbody>
              <?php 
                  $select = $pdo->prepare("select * from tbl_customer order by id desc");
                  $select->execute();

                  while($row = $select->fetch(PDO::FETCH_OBJ)){
                  echo '

                      <tr>
                        <td>' . $row->customer_name . '</td>

                        <td>' . $row->aadhar_number . '</td>

                        <td>' . $row->contact_number . '</td>

                        <td>' . $row->card_number . '</td>

                        <td> <button type = "submit" name = "btn-edit" value = "'.$row->id.'" class = "btn btn-success"> EDIT </button>  </td>
                        
                          <td> <button id = '.$row->id.' class = "btn btn-danger btndelete" role = "button">  <span class = "glyphicon glyphicon-trash" data-toggle = "tooltip" style = "color:black;" title = "Delete Product"> </span> </button>    </td>

                         
                      </tr>

                    ';
                  }
             ?>
            </tbody>
          </table>
        </div>
        </form>
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
  <script >
     $(document).ready(function(){
        $('.btndelete').click(function(){
              //alert('Test');

              var tdh = $(this);
              var id = $(this).attr("id");
              console.log(id);

            

                       $.ajax({

                              url:'customerdelete.php',
                              type:'post',
                              data:{
                                  pidd:id
                                },
                              success: function(data){
                                tdh.parents('tr').hide();
                              }

                          });


                    
                    
                  });
         });

              //alert(id);

             


  </script>
<?php include('layout/footer.php'); ?>


