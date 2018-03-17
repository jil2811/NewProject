<?php
session_start();
if(isset($_GET['p_id']) and isset($_GET['user_price'])){
	include_once('admin/connectionDb.php');
	$p_id=$_GET['p_id'];
	$user_price=$_GET['user_price'];
	$u_id=$_SESSION['uid'];
	$date=date('Y-m-d h:i:s');
	$user_price_sql="INSERT INTO user_price (u_id,p_id,price,date) VALUES ('$u_id','$p_id','$user_price','$date')";
	if(mysqli_query($con,$user_price_sql)){
		echo 1;
	}
	else{
		echo 0;
	}
}