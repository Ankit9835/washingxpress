<?php 
  include('connectdb.php');
  
  session_start();
  include('layout/header.php'); 
  if($_SESSION['username'] == ''){
    header('location:index.php');
  }

  function fill_product($pdo){

      $output = '';

      $select = $pdo->prepare("select * from tbl_customer order by customer_name");
      $select->execute();

      $result = $select->fetchall();

      foreach($result as $row){
        $output.= '<option value = "'.$row["id"].'"> '.$row["contact_number"].' </option>';
      }

      return $output;
  }

  if(isset($_POST['point_add'])){
    $cid = $_POST['cust_id'];
    $contact = $_POST['cust_contact'];
    $bill = $_POST['bill_amount'];
    $billid = $_POST['bill_id'];
    $point = $_POST['addpoint'];

     if(empty($point)){
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
          $insert = $pdo->prepare("insert into add_point(point_add,customer_id,contact,bill,bill_id)values(:point,:cust,:contact,:bill,:billid)");
          $insert->bindparam(':point',$point);
          $insert->bindparam(':cust',$cid);
          $insert->bindparam(':contact',$contact);
          $insert->bindparam(':bill',$bill);
          $insert->bindparam(':billid',$billid);
         
      if($insert->execute()){
         include('pointadd_sms.php');
         echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Awesome",
                  text: "Point Has Been Added",
                  icon: "success",
                  button: "Close",
                });
            });


        </script>';
      }
    }
  

    $select = $pdo->prepare("select * from tbl_point where customer_id = $cid");
    $select->execute();
    $row = $select->fetch(PDO::FETCH_OBJ);
    @$totalpoint = $row->total_point+$point;
    @$currentpoint = $row->current_point+$point;


    $update = $pdo->prepare("update tbl_point set current_point=:current, total_point = :total where customer_id =".$cid);
    $update->bindparam(':current',$currentpoint);
    $update->bindparam(':total',$totalpoint);

    $update->execute();
   
  }

  if(isset($_POST['rdm_point'])){
    $cid = $_POST['custid'];
    $rpoint = $_POST['rpoint'];
    $contact = $_POST['contact'];
     $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string_shuffled = str_shuffle($string);
    $password = substr($string_shuffled, 1, 7);
     if(empty($rpoint)){
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
           $insert = $pdo->prepare("insert into redeem_point(r_point,customer_id,contact,otp)values(:point,:cid,:contact,:otp)");
           $insert->bindparam(':cid',$cid);
           $insert->bindparam(':point',$rpoint);
            $insert->bindparam(':contact',$contact);
          $insert->bindparam(':otp',$password);
         
          
          


         if($insert->execute()){
            $insert_id =  $pdo->lastInsertId();
          header('location:verifyotp.php?id='.$cid.'&lid='.$insert_id);
           include('pointredeem_sms.php');
   
      }
    }
   

   // $select = $pdo->prepare("select * from tbl_point where customer_id = $cid");
    //$select->execute();
    //$row = $select->fetch(PDO::FETCH_OBJ);

    //if($rpoint>$row->current_point){
      // echo '<script type = "text/javascript">
        //  jQuery(function validation(){
          //    swal({
            //      title: "Oops!!",
              //    text: "You Dont Have Too Much Point To Redeem It",
                //  icon: "warning",
                 // button: "Close",
                //});
            //});


        //</script>';
    //} 
   
  }



  
?>

<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Search Customer <small>it all starts here</small></h1>
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
             
            </div>
        
            <div class = "box-body">
                
                 <div class = "col-md-4 col-md-offset-4">
                  <div style = "">
                  <table id = "producttable"  class = "table table-striped">
                    <thead>
                       <tr>
                 
                         
                          <th> <h4> Search Customer </h4> </th>
                          
                 
                 
                       </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> <select   class="form-control searchcustomer" name = "productid[]">        <option value = ""> Select Option  </option> <?php echo fill_product($pdo) ?> 
                              </select>
                         </td>
                      </tr>
                    </tbody>
                  </table>
                  </div>
                 </div>
              
               
             
            </div>

             <div class = "box-body">

                  <div class = "col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Customer Name</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-user"></i>
                          </div>
                      <input type="text" id = "cname" class="form-control" name = "cname" readonly>
                    </div>
                    </div>
                  </div>

                    <div class = "col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1"> Aadhar Number </label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-id-card"></i>
                          </div>
                      <input type="text" class="form-control" id = "aadharno" name = "aadharno" readonly>
                    </div>
                    </div>
                  </div>

                  <div class = "col-md-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1"> Contact Number </label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                          </div>
                      <input type="text" class="form-control" id = "contactno" name = "contactno" readonly>
                    </div>
                    </div>
                  </div>

                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">I.G.S.T </label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-percent"></i>
                          </div>
                      <input type="text" class="form-control" id = "igsttax" name = "txtigst" >
                    </div>
                    </div>-->

                    <div class = "col-md-6">
                     <div class="form-group">
                      <label for="exampleInputEmail1"> Card Number </label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-id-card"></i>
                          </div>
                      <input type="text" class="form-control" id = "cardno" name = "cardno" readonly>
                    </div>
                    </div>
                  </div>

                 


               <!-- <div class = "box-body">

                  <div class = "col-md-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Total Point</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-align-right"></i>
                          </div>
                      <input type="text" id = "tpoint" class="form-control" name = "tpoint" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1"> Redeem Point </label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-align-right"></i>
                          </div>
                      <input type="text" class="form-control" id = "rpoint" name = "rpoint" readonly>
                    </div>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputEmail1"> Current Point </label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-align-right"></i>
                          </div>
                      <input type="text" class="form-control" id = "cpoint" name = "cpoint" readonly>
                    </div>
                    </div>

                  </div>



                 




                </div> -->  <!-- tax, dicount, etc -->
            <br>
            <div class = "box-body">
               <div class="col-md-4">
         
          <!-- small box -->
                 <div class="small-box bg-green">
                    <div class="inner">
                       <h3 id = "tpoint"><sup style="font-size: 20px"></sup></h3>

                      <p> Total Point </p>
                   </div>
                   
                    
               </div>
            </div>

            <div class="col-md-4">
         
          <!-- small box -->
                 <div class="small-box bg-red">
                    <div class="inner">
                       <h3 id = "rpoint"><sup style="font-size: 20px"></sup></h3>

                      <p> Redeem Point </p>
                   </div>
                    
                    
               </div>
            </div>

             <div class="col-md-4">
         
          <!-- small box -->
                 <div class="small-box bg-orange">
                    <div class="inner">
                       <h3 id = "cpoint"><sup style="font-size: 20px"></sup></h3>

                      <p> Current Point </p>
                   </div>
                   
                    
               </div>
            </div>

            </div>

            <div class = "box-body">
              <div class = "col-sm-6">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                    Click Here To Add Point
                  </button>
              </div>
              <div class = "col-sm-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-redeem">
                    Click Here To Redeem Point
                </button>
              </div>
              
            </div>

            <div class = "box-footer">
              
            </div>
            
          </div>
     
    </section>
    <!-- /.content -->

     <div class="modal fade" id="modal-default">
        <form method = "post" action = "">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center"><u>Add Point</u></h3>
              </div>
               
              <div class="modal-body">
                 <input type = "hidden" class = "form-control" name = "cust_id" id = "cust_id">
                  <input type = "hidden" class = "form-control" name = "cust_contact" id = "contactno_add_point">
                  <input type = "text" class = "form-control" id = "" name = "bill_id" placeholder = "Enter Your Bill Id">
                 <input type = "number" class = "form-control" id = "item1" name = "bill_amount" placeholder = "Enter Your Bill Amount">
                <input type = "number" class = "form-control" id = "item2" name = "addpoint" readonly>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name = "point_add">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
          <!-- /.modal-dialog -->
        </div>


       <div class="modal fade" id="modal-redeem">
         <form method = "post" action = "">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title text-center"><u>Redeem Point</u></h3>
              </div>
              <div class="modal-body">
                <input type = "hidden" class = "form-control" name = "custid" id = "custid">
                <input type = "hidden" class = "form-control" name = "contact" id = "contactno_redeem_point">

                <input type = "number" class = "form-control" name = "rpoint"  placeholder = "Enter Your Redeem Point">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name = "rdm_point" class="btn btn-primary">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
        </form>
          <!-- /.modal-dialog -->
        </div>
  </div>

  <script>
      $('.searchcustomer').select2()

        $('.searchcustomer').on('change', function(e){
              var customerid = this.value;
              var tr=$(this).parent().parent();

              $.ajax({
                  url:"getcustomer.php",
                  method:"get",
                  data:{id:customerid},
                  success:function(data){
                    console.log(data);
                        $("#cust_id").val(data["id"]);
                        $("#custid").val(data["id"]);
                        $("#cname").val(data["customer_name"]);
                        $("#aadharno").val(data["aadhar_number"]);
                        $("#contactno").val(data["contact_number"]);
                        $("#contactno_add_point").val(data["contact_number"]);
                         $("#contactno_redeem_point").val(data["contact_number"]);
                        $("#cardno").val(data["card_number"]);
                        $("#tpoint").html(data["total_point"]);
                        $("#rpoint").html(data["redeem_point"]);
                        $("#cpoint").html(data["current_point"]);
                      //tr.find(".cname").val(data["customer_name"]);
                      //tr.find(".price").val(data["saleprice"]);
                      //tr.find(".qty").val(1);
                      //tr.find(".total").val(tr.find(".qty").val() *  tr.find(".price").val());
                      //calculate(0,0,0,0);
                  }
              })

              $('#item1').keyup(function () {
              var foo = parseFloat($(this).val());
              foo = Math.round(foo * 0.05);
              $('#item2').val(foo);
});


          })

  </script>

  
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>