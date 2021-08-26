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
	$id = $_GET['id'];
	$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
	try
	{
		$query = "delete from user where id=$id";
		if(mysqli_query($con,$query)){
			header("refresh:0,url=http://localhost/store/admin_page.php?page=users");
		}else{
			echo "Error ".mysqli_error($con);
		}
	}
	catch(Exception $e)
	{
		echo "Error Message->".$e->getMessage();
	}
}
?>