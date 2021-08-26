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
$firstname = $_POST['firstname'] ?? "";
$lastname = $_POST['lastname'] ?? "";
$email = $_POST['email'] ?? "";
$address = $_POST['address'] ?? "";
$contact = $_POST['contact'] ?? "";
$pass = $_POST['password'] ?? "";
$password="";
$message="";
if($firstname=="" || $lastname=="" || $pass=="" || $address=="" || $contact=="" || $pass=="")
{
	$message = "Please Fill All the Input Fields";
}
else{
	$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
	$password = password_hash($pass, PASSWORD_DEFAULT);
	try{
		$email_query = "SELECT COUNT(*) AS numrows FROM user WHERE email='$email'";
		$query = "INSERT INTO user (firstname, lastname, email, address, contact, password) VALUES ('$firstname','$lastname','$email','$address','$contact','$password')";
		$result = mysqli_query($con,$email_query);
		if($result>0){
			while ($row = mysqli_fetch_assoc($result))
			{
				if($row['numrows'] > 0)
				{
					$message="Email Already Exists";
				}
				else {
					if(mysqli_query($con,$query)){
						header("location:login.php");
					}else {
				       $message = "<br>0 Records in Row ".mysqli_error($con);
					}
				}
			}
		}	
	}
	catch(Exception $e){
		$message = $e->getMessage();
	}
}
?>
<div class="container">
	<div class="message" style="background-color: red;border-radius: 6px;margin-bottom: 10px;padding: 10px;">
		<?php if($message!="") { echo $message; } ?>		
	</div>
	<form action="add_user.php" method="post">
		<label>Firstname :</label><input type="text" name="firstname" required/><br>
		<label>Lastname :</label><input type="text" name="lastname" required/><br>
		<label>Email :</label><input type="email" name="email" required/><br>
		<label>Password :</label><input type="password" name="password" required/><br>
		<label>Address :</label><textarea rows=5 cols=15 name="address" required></textarea><br>
		<label>Contact No :</label><input type="text" name="contact" required /><br>
		<input type="submit" value="Submit">
        If Already Have A Account <a href="login.php" style="text-decoration: none;">Login Here</a>
	</form>
</div>