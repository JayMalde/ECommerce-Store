<h1 align="center">All Products</h1>
<table align="center" class="styled-table">
    <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Category ID</th>
            <th>Stock</th>
            <th>photo</th>
            <th>Description</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr class="active-row">
            <?php
            error_reporting(E_WARNING);
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
                $query = "select * from product";
                $result = mysqli_query($con,$query);
                if($result>0)
                {
                	while($or = mysqli_fetch_assoc($result))
                    {
                	?>
                        <td><?php echo $or['product_id']; ?></td>
                        <td><?php echo $or['product_name']; ?></td>
                        <td><?php echo $or['category_id']; ?></td>
                        <td><?php echo $or['stock']; ?></td>
                        <td><?php echo $or['photo']; ?></td>
                        <td><?php echo $or['description']; ?></td>
                        <td><?php echo $or['price']; ?></td>
                        <td><a href="admin/update_product.php?product_id=<?php echo $or['product_id']; ?>">Edit</a></td>
                        <td><a href="admin/delete_product.php?product_id=<?php echo $or['product_id']; ?>" onclick="return confirm('Do you want to delete this Product')">Delete</a></td>
        </tr>	
                    <?php
                    }
        	    }
        	else{
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