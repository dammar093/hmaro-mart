<?php include 'user_header.php'; ?>
       <?php
          //clicked order now and assigning the input values
          if(isset($_POST['payment'])){
            $name=mysqli_real_escape_string($conn,$_POST['name']);
            $email=mysqli_real_escape_string($conn,$_POST['email']);
            $address=mysqli_real_escape_string($conn,$_POST['address']);
            $phone=mysqli_real_escape_string($conn,$_POST['phone']);
            $method=mysqli_real_escape_string($conn,$_POST['method']);
            $cart_total=0;
            $cart_products[]='';
            //execute query for the select cart items where user_id matched
            $cart_query=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
             if(mysqli_num_rows($cart_query)>0){
              //if selected cart has morethe 0 row
              while($cart_item = mysqli_fetch_assoc($cart_query)){
                // fetch cart details
                $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
                //calculate sub total and grant total
                $sub_total=($cart_item['price'] * $cart_item['quantity']);
                $cart_total+=$sub_total;
               
              }
             }
              // cancadinate the product array using implode method
                $total_products = implode(',',$cart_products);
                //execute query for the select orders where all coditon is true
                $order_query=mysqli_query($conn,"SELECT * FROM `orders` WHERE name='$name'AND number='$' AND email='$email' AND 
                method='$method' AND address='$address' AND total_products='$total_products' AND total_price='$cart_total'") or die('query failed!');
                // show mesage if cart is empty
                if($cart_total==0)
                {
                  $message[]='your cart is empty';
                }
                else{
                  //ordres row is already exist
                  if(mysqli_num_rows($order_query)>0){
                    $message[]='order already placed';
                  }
                  else{
                    //execute query for the insert all details of orders
                    mysqli_query($conn,"INSERT INTO `orders`(user_id,name,number,email,method,address,total_products,
                    total_price) VALUES('$user_id','$name','$phone','$email','$method','$address','$total_products',
                    '$cart_total')") or die('query failed!');
                    $message[]='order placed successfully';
                    //delete the cart items from selected users id
                    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    //redirect user_order.php page
                    header('location:user_orders.php');
                  }
                }
           }
        ?>
   <section>
    <!--payment section -->
        <div class="payment">
               <h2>Order Now</h2>
               <form action="" method="post">
                  <div class="payment-details">
                    <span><img src="./assets/icons/id-card.png" alt=""></span><input type="text" name="name" placeholder="Enter your name" required class="pay">
                  </div>
                  <div class="payment-details">
                    <span><img src="./assets/icons/email.png" alt=""></span><input type="email" name="email" placeholder="Enter your email" required class="pay">
                  </div>
                  <div class="payment-details">
                    <span><img src="./assets/icons/home-address.png" alt=""></span><input type="text" name="address" placeholder="Enter your address" required class="pay">
                  </div>
                  <div class="payment-details">
                    <span><img src="./assets/icons/phone-call.png" alt=""></span><input type="text" name="phone" placeholder="Enter your phone" required class="pay">
                  </div>
                  <div class="payment-details">
                   <span><img src="./assets/icons/debit-card.png" alt=""></span> 
                   <select name="method" id="" class="pay" required>
                        <option value="e-sewa">e-sewa</option>
                        <option value="cash on delivery">cash on delivery</option>
                    </select>

                  </div>
                  <div class="payment-details">
                    <span><img src="./assets/icons/order-now.png" alt=""></span>
                    <input type="submit" name="payment" value="order now" class="pay pay-now"></div>
               </form>
        </div>
    </section>
<?php include 'user_footer.php';?>