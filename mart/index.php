<?php
 //iclude user header file
 include 'user_header.php';

?>
 
 

<?php 
     //if clicked add to cart button  and assingning input value
     if(isset($_POST['addcart'])){
      $product_name=$_POST['product_name'];
      $product_price=$_POST['product_price'];
      $product_quantity=$_POST['quantity'];
      $product_name=$_POST['product_name'];
      $product_image=$_POST['product_image'];
      //execute query for the slect all item of cart where product name and user_id ids match
       $check_cart_number=mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'") or die('query failed');

       if(mysqli_num_rows($check_cart_number)>0){
       // if the same details row is already in table
         $messgae[]= 'prodduct alrady added';

       }
       else{
        //execute query for the isert cart values or details
        mysqli_query($conn,"INSERT INTO `cart`(user_id,name,price,quantity,image) 
        VALUES('$user_id','$product_name','$product_price','$product_quantity','$product_image')") or die('query failed!');
        $message[]='product added successfully';
        //redirect in index.php page
        header('location:index.php');
       }
     }
 ?>


<?php
// print message
   if(isset($message)){
       foreach($message as $message){
          echo'<div class="form" style="color:green"> <span>'.$message.'</span>
          <img src="./assets/icons/close.png" onclick="this.parentElement.remove();">
             </div>';
                        
       }
   }
?>

<!-- ===banner==== -->
<section>
   <div class="banner">
    <img src="./assets/banner/slides.jpg" alt="slide1.jpg">
   </div>
</section>
<!--products section-->
<section id="products">
    <h2>Our Products</h2>
    <div class="products">
          
       
              <?php 
                //execute query for select the all details of products
                 $select_products=mysqli_query($conn,"SELECT * FROM `products`") or die('query failed!');
                 if(mysqli_num_rows($select_products)>0){
                  //if product row greaterthan 0
                     while($fetch_products=mysqli_fetch_assoc($select_products)){

                
              ?>    
                <!--fetch product details and make the detals as input-->
                 <div class="product-details">
                    <form action="" method="post" enctype="multipart/form-data">
                    <img src="./uploaded_img./<?php echo $fetch_products['image']; ?>" alt="" class="image">
                    <h4><?php echo $fetch_products['name']; ?></h4>
                    <p>Rs. <?php echo $fetch_products['price']; ?>/-</p>
                    <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
                    <input type="hidden" name="product_price" value="  <?php echo $fetch_products['price']; ?>">
                    <input type="hidden" name="product_image" value="<?php echo $fetch_products['image'];?>">
                    <span>Quntity:</span><input type="number" name="quantity" min="1" value="1">
                      <div class="button">
                      <input style="width:90px" type="submit" value="add to cart" name="addcart" class="add-to-cart">
                      </div>
                    </form>
                </div>
              <?php 
                     }
                      }
                 else{
                        echo 'No product available !';
                    }
              ?>
    </div>
       
</section>

<?php
//include user_footer.php file
 include 'user_footer.php';
 ?>