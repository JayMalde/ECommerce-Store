<link rel="stylesheet" type="text/css" href="style.css">
<body>
    <ul>
        <li><a href="show_product.php">Home</a></li>
        <li><a href="show_product.php">Products</a></li>
        <li><a href="logout.php" id="myBtn">Logout</a></li>
    </ul>
	  <h1 align="center">Your Orders</h1>
	  <table align="center" class="styled-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Billing Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr class="active-row">
                <?php
                error_reporting(E_WARNING); 
          		session_start();            
                $con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
                try{
                    $query = "select o.*,p.product_name from orders o inner join product p on o.product_id=p.product_id order by order_id desc";
                    $result = mysqli_query($con,$query);
                    if($result>0){
                    	while($or = mysqli_fetch_assoc($result)){
                    	?>
                    <td><?php echo $or['order_id']; ?></td>
                    <td><?php echo $or['product_name']; ?></td>
                    <td><?php echo $or['order_date']; ?></td>
                    <td><?php echo $or['order_time']; ?></td>
                    <td><?php echo $or['status']; ?></td>
                    <td><?php echo $or['quantity']; ?></td>
                    <td><?php echo $or['price']; ?></td>
                    </tr>	
                    <?php
                    }
                	}
                	else{
                		echo "0 Recorrds".mysqli_error($con);
                	}
                }
                catch(Exception $e){
                    echo "Error Message->".$e->getMessage();
                }
        	   ?>
        </tbody>
    </table>
</body>