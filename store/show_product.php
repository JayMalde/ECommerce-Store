<html>
<head>
    <title>Main Page</title>  
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
	session_start();
	if(!isset($_SESSION['user_id'])){
		header('location: login.php');
	}
?>
<body>
    <?php include "navbar.php" ?>
    <h1 style="font-size: 40px;text-align:center">Products</h1>
    <?php
    error_reporting(E_WARNING); 
    $category_id=$_REQUEST['category_id'] ?? "";
    try{
        if($category_id)
        {
            $query = " SELECT product_id,product_name,stock,photo,price,description FROM product where category_id=$category_id order by product_id ASC ";
        }
        else
        {
            $query = " SELECT product_id,product_name,stock,photo,price,description FROM product order by product_id ASC ";	
        }
        $result = mysqli_query($con, $query);
        if($result > 0)
        {
    		    while($product = mysqli_fetch_assoc($result))
            {
        ?>
        <div class="card">
            <img src="<?php echo "\\store\\images\\".$product['photo'];  ?>" alt="<?php echo $product['product_name'];  ?>" style="width:100%">
            <h1><?php echo $product['product_name'];  ?></h1>
            <p class="price">&#x20B9;<?php echo $product['price'];  ?>/-</p>
            <p>Only <b><?php echo $product['stock']; ?></b> Left</p>
            <p><?php echo $product['description'];  ?></p>
            <?php $total_price=$product['price']*1; ?>
            <p><a class="cart-button" href="add_to_cart.php?product_id=<?php echo $product['product_id'];?>&price=<?php echo $total_price; ?>">Add to Cart</a></p>
        </div>
      <?php		
	         }
        }
    }
    catch(Exception $e){
        echo "Error ->".$e->getMessage();
    }
      ?>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <table class="styled-table">
            <thead>
                <tr>
			              <th>Product Name</th>
                	  <th>Quantity</th>
                		<th>Unit Price</th>
                		<th>Price</th>
                		<th>Action</th>
                </tr>
            </thead>
            <?php
            $user_id=$_SESSION['user_id'];
            try
            {
                $query1 = "SELECT c.cart_id,p.product_id,c.user_id,p.product_name,c.quantity,p.price FROM cart c inner join product p on p.product_id=c.product_id where user_id=$user_id";
	              $result1 = mysqli_query($con, $query1);
              	$num1 = mysqli_num_rows($result1);
	              if($num1 > 0)
                {
		                while($product1 = mysqli_fetch_assoc($result1))
                    {
		                ?>
                <tbody>
     	              <tr class="active-row">
                    		<td><?php echo $product1['product_name']; ?></td>
                    		<td><?php echo $product1['quantity']; ?></td>
                    		<td><?php echo $product1['price']; ?></td>
                    		<td><?php echo $product1['price']*$product1['quantity']; ?></td>
                    		<td><a style="background-color:#d9534f;" class="cart-button" href="remove_product_cart.php?cart_id=<?php echo $product1['cart_id'];?>&product_id=<?php echo $product1['product_id'];?>">Remove</a></td>
    	              <?php 
                    }
                }
            }
            catch(Exception $e)
            {
                echo "Error ->".$e->getMessage();
            }
            ?>
                    </tr>
                </tbody>
            </table>
        <a class="button" style="padding: 10px;" href="checkout.php">Checkout</a>
        </div>
    </div>
</body>
<script type="text/javascript">
	var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];
    btn.onclick = function() {
        modal.style.display = "block";
    }
    span.onclick = function() {
        modal.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
</html>