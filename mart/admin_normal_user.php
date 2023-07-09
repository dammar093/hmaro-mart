<?php 
     //include header file
      include 'admin_header.php';
?>

<section class="order">
      <?php 
      //get user id to delete
          if(isset($_GET['delete'])){
            $delete_id=$_GET['delete'];
            //deleted selcetd user account
            mysqli_query($conn,"DELETE FROM `users` WHERE id='$delete_id'") or die('query failed!');
            //redirect normal user page
            echo '<script>window.location.href="admin_normal_user.php"</script>';
          }
          ?>
    <h2>Normal User</h2>
  <div class="order-container users">
    <table>
             <tr>
                <th>User Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th></th>
             </tr>
        <?php
           $select_user=mysqli_query($conn,"SELECT * FROM `users` WHERE user_type='user' ") or die('query failed');
           if(mysqli_num_rows($select_user)>0){
                while($fetch_user=mysqli_fetch_assoc($select_user)){
                    
        ?>

             <tr>
               <!--fetch user details and print-->
                <td><?php echo $fetch_user['id'];?></td>
                <td><?php echo $fetch_user['name'];?></td>
                <td><?php echo $fetch_user['email'];?></td>
                <td><?php echo $fetch_user['password'];?></td>
                <td> <a href="admin_admin.php?delete=<?php echo $fetch_user['id'];?>" onclick="return confirm('Are sure delete the order?')" class="delete">delete</a></td>
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