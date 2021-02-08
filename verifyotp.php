
<script src="plugins/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
<script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- iCheck -->
<script src="file/iCheck/icheck.min.js"></script>
<script type = "text/javascript" src = "js/sweetalert/sweetalert.js"> </script>




<?php include_once('connectdb.php'); 
session_start(); 

$id = $_GET['id'];
$lid = $_GET['lid'];
	//echo "select * from redeem_point where customer_id = $id AND status = 0 AND rid = $lid";
	$otpselect = $pdo->prepare("select * from redeem_point where customer_id = '$id' AND status = '0' AND rid = '$lid'");

	$otpselect->execute();
	$col = $otpselect->fetch(PDO::FETCH_OBJ);
	


	 $select = $pdo->prepare("select * from tbl_point where customer_id = $id");
	 $select->execute();
  	$row = $select->fetch(PDO::FETCH_OBJ);

if(isset($_POST['submit'])){
	 $otpreq = $_POST['txtotp'];
	
	

	if($otpreq == $col->otp){
		 @$currentpoint = $row->current_point-$col->r_point;
	    @$redeempoint = $row->redeem_point+$col->r_point;
	    $update = $pdo->prepare("update tbl_point set current_point=:current, redeem_point=:redeem where customer_id =".$id);

	    $update->bindparam(':current',$currentpoint);
	    $update->bindparam(':redeem',$redeempoint);
	    $update->execute();

    	$updater = $pdo->prepare("update redeem_point set status = '1' where rid = '$lid'");

    	$updater->execute();
    	 echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "OTP Verified",
                  text: "Redirecting To Search Customer Page!",
                  icon: "success",
                  button: "Loading..",
                });
            });


        </script>';
        header('refresh:1;search_customer.php');
    	//header('location:search_customer.php');
	} else {
		 echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Wrong OTP!",
                  text: "Please Check Your OTP Again!",
                  icon: "warning",
                  button: "Close",
                });
            });


        </script>';
	}

}

?>


<?php include('layout/header.php'); ?>
	<body class="hold-transition homebody">
		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>Enter</b>OTP</a>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg">Enter Your OTP Here</p>

				<form role = "form" action = "" method="POST">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="OTP" name="txtotp">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					
					<div class="row">
						
						<!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Submit</button>
						</div>
						<!-- /.col -->
					</div>
				</form> <br>

				
				<!-- /.social-auth-links -->

				
				

			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 3 -->

		

		
		<script>
			 $(function () {
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' /* optional */
				});
			 });
		</script>

	</body>
</html>
