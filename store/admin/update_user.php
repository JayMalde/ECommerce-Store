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
    $id = $_REQUEST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $con = mysqli_connect("localhost","root","","store") or die("Database Connectivity Failed");
    if($firstname && $lastname && $email && $address && $contact){
        $query = "update user set firstname='$firstname', lastname='$lastname',email='$email', address='$address', contact='$contact' where id=$id";
        if(mysqli_query($con,$query))
        {
            header("refresh:0,url=http://localhost/store/admin_page.php?page=users");            
        }else {
           echo "<br>0 Records in Row".mysqli_error($con);
        }
    }
    else{
        $query = "select * from user where id = $id";
        $result = mysqli_query($con,$query);
        if($result>0){
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <div class="container">
                <form action="update_user.php" method="post">
                    <label>User ID :</label><input type="text" readonly value="<?php echo $row['id']; ?>" name="id"/><br>
                    <label>Firstname :</label><input type="text" value="<?php echo $row['firstname']; ?>" name="firstname"/><br>
                    <label>Lastname :</label><input type="text" name="lastname" value="<?php echo $row['lastname']; ?>"/><br>
                    <label>Email :</label><input type="email" name="email" value="<?php echo $row['email']; ?>"/><br>
                    <label>Address :</label><textarea rows=5 cols=15 name="address"><?php echo $row['address']; ?></textarea><br>
                    <label>Contact No :</label><input type="text" value="<?php echo $row['contact']; ?>" name="contact"/><br>
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