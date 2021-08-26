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
    $product_id = $_REQUEST['product_id'];
    $product_name = $_POST['product_name'];
    $category_id = $_REQUEST['category_id'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
    if($product_name){
        $query1 = "update product set product_name='$product_name',category_id='$category_id',stock=$stock,description='$description',price=$price where product_id=$product_id";
        echo "Query".$query1;
        if(mysqli_query($con,$query1))
        {
            header("refresh:0,url=http://localhost/store/admin_page.php?page=products");
        }else {
           echo "<br>0 Records in Row".mysqli_error($con);
        }
    }
    else{
        $query2 = "select * from product where product_id = $product_id";
        $result2 = mysqli_query($con,$query2);
        if($result2>0){
            while($row = mysqli_fetch_assoc($result2)){
            ?>
            <div class="container">
                <form action="update_product.php" method="post">
                    <label>Product ID :</label><input type="text" readonly value="<?php echo $row['product_id']; ?>" name="product_id"/><br>
                    <label>Product Name :</label><input type="text" value="<?php echo $row['product_name']; ?>" name="product_name"/><br>
                                    
                    <label>Category :</label><select name="category_id">
                    <?php
                    $query="select * from category";
                    $result = mysqli_query($con,$query);

                    if($result>0)
                    {
                        while ($cat=mysqli_fetch_assoc($result)) 
                        {
                            ?>
                            <option value="<?php echo $cat['category_id'];?>" <?php if($cat['category_id']==$row['category_id']){echo "selected";} ?>><?php echo $cat['category_name']; ?></option>    
                            <?php       
                        }
                    }
                    ?>
                    </select><br>
                    

                    <label>Stock :</label><input type="number" value="<?php echo $row['stock']; ?>" name="stock"/><br>
                    <label>Description :</label><textarea rows="5" name="description"/><?php echo $row['description']; ?></textarea>
                    <label>Price :</label><input type="number" value="<?php echo $row['price']; ?>" name="price"/><br>
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