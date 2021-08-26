<?php
session_start();
if(!isset($_SESSION['user_id']))
{
    header('location: login.php');
}
else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user")
{
	header('location: show_product.php');
}
else
{
	$id = $_GET['product_id'];
	$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
	try
	{
		$query = "delete from product where product_id=$id";
		if(mysqli_query($con,$query))
		{
			header("refresh:0,url=http://localhost/store/admin_page.php?page=products");
		}else
		{
			echo "Error ".mysqli_error($con);
		}
	}
	catch(Exception $e)
	{
		echo "Error Message->".$e->getMessage();
	}
}
?>