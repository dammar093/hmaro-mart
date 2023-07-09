<?php
//include user_header.php
 include 'user_header.php';
 ?>
  <?php
      // get the order id when clicked on delete button
      if(isset($_GET['delete']))
      {
       $order_id=$_GET['delete'];
      // execute query for the delete selected cart items
       mysqli_query($conn,"DELETE FROM `orders` WHERE id = '$order_id'") or die('query failed!');
       //redirect user_order.php page
       echo '<script>window.location.href="user_order.php"</script>';
      }
  ?>  
<!---order section-->
<section class="order" width="100%">
    <h2>Orders Palced</h2>
  <div class="order-container">
    <table class="user-order">
             <tr>
                <th>Product Name Quantity</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th>Order Date</th>
               
             </tr>
        <?php
        // execute query for the select all from orders
           $select_oreders=mysqli_query($conn,"SELECT * FROM `orders` WHERE user_id='$user_id'") or die('query failed');
           if(mysqli_num_rows($select_oreders)>0){
            //if orders row is morethan 0
                while($fetch_orders=mysqli_fetch_assoc($select_oreders)){
                $order_status=$fetch_orders['order_status'];
                  // fetch all details of orders
               
        ?>

             <tr>
               <!--print  details of orders-->

                <td><?php echo $fetch_orders['total_products'];?></td>
                <td><?php echo $fetch_orders['total_price'];?></td>
                <td><?php echo $fetch_orders['method'];?></td>
                <td><?php echo $fetch_orders['order_status'] ?></td>
                <td><?php echo $fetch_orders['date'];?></td>
                <td><a href="user_order.php?delete=<?php echo $fetch_orders['id'];?> " onclick="return confirm('Are sure to cancel the order')" class="cancel <?php echo (strcmp($order_status,'pending'))? 'disabled':'';?>">cancel</a></td>  
             </tr>

        <?php
               }
           }
           else{
            echo'<p>no order placed yet</p>';
           }
        ?>
     </table>    
  </div>
     
</section>

<?php
//include admin footer file
 include 'user_footer.php'?>