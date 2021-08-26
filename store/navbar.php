<link rel="stylesheet" type="text/css" href="style.css">
<ul>
    <li><a href="show_product.php">Home</a></li>
    <li><a href="#" id="myBtn">Cart</a></li>
    <li><a href="show_order.php">Orders</a></li>
    <li class="dropdown">
        <a class="dropbtn">Category</a>
        <div class="dropdown-content">
    	      <?php
            error_reporting(E_WARNING);
      	    $con = mysqli_connect('localhost','root','','store');
      	    $category_query = "select * from category";
      	    $category_result = mysqli_query($con,$category_query);
      	    if($category_result>0)
            {
      		      while($category = mysqli_fetch_assoc($category_result))
                {
      			    ?>
      			      <a href="show_product.php?category_id=<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></a>
      			    <?php
      		      }
      	    }
      	    ?>
        </div>
    </li>
    <li><a href="logout.php">Logout</a></li>
    <?php
    if($_SESSION["user_type"]=="admin"){
        echo "<li style='color:white;float: right;margin-right: 20px;'><a href='admin_page.php'>Admin Page</a></li>";    
    }else if($_SESSION["user_type"]=="user")
    {
        echo "<li style='color:white;float: right;margin-right: 20px;'><h2>Welcome, ".$_SESSION["name"]."</h2></li>";
    }
    ?>
</ul>