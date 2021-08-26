<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">*{margin: 0px;}</style>
</head>
<?php
session_start();
if(!isset($_SESSION['user_id']))
{
  header('location: login.php');
}
else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user"){
  header('location: show_product.php');
}
?>
<body>
	<ul>
  <li><a href="show_product.php">Home</a></li>
  <li class="dropdown">
    <a class="dropbtn">Select Table</a>
    <div class="dropdown-content">
      <a href="admin_page.php?page=products">Product</a>
      <a href="admin_page.php?page=users">User</a>
      <a href="admin_page.php?page=orders">Order</a>
      <a href="admin_page.php?page=categories">Category</a>
    </div>
  </li>
  <li class="dropdown">
    <a class="dropbtn">Add Entry</a>
    <div class="dropdown-content">
      <a href="admin/add_product.php">Product</a>
      <a href="add_user.php">User</a>
      <a href="admin/add_category.php">Category</a>
    </div>
  </li>
  <li><a href="logout.php">Logout</a></li>
  <li style="color:white;float: right;margin-right: 20px;"><h2>Welcome Admin</h2></li>
</ul>
<?php
$page = $_REQUEST['page'] ?? "";
if($page){ include 'admin/all_'.$page.'.php'; }
else{include 'admin/all_products.php';}
?>
</body>