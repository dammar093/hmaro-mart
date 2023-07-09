
<?php
    // include header section of admin page
     include 'admin_header.php';
?>

<section id="dashboard">
            <h2>Dashboard</h2>
            <div class="dashboard">
                <div class="about-dashboard">
                      <?php
                      //execute query for slect the total pending order
                        $select_pending_orders=mysqli_query($conn,"SELECT * FROM `orders`  WHERE order_status='pending'") or die();
                        $number_of_pending_orders=mysqli_num_rows($select_pending_orders);

                     ?>
                     <!--showing total number of admin-->
                     <h4>Total Pending Orders</h4>
                     <p><?php echo $number_of_pending_orders;?></p>
                 </div>

                  <div class="about-dashboard">

                  <?php
                  // total pending earning calculate
                      $total_pendings=0;
                      //execute query to select pending orders
                      $select_pending=mysqli_query($conn,"SELECT total_price FROM `orders` WHERE
                      payment_status='pending'") or die('query failed!');
                     if(mysqli_num_rows($select_pending)>0)
                     {
                        // detch all pending orders
                        while($fetch_pendings=mysqli_fetch_assoc($select_pending)){
                              $total_price=$fetch_pendings['total_price'];
                              $total_pendings+=$total_price;
                              
                            };
                     }
                  ?>
                  <!-- Showing pending earning-->
                        <h4>Total pending Earning <h4>
                        <p> Rs. <?php echo $total_pendings;?>/-</p>
                  </div>
                  <div class="about-dashboard">
                      <?php
                      //total completed order
                        $select_deliver_orders=mysqli_query($conn,"SELECT * FROM `orders`  WHERE order_status='delivered'") or die();
                        $number_of_delivered_order=mysqli_num_rows($select_deliver_orders);

                     ?>
                     <!--showing total number of admin-->
                     <h4>Total Delivered</h4>
                     <p><?php echo $number_of_delivered_order;?></p>
                  </div>

                  <div class="about-dashboard">

                   <?php
                   // total order palced
                     $total_completed=0;
                     //execute query for select paid orders
                     $select_completed=mysqli_query($conn,"SELECT total_price FROM `orders` WHERE
                     payment_status='paid'") or die('query failed!');
                    if(mysqli_num_rows($select_completed)>0)
                    {
                     //fetch all paid orders and calculate total paid price
                       while($fetch_completed=mysqli_fetch_assoc($select_completed)){
                             $total_price=$fetch_completed['total_price'];
                             $total_completed+=$total_price;
                             
                           };
                    }
                    ?>
                    <!--showing total order completed aor sells earning-->
                    <h4>Total Earning <h4>
                    <p>Rs. <?php echo $total_completed;?>/-</p>
                 </div>
                 <div class="about-dashboard">
                      <?php
                        $select_order=mysqli_query($conn,"SELECT * FROM `orders`") or die();
                        $number_of_orders=mysqli_num_rows($select_order);

                     ?>
                     <h4>Total Orders</h4>
                     <p><?php echo $number_of_orders;?></p>
                 </div>
                     
                 <div class="about-dashboard">
                      <?php
                      // execute query for the select total canceled order
                        $select_cancel_orders=mysqli_query($conn,"SELECT * FROM `orders`  WHERE order_status='cancelled'") or die();
                        $number_of_cancelled_order=mysqli_num_rows($select_cancel_orders);

                     ?>
                     <!--showing total number of admin-->
                     <h4>Total Cancelled Oreders</h4>
                     <p><?php echo $number_of_cancelled_order;?></p>
                 </div>

                 <div class="about-dashboard">
                      <?php
                      //execute query for the total on the way order
                        $select_onway_orders=mysqli_query($conn,"SELECT * FROM `orders`  WHERE order_status='on the way'") or die();
                        $number_of_onway_order=mysqli_num_rows($select_onway_orders);

                     ?>
                     <!--showing total number of admin-->
                     <h4>On The Way</h4>
                     <p><?php echo $number_of_onway_order;?></p>
                 </div>
                 <div class="about-dashboard">
                      <?php
                      // execute query for the total product added
                        $select_products=mysqli_query($conn,"SELECT * FROM `products` ") or die();
                        $number_of_products=mysqli_num_rows($select_products);

                     ?>
                     <!-- showing number of added products-->
                     <h4>Available Products</h4>
                     <p><?php  echo $number_of_products;?></p>
                 </div>


                 <div class="about-dashboard">
                      <?php
                      // execute query for the  total normal users
                        $select_users=mysqli_query($conn,"SELECT * FROM `users`  WHERE user_type='user'") or die();
                        $number_of_users=mysqli_num_rows($select_users);

                     ?>
                     <!--showing total number of users-->
                     <h4>Normal Users</h4>
                     <p><?php echo $number_of_users;?></p>
                 </div>
                 <div class="about-dashboard">
                      <?php
                      //execute query for the  total admin
                        $select_admin=mysqli_query($conn,"SELECT * FROM `users`  WHERE user_type='admin'") or die();
                        $number_of_admin=mysqli_num_rows($select_admin);

                     ?>
                     <!--showing total number of admin-->
                     <h4>Admin</h4>
                     <p><?php echo $number_of_admin;?></p>
                 </div>
            </div>
      </section>
    

<?php
  // include the footer section of admin page
     include 'admin_footer.php';
?>