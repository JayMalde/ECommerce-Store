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
	$category_id = $_GET['category_id'];
	$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
	try
	{
		$query = "delete from category where category_id=$category_id";
		if(mysqli_query($con,$query))
		{
			header("refresh:0,url=http://localhost/store/admin_page.php?page=categories");
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