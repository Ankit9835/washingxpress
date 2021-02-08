<?php 
  include('connectdb.php');
  session_start();

  $id = $_GET['id'];

  $select = $pdo->prepare("select t1.customer_name, t1.id,t1.aadhar_number,t1.contact_number,t1.card_number,t2.total_point,t2.redeem_point,t2.current_point from tbl_customer t1 INNER JOIN tbl_point t2 ON t1.id = t2.customer_id where id = :cid");

  $select->bindparam(':cid',$id);

  $select->execute();

  $row = $select->fetch(PDO::FETCH_ASSOC);
 //print_r($row);
 // exit;

  $response = $row;

  header('Content-Type:application/json');

  echo json_encode($response);



?>