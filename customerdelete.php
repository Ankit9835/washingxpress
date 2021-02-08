<?php 
  include_once('connectdb.php');

  $id = $_POST['pidd'];



  $sql = "delete tbl_customer, tbl_point from tbl_customer INNER JOIN tbl_point ON tbl_customer.id=tbl_point.point_id where tbl_customer.id=$id";
  

  $delete=$pdo->prepare($sql);

  if($delete->execute()){

  } else {
  	echo "Error";
  }

?>