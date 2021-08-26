<h1 align="center">All Users</h1>
<table align="center" class="styled-table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Type</th>
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
            else if(isset($_SESSION['user_id']) && $_SESSION['user_type']=="user")
            {
              header('location: show_product.php');
            }
            $con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
            try
            {
                $query = "select * from user";
                $result = mysqli_query($con,$query);
                if($result>0)
                {
                    while($or = mysqli_fetch_assoc($result))
                    {
                    ?>
                        <td><?php echo $or['id']; ?></td>
                        <td><?php echo $or['firstname']; ?></td>
                        <td><?php echo $or['lastname']; ?></td>
                        <td><?php echo $or['email']; ?></td>
                        <td><?php echo $or['address']; ?></td>
                        <td><?php echo $or['contact']; ?></td>
                        <td><?php echo $or['type']; ?></td>
                        <td><a href="admin/update_user.php?id=<?php echo $or['id']; ?>">Edit</a></td>
                        <td><a href="admin/delete_user.php?id=<?php echo $or['id']; ?>" onclick="return confirm('Do You Want To Delete The User')">Delete</a></td>
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