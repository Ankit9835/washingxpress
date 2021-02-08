<?php

try{
	$pdo = new PDO('mysql:host=localhost;dbname=washing_center','root','');
	//echo "Connected Successfully";
} catch(PDOException $f){
	echo $f->getmessage();
}


?>