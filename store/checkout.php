<?php
session_start();
if(!isset($_SESSION['user_id']))
{
	header('location: login.php');
}
$query = "INSERT INTO orders (product_id, user_id, quantity,price)
			SELECT product_id, user_id, quantity,price
			FROM cart";
try
{
	$con = mysqli_connect("localhost","root","","store");
	if(mysqli_query($con,$query))
	{
		$clear_cart = "truncate table cart";
		if(mysqli_query($con,$clear_cart))
		{
			header("location:show_order.php");
		}
		else
		{
			echo "Checkout Failed".mysqli_error($con);
		}
	}
	else
	{
		echo "Checkout Failed".mysqli_error($con);
	}
}
catch(Exception $e)
{
	echo "Error Message->".$e->getMessage();
}
?>