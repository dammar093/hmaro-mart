<?php
  //include hedare file
  include  'admin_header.php';
?>
 <!--added products-->
   <section id="products">
            <h2>Added Products</h2>
            <div class="products">
                  <?php
                    //select added produvts detail like image name price
                      $select_products=mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');     
                       if(mysqli_num_rows($select_products)>0){
                             //fetch details   
                            while($fetch_products=mysqli_fetch_assoc($select_products)){
                        ?>  
                           <div class="product-details">
                            <!--showing details of product--> 
                            <img class="image"src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                             <h4><?php echo $fetch_products['name']; ?></h4>
                             <p>Rs. <?php echo $fetch_products['price'];?>/-</p>
                             <!--update product button--> 
                             <a href="admin_products.php?update=<?php echo $fetch_products['id'];?>" class="update-btn background"><img src="./assets/icons/updated.png" alt=""> update</a>
                             <!--delete product button-->
                             <a href="admin_products.php?delete=<?php echo $fetch_products['id'];?>" calss="canceld-btn background" onclick="return confirm(' Are you delete this product ?');"><img src="./assets/icons/delete.png" alt=""> delete</a>
                            </div>
                            <?php
                             }
                           }
                     else{
                           echo'<p>No product added yet</p>';
                        }
                    ?>
                     <?php
                     // this code for delete products
                        if(isset($_GET['delete'])){
                           $delete_id=$_GET['delete'];
                          $delete_image=mysqli_query($conn,"SELECT image FROM `products` WHERE id='$delete_id'") or die('query failed!');
                          $fetch_delete_image=mysqli_fetch_assoc($delete_image);
                          unlink('uploaded_img/'.$fetch_delete_image['image']);
                          mysqli_query($conn,"DELETE FROM `products` WHERE id ='$delete_id'") or die('query failed!');
                          //redirect admin_products page
                            //header('location:admin_products.php');
                            echo '<script>window.location.href="admin_products.php"</script>';
                      
                        }
                        ?>
                        <?php
                        // this code for update the products
                        // assigning update value
                        if(isset($_POST['update_product'])){
                          $update_p_id=$_POST['update_p_id'];
                          $update_name=$_POST['update_name'];
                          $update_price=$_POST['update_price'];
                          // update the product detai in product table
                          mysqli_query($conn,"UPDATE `products` SET name ='$update_name', price='$update_price' WHERE id='$update_p_id'") or die('query failed!');
                          $update_image=$_FILES['update_image']['name'];
                          $update_image_tmp_name=$_FILES['update_image']['tmp_name'];
                          $update_image_size=$_FILES['update_image']['size'];
                          $update_folder='uploaded_img/'.$update_image;
                          $update_old_image=$_POST['update_old_image'];
                          if(!empty($update_image)){
                            if($update_image_size>200000){
                              $message[]='image size too large!';
                            }
                            else{
                              mysqli_query($conn,"UPDATE `products` SET image='$update_image' WHERE id='$update_p_id'") or die('query failed!');
                              move_uploaded_file($update_image_tmp_name,$update_folder);
                              unlink('uploaded_img/'.$update_old_image);
                            }
                          }
                          //redirect admkin_products page
                         // header('location:admin_products.php');
                          echo '<script>window.location.href="admin_products.php"</script>';
                        }  
                   ?>      
            </div>
    </section>
    <!-- update product section-->
     <section id="admin_products">
             <div class="upadte-products">
                <?php
                    if(isset($_GET['update'])){
                      $update_id=$_GET['update'];
                      $update_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id='$update_id'") or die('query failed!');
                      if(mysqli_num_rows($update_query)>0){
                            while($fetcth_update = mysqli_fetch_assoc($update_query)){   
                ?>
                <div class="update-container" id="admin_products">
                 <form action="" method="post" enctype="multipart/form-data">
                    <h2>Update Product</h2>
                        
                    <?php
                    //showing error message
                        if(isset($message)){
                           foreach($message as $message){
                               echo'<div class="form" style="color:red"> <span>'.$message.'</span>
                                 <img src="./assets/icons/close.png" onclick="this.parentElement.remove();">
                               </div>';
                               
                           }
       
                        }
                       ?>
                      <input type="hidden" name="update_p_id" value="<?php echo $fetcth_update['id']; ?>">
                      <input type="hidden" name="update_old_image" value="<?php echo $fetcth_update['image']; ?>">   
                         <img class="update-img"src="./uploaded_img/<?php echo $fetcth_update['image']; ?>" alt="image">
                  <div class="form">
                      <span><img src="./assets/icons/name.png" alt=""></span> <input type="text" name="update_name"
                       placeholder="Enter product name" class="box" required value="<?php echo $fetcth_update['name']; ?>">
                   </div>
                   <div class="form">
                       <span><img src="./assets/icons/get-money.png" alt=""></span> <input type="number" name="update_price"
                       placeholder="Enter product price" class="box price" required min="1" value="<?php echo $fetcth_update['price']; ?>" >
                   </div>
                   <div class="form">
                    <span><img src="./assets/icons/image-files.png" alt=""></span> <input type="file" name="update_image"
                     accept="image/jpeg, image/png, image/jpg" class="box">
                     </div>
                     <input type="submit" name="update_product" value="update"id="update" class="btn">
                     <input type="reset" name="reset_product" value="cancel" id="close-update" class="btn" style="background-color:red">
                 </form>
                 </div>
                <?php
                       }
                        }
                        }
                        else{
    
                    }
                ?>
             </div>
     </section>
<?php
//iclude admin footer file
  include 'admin_footer.php';
?>