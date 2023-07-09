<?php  
    //include config file
     include 'config.php';
     //start the session
     session_start();
           //check the condition sumbit
           if(isset($_POST['submit']))
           {
            //if isset retrun true
            // assign the value of inputs email password
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = mysqli_real_escape_string($conn, $_POST['password']);
            // select the value of email and password from database's table users
            $select_users= mysqli_query($conn, "SELECT * FROM `users` WHERE email= '$email' AND password='$pass'") or die('query failed!');
             // check the row no.
              if(mysqli_num_rows($select_users)>0){
                  // fetch data from table users
                   $row=mysqli_fetch_assoc($select_users);
                  //check the user is admin
                   if($row['user_type']=='admin')
                   {
                    //assigning data
                    $_SESSION['admin_name'] = $row['name'];
                    $_SESSION['admin_email'] = $row['email'];
                    $_SESSION['admin_id'] = $row['id'];
                    //redirect admin page
                    header('location:admin.php');
                   }
                   //check the user is normal user
                   else if($row['user_type']=='user')
                   {
                    //assigning the data 
                     $_SESSION['user_name'] = $row['name'];
                     $_SESSION['user_email'] = $row['email'];
                     $_SESSION['user_id'] = $row['id'];
                     //redirect index page
                     header('location:index.php');
                   }
              }
                // error message
              else{
                $message[]='incorrect email or password';
                 
              }
        }
     ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

    <div class="form-container">
        <form action="" method="post">
            <div class="title">
                  <h2>Login <span>Now</span></h2>
            </div>
           <!-- showing error message-->
            <?php
                 if(isset($message)){
                    foreach($message as $message){
                        echo'<div class="form" style="color:red"> <span>'.$message.'</span>
                          <img src="./assets/icons/close.png" onclick="this.parentElement.remove();">
                        </div>';
                        
                    }

                 }
             ?>
                
            <div class="form">
                <span><img src="./assets/icons/user.png" alt=""></span> <input type="text" name="email"
                    placeholder="Enter your email" class="box" required>
            </div>
            <div class="form">
                <span><img src="./assets/icons/password.png" alt=""></span> <input type="password" name="password"
                    placeholder="Enter your password" class="box" required>
            </div>
            
          <div class="form">
             <input type="submit" name="submit" value="login now" class="box btn" >
        </div>
           <p>didn't have an account? <a href="register.php">register</a></p>
        </form>

    </div>
</body>

</html>