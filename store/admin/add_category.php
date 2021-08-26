<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title>Add Category</title>
	<style type="text/css">
        body{
        	background: linear-gradient(#4ca1af,#c4e0e5);           
		}
	</style>
</head>
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
	$category_name = $_POST['category_name'] ?? "";
	$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
	if($category_name=="")
	{
		$message = "Enter value in input field";
	}
	else
	{
		try
		{
			$query = "INSERT INTO category (category_name) values ('$category_name')";
			if(mysqli_query($con,$query))
			{
				header("location:admin_page.php?page=categories");
			}
			else 
			{
   				$message = "<br>Error".mysqli_error($con);
			}
			}
		catch(Exception $e)
		{
			$message = "Error Message ->".$e->getMessage();
		}
	}
	?>
<body>
<div class="container">
	<div class="message" style="background-color: red;border-radius: 6px;margin-bottom: 10px;padding: 10px;"><?php if($message!="") {echo $message;} ?></div>
	<form action="add_category.php" method="post">
		<label>Category Name :</label><input type="text" name="category_name"/><br>
		<input type="submit" value="Submit">
	</form>
</div>
</body>
</html>