   <?php 
      
      //include admin header file
      include 'admin_header.php';
    ?>
    <?php
         //update selected order id and updated
         //assigning update value in the variable
          if(isset($_POST['update_order'])){
            $order_id=$_POST['order_id'];
            $update_payment_status=$_POST['update_payment'];
            $update_order_status=$_POST['order_update'];
            //execute query for selected order
            mysqli_query($conn,"UPDATE `orders` SET order_status='$update_order_status', payment_status='$update_payment_status' WHERE id='$order_id'") or die('query failed');
            $message[]='Oredr payment status and order status is updated';
          }
        // get order id 
          if(isset($_GET['delete'])){
            $delete_id=$_GET['delete'];
            //execiute query for selected order
            mysqli_query($conn,"DELETE FROM `orders` WHERE id='$delete_id'") or die('query failed!');
            header('location:admin_order.php');
          }
    ?>
<section class="order">
    <h2>Orders Palced</h2>
  <div class="order-container">
  <?php
      // printing message
                 if(isset($message)){
                    foreach($message as $message){
                        echo'<div class="form" style="color:green"> <span>'.$message.'</span>
                          <img src="./assets/icons/close.png" onclick="this.parentElement.remove();">
                        </div>';
                        
                    }

                 }
             ?>
                
    <table class="table" >
             <tr>
                <th>User Id</th>
                <th>Name</th>
                <th>Phone No.</th>
                <th>Email</th>
                <th>Address</th>
                <th>Total Products</th>
                <th>Total Price</th>
                <th>Payment Method</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Order Date</th>
                <th>Update Payment Status</th>
                <th>Update Order Status</th>
                <th></th>
                <th></th>
                
               
             </tr>
        <?php
        // execute query to selecte orders
           $select_oreders=mysqli_query($conn,"SELECT * FROM `orders` ") or die('query failed');
           if(mysqli_num_rows($select_oreders)>0){
            //if order is morethan 0 setch all orders
                while($fetch_orders=mysqli_fetch_assoc($select_oreders)){

        ?>
             
             <tr>
               <!-- fetch all details of orders and print-->
                <td><?php echo $fetch_orders['user_id'];?></td>
                <td><?php echo $fetch_orders['name'];?></td>
                <td><?php echo $fetch_orders['number'];?></td>
                <td><?php echo $fetch_orders['email'];?></td>
                <td><?php echo $fetch_orders['address'];?></td>
                <td><?php echo $fetch_orders['total_products'];?></td>
                <td><?php echo $fetch_orders['total_price'];?></td>
                <td><?php echo $fetch_orders['method'];?></td>
                <td><?php echo $fetch_orders['payment_status'];?></td>
                <td><?php echo $fetch_orders['order_status'];?></td>
                <td><?php echo $fetch_orders['date'];?></td>
               
                
                <form action="" method="post">
                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'];?>">
                
                <td><span><img src="./assets/icons/get-money.png" alt=""></span>
                    <select name="update_payment" id=""]>
                        <option value="pending" selected>pending</option>
                        <option value="paid">paid</option>
                    </select></td>
                    <td>
                        <span><img src="./assets/icons/delivery.png" alt=""></span>
                        <select name="order_update" id=""]>
                        <option value="pending" selected>pending</option>
                        <option value="on the way ">on the way</option>
                        <option value="delivered">delivered</option>
                        <option value="cancelled">cancelled</option>
                    </select>
                  </td>
                  <td>
                  <input type="submit" value="update" name="update_order" class="update-btn" style="    outline: none;
                  width: 80px;
                  padding: 10px 12px;
                  background-color:blue;
                  color: white;
                  border: none;
                  text-align: center;
                  border-radius: 5px;
                  cursor: pointer;">
                  </td>
                    <td>  
                     <!--delete button and get the order-->
                    <a href="admin_order.php?delete=<?php echo $fetch_orders['id'];?>" onclick="return confirm('Are sure delete the order?')" class="delete">delete</a>
                   </td>
                </form>
                
             </tr>
             <div class="order-action">
               
             </div>

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
 include 'admin_footer.php'?>