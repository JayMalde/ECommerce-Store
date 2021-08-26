<link rel="stylesheet" type="text/css" href="../style.css">
<style type="text/css">
        body{
            background: linear-gradient(#4ca1af,#c4e0e5);           
        }
    </style>
<body>
<?php
error_reporting(E_WARNING);
session_start();
if(!isset($_SESSION['user_id']))
{
  header('location: login.php');
}
else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user"){
  header('location: show_product.php');
}
else{
    $order_id = $_REQUEST['id'];
    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
    if($product_id){
        $query = "update orders set product_id='$product_id', user_id='$user_id',quantity='$quantity', price='$price', status='$status' where order_id=$order_id";
        echo "".$query;
        if(mysqli_query($con,$query))
        {
            header("refresh:0,url=http://localhost/store/admin_page.php?page=orders");            
        }else {
           echo "<br>0 Records in Row".mysqli_error($con);
        }
    }
    else{
        $query = "select * from orders where order_id = $order_id";
        $result = mysqli_query($con,$query);
        if($result>0){
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <div class="container">
                <form action="update_order.php" method="post">
                    <label>Order ID :</label><input type="number" readonly value="<?php echo $row['order_id']; ?>" name="id"/><br>
                    <label>Product ID :</label><input type="number" readonly value="<?php echo $row['product_id']; ?>" name="product_id"/><br>
                    <label>User ID :</label><input type="number" readonly value="<?php echo $row['user_id']; ?>" name="user_id"/><br>
                    <label>Quantity :</label><input type="number" value="<?php echo $row['quantity']; ?>" name="quantity"/><br>
                    <label>Price :</label><input type="number" name="price" value="<?php echo $row['price']; ?>"/><br>
                    <label>Status :</label><input type="text" name="status" value="<?php echo $row['status']; ?>"/><br>
                    <input type="submit" value="Submit">
                </form>
            </div>
        <?php
            }
        }else {
               echo "<br>0 Records in Row".mysqli_error($con);
        }   
    }
}
?>