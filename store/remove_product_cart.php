<?php
session_start();
if(!isset($_SESSION['user_id']))
{
  header('location: login.php');
}
else{
	$cart_id=$_REQUEST['cart_id'] ?? "";
	$product_id=$_REQUEST['product_id'] ?? "";
	$con = mysqli_connect("localhost","root","","store");
	try{
	$query = "delete from cart where cart_id=$cart_id";
	$update_stock="update product set stock=stock+1 where product_id=$product_id";
	if(mysqli_query($con,$query) && mysqli_query($con,$update_stock)){
		header('location:show_product.php');
	}else{
	    $message = "Invalid Username or Password!";
	}
	}
	catch(Exception $e){
		echo "Error Message->".$e->getMessage();
	}
}
?>