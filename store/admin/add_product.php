<html>
<head>
	<title>Add Product</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style type="text/css">
        body{
        	background: linear-gradient(#4ca1af,#c4e0e5);           
		}
	</style>
</head>
<body>
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
$product_name = $_POST['product_name'] ?? "";
$category_id = $_POST['category_id'] ?? "";
$stock = $_POST['stock'] ?? "";
$dest_path=__DIR__;
$target=$_FILES['photo']['name'] ?? "";
$description = $_POST['description'] ?? "";
$price = $_POST['price'] ?? "";
$dest_path.="\\images\\";
$img_name=$product_name."_".$target;
if(move_uploaded_file($_FILES['photo']['tmp_name'] ?? "",$dest_path.$img_name))
{
    $message = "File Uploaded";
}
else
{
    $message = "File Upload Failed";
}
$con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
if($product_name && $category_id && $stock && $target && $description && $price)
{
	try
	{
		$query = "INSERT INTO product (product_name, category_id, stock, photo, description, price) VALUES ('$product_name','$category_id','$stock','$img_name','$description','$price')";
		if(mysqli_query($con,$query))
		{
			header("location:show_product.php");
		}
		else 
		{
		    $message .= "<br>Error".mysqli_error($con);
		}
	}
	catch(Exception $e){
		$message .= "<br>Error Message ->".$e->getMessage();
	}
}
else
{
	$message .= "<br>Insert Data in Input Fields";
}
?>
<div class="container">
	<div class="message" style="background-color: red;border-radius: 6px;margin-bottom: 10px;padding: 10px;">
		<?php if($message!="") { echo $message; } ?>
	</div>
	<form action="add_product.php" method="post" enctype="multipart/form-data">
		<label>Product Name :</label><input type="text" name="product_name"/><br>
		<label>Category :</label><select name="category_id">
		<?php
		$query1="select * from category";
		$result = mysqli_query($con,$query1);
		if($result>0){
			try
			{
				while ($row=mysqli_fetch_assoc($result)) 
				{
					?>
					<option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
					<?php		
				}
			}
			catch(Exception $e){
				$message .= "<br>Error Loading Category ->".$e->getMessage();
			}
		}
		?>
		</select><br>
		<label>Stock :</label><input type="number" name="stock"/><br>
		<label>Photo :</label><input type="file" name="photo"/><br>
		<label>Description:</label><textarea name="description"></textarea><br>
		<label>Price :</label><input type="number" name="price"/><br>
		<input type="submit" value="Submit">
	</form>
</div>
</body>
</html>