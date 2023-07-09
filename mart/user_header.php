<?php 
    //include config file
    include 'config.php';
    session_start();
    // Check if the admin_id is set in the session
   if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header('location:login.php');
  
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hamro Mart</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/user_cart.css">
    <link rel="stylesheet" href="./css/user_orders.css">
    <link rel="stylesheet" href="./css/user_pay.css">
    <link rel="icon" type="image/x-icon" sizes="180x180" href="./assets/icons/logo.png">
</head>

<body>

</body>

</html>
<!--header section-->
<section id="header">
    <div class="nav">
        <div class="logo">
            <img src="./assets/icons/logo.png" alt="" style="width:80px">
        </div>

        <div class="links">
            <ul>
                <li><a href="index.php"><img src="./assets/icons/home.png" alt=""></a></li>
                <li><a href="user_orders.php"><img src="./assets/icons/order.png" alt=""></a></li>

            </ul>
        </div>
        <div class="profile">
                <?php 
                    $user_id=$_SESSION['user_id'];
                     $select_cart_number = mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id= '$user_id'") or die('query failed!');
                     $cart_row=mysqli_num_rows($select_cart_number);

                ?>
                 <a href="user_cart.php"><img id="cart-image"src="./assets/icons/cat.png" alt=""><span style="color:black">[<?php echo $cart_row; ?></php>]</span></a>
            
            <img id="profile" src="./assets/icons/man.png" alt="">
        </div>
        <div class="profile-details" id="display">
            <p>Name: <?php echo $_SESSION['user_name']?></p>
            <p>Email: <?php echo $_SESSION['user_email']?></p>
            
            <a href="logout.php"><button><img src="./assets/icons/check-out.png"
                        alt="">Logout</button></a>
        </div>
    </div>

</section>