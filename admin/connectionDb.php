<?php
//Database Connection
$con=mysqli_connect('localhost','root','','pricelist');
if(!$con){
	die("Connection failed ".mysqli_connect_error());
}
session_start();