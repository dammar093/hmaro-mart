<?php include 'user_header.php';?>

   <?php 
      // clicked update button
      // assign the input values 
       if(isset($_POST['cart_update'])){
         $c_id=$_POST['c_id'];
         $cart_quantity=$_POST['update_quantity'];
         //execute query for the update cart pruducts
         mysqli_query($conn,"UPDATE `cart` SET 	quantity='$cart_quantity' WHERE id='$c_id'") or die('query failed!');

         $message[]='cart quantity is updated';
        // redirect user_cart.php page
        echo '<script>window.location.href="user_cart.php"</script>';
       }
       // get the cart id when clicked on delete button
       if(isset($_GET['delete']))
       {
        $p_id=$_GET['delete'];
       // execute query for the delete selected cart items
        mysqli_query($conn,"DELETE FROM `cart` WHERE id= '$p_id'") or die('query failed!');
        //redirect user_cart.php page
        echo '<script>window.location.href="user_cart.php"</script>';
       }

    ?>
          
             <?php
               // print message
                 if(isset($message)){
                    foreach($message as $message){
                        echo'<div class="form" style="color:green; text-align:center;"> <span>'.$message.'</span>
                          <img src="./assets/icons/close.png" onclick="this.parentElement.remove();">
                        </div>';
                        
                    }

                 }
             ?>
    <section>
      <!--cart section-->
          <div class="cart">
               <h2>Cart Products</h2>
               <div class="added-cart " style=" overflow-x:auto">
                    
                        <table >
                            <th>Product</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub Total</th>
                            <th></th>
                           <?php  
                           // create variable for storing total price
                            $grant_total_price=0;
                            //execute query for the select cart from selected user_id
                              $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed!');
                              if(mysqli_num_rows($select_cart)>0){
                                 // if the cart row is morethan 0 fetch all detals of cart
                                  while($fetch_cart=mysqli_fetch_assoc($select_cart)){
                                    $sub_total=0;
                                  $p_price=$fetch_cart['price'];
                                  $p_qauntity=$fetch_cart['quantity'];
                                  //calculate sub total
                                  $sub_total+=($p_price * $p_qauntity);
                                  //claculate grant total
                                  $grant_total_price+=$sub_total;
                           ?>
                             <tr>
                              <!--fetch all details of cart and print-->
                                <td><img  src="./uploaded_img/<?php echo $fetch_cart['image']; ?> " alt=""></td>
                                <td><?php echo $fetch_cart['name'] ?></td>
                                <td>Rs. <?php echo $fetch_cart['price']?>/-</td>
                                <form action="" method="post">
                                <td><input type="number" name="update_quantity" value="<?php echo $fetch_cart['quantity'] ?>" min="1" class="quantity"></td>
                                <td>Rs. <?php echo $sub_total;?>/-</td>
                                <input type="hidden" name="c_id" value="<?php echo $fetch_cart['id'];?>">
                                <td><input type="submit" name="cart_update" value="update"  class="btn"></td>
                                <td><a href="user_cart.php?delete=<?php echo $fetch_cart['id'];?> " onclick="return confirm('Are sure to remove the added cart')" class="cancel">remove</a></td>  
                                </form>
                                
                            </tr>
                           <?php
                           
                                  }
                                 }else{
                                    echo '<p style="text-align:center"> No cart added</p>';
                                  }
                           ?>
                            
                         </table>

                        <div class="total-price">
                            <?php  
                            //print grant total price
                                echo '<p style="font-weight:bold; text-align:center; margin-top:12px">Total Price Rs.'.$grant_total_price.'/-</p>';
                            ?>
                        </div>      

                 </div>
                     <div class="check-out" style="margin: 20px;">
                     <!--check out button if the no product added the disabled class disabbled-->
                          <a href="user_payment.php" class="order-btn <?php echo ($grant_total_price>1)? '':'disabled';?>">Check Out</a>
                     </div>
          </div>


    </section>
<?php 
//include user-footer.php file
include 'user_footer.php';?>