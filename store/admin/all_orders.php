<h1 align="center">All Orders</h1>
<table align="center" class="styled-table" style="margin-bottom: 50px;">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Product ID</th>
            <th>User ID</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Order Time</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr class="active-row">
            <?php
            error_reporting(E_WARNING);
            session_start();
            if(!isset($_SESSION['user_id']))
            {
                header('location: login.php');
            }
            else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user")
            {
                header('location: show_product.php');
            }
            $con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");  
            try
            {
                $query = "select * from orders order by order_date,order_time desc";
                $result = mysqli_query($con,$query);
                if($result>0)
                {
                    while($or = mysqli_fetch_assoc($result))
                    {
                    ?>
                        <td><?php echo $or['order_id']; ?></td>
                        <td><?php echo $or['product_id']; ?></td>
                        <td><?php echo $or['user_id']; ?></td>
                        <td><?php echo $or['quantity']; ?></td>
                        <td><?php echo $or['price']; ?></td>
                        <td><?php echo $or['status']; ?></td>
                        <td><?php echo $or['order_date']; ?></td>
                        <td><?php echo $or['order_time']; ?></td>
                        <td><a href="admin/update_order.php?id=<?php echo $or['order_id']; ?>">Edit</a></td>
                        <td><a onclick="return confirm('Do you want to delete this record from orders table.');" href="admin/delete_order.php?id=<?php echo $or['order_id']; ?>">Delete</a></td>
                    </tr> 
                    <?php
                    }
                }
                else
                {
                    echo "0 Recorrds".mysqli_error($con);
                }
            }
            catch(Exception $e)
            {
              echo "Error ->".$e->getMessage();
            }
            ?>
    </tbody>
</table>