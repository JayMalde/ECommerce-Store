<?php
session_start();
if(!isset($_SESSION['user_id']))
{
	header('location: login.php');
}
else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user"){
	header('location: show_product.php');
}
$user_id=$_SESSION['user_id'] ?? "";
$product_id=$_GET['product_id'];
$price=$_GET['price'];
$quantity=1;
$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
try
{
	$query="insert into cart (user_id,product_id,quantity,price) values ($user_id,$product_id,$quantity,$price)";
	$update_stock="update product set stock=stock-1 where product_id=$product_id";
	echo "Query".$query;
	if(mysqli_query($con,$query) && mysqli_query($con,$update_stock)){
		header("location:show_product.php");
	}else{
		echo "<br>Not Able to save to cart".mysqli_error($con);
	}
}
catch(Exception $e)
{
	echo "Error Message->".$e->getMessage();
}
?>