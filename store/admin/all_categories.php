<h1 align="center">All Categories</h1>
<table align="center" class="styled-table">
    <thead>
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Edit</th>
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
            else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user"){
              header('location: show_product.php');
            }
            $con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
            try
            {
                $query = "select * from category";
                $result = mysqli_query($con,$query);
                if($result>0)
                {
                    while($or = mysqli_fetch_assoc($result))
                    {
                      ?>
                      <td><?php echo $or['category_id']; ?></td>
                      <td><?php echo $or['category_name']; ?></td>
                      <td><a href="admin/update_category.php?category_id=<?php echo $or['category_id']; ?>">Edit</a></td>
                      <td><a href="admin/delete_category.php?category_id=<?php echo $or['category_id']; ?>" onclick="return confirm('Do You Want To Delete The Category')">Delete</a></td>
                      </tr> 
                      <?php
                    }
                }
                else
                {
                  echo "0 Recorrds".mysqli_error($con);
                }
            }
            catch(Exception $e){
                echo "Error ->".$e->getMessage();
            }
            ?>
    </tbody>
</table>