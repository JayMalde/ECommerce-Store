<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
        body{
        	background: linear-gradient(#4ca1af,#c4e0e5);           
    	}
    </style>
</head>
<body>
<?php
error_reporting(E_WARNING);
session_start();
$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
$message = "";
$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
$query = "select *,count(*) as num from user where email='$email'";
try{
	$result = mysqli_query($con,$query);
	if($result > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			if($row['num']>0)
			{
				if(password_verify($password,$row['password']))
				{
					$_SESSION['user_id'] = $row['id'];
			        $_SESSION['user_type'] = $row['type'];
			        $_SESSION['name'] = $row['firstname'];
					header('location:show_product.php');
				}
				else 
				{
		       		$message = "Password Incorrect ?";
				}
			}
			else
			{
       			$message = "No user exists with this email !";
			}
		}
	}
}
catch(Exception $e)
{
	echo "Error Message->".$e->getMessage();
}
?>
<div class="container">
	<div class="message" style="background-color: red;border-radius: 6px;margin-bottom: 10px;padding: 10px;"><?php if($message!="") { echo $message; } ?></div>
	<form action="login.php" method="post">
		<label>Email :</label><input type="email" name="email"/><br>
		<label>Password :</label><input type="password" name="password"/><br>
		<input type="submit" value="Login">
		If New <a href="add_user.php" style="text-decoration: none;">Register Here</a>
	</form>
</div>
</body>
</html>