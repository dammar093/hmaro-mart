<?php 
     //include header file
      include 'admin_header.php';
?>

   
    <div class="add-admin">
         <a href="admin_add_admin.php"><button><img src="./assets/icons/add-user.png" alt="">Add Admin</button></a>
    </div>
<section class="order">
      <?php 
      //get the admin id 
          if(isset($_GET['delete'])){
            $delete_id=$_GET['delete'];
            //delete selected admin account
            mysqli_query($conn,"DELETE FROM `users` WHERE id='$delete_id'") or die('query failed!');
            // redirect admin page
            echo '<script>window.location.href="admin_admin.php"</script>';
          }
          ?>
    <h2>Admin</h2>
  <div class="order-container">
    <table>
             <tr>
                <th>User Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th></th>
               
             </tr>
        <?php
        //select all user which type is admin
           $select_admin=mysqli_query($conn,"SELECT * FROM `users` WHERE user_type='admin' ") or die('query failed');
           if(mysqli_num_rows($select_admin)>0){
                while($fetch_admin=mysqli_fetch_assoc($select_admin)){
                    
        ?>

             <tr>
               <!--fetch admin details and print-->
                <td><?php echo $fetch_admin['id'];?></td>
                <td><?php echo $fetch_admin['name'];?></td>
                <td><?php echo $fetch_admin['email'];?></td>
                <td><?php echo $fetch_admin['password'];?></td>
                <!--delete button cliceked selected uadmin will be deleted-->
                <td> <a href="admin_admin.php?delete=<?php echo $fetch_admin['id'];?>" onclick="return confirm('Are sure delete the order?')" class="delete">delete</a></td>
             </tr>

        <?php
               }
           }
          
        ?>
     </table>    
  </div>
     
</section>

<?php
//include admin footer file
 include 'admin_footer.php'?>