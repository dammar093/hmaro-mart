<?php
// Include the config file
include 'config.php';

// Start the session
session_start();

// Check if the admin_id is set in the session
if (!isset($_SESSION['admin_id'])) {
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
      <title>Hmaro Mart</title>
      <link rel="stylesheet" href="./css/admin_page.css">
      <link rel="stylesheet" href="./css/admin_update_products.css">
      <link rel="stylesheet" href="./css/admin_add_admin.css"> 
      <link rel="stylesheet" href="./css/admin_orders.css">
      <link rel="icon" type="image/x-icon" sizes="200x200" href="./assets/icons/logo.png">
</head>

<body>
      <!--header section start-->

      <section id="header">
            <div class="nav">
                  <div class="logo">
                        <img style="width:80px" src="./assets/icons/logo.png" alt="">
                  </div>

                  <div class="links">
                        <ul>
                              <li><a href="admin.php"><img src="./assets/icons/home.png" alt=""><span>Home</span></a></li>
                              <li><a href="admin_add_product.php"><img src="./assets/icons/add-product.png" alt=""><span>Add Products</span></a></li>
                              <li><a href="admin_products.php"><img src="./assets/icons/products.png" alt=""><span>Products</span></a></li>
                              <li><a href="admin_order.php"><img src="./assets/icons/checklist.png" alt=""><span>Orders</span></a></li>
                              <li><a href="admin_normal_user.php"><img src="./assets/icons/users.png" alt=""><span>User</span></a></li>
                              <li><a href="admin_admin.php"><img src="./assets/icons/admin.png" alt=""><span>Admin</span></a></li>
                        </ul>
                  </div>

                  <div class="profile">
                        <img id="profile" width="30" src="./assets/icons/man.png" alt="">
                  </div>
                  <div class="profile-details" id="display">
                        <p>Name: <?php echo $_SESSION['admin_name'] ?></p>
                        <p>Email:<?php echo $_SESSION['admin_email'] ?> </p>
                       <a href="logout.php"><button><img src="./assets/icons/check-out.png" alt="">Logout</button></a>
                  </div>
            </div>

      </section>