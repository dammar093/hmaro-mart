        <?php  
        // include config file
           include 'config.php';
        // check sumbit is set or not 
           if(isset($_POST['submit']))
           {
            // if sumbit is set assigning value from inputs
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pass = mysqli_real_escape_string($conn, $_POST['password']);
            $cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
           // execute query for selecting email and password
            $select_users= mysqli_query($conn, "SELECT * FROM `users` WHERE email= '$email' AND password='$pass'") or die('query failed!');
              // check no. of rows
              if(mysqli_num_rows($select_users)>0){
                //error message when input value or data value is same
                 $message[]='user alreday exist!';
              }
              //check confirm password and password
              else{
                  if($cpass!=$pass)
                  {
                    // error message when confirm and password not match
                    $message[]='confirm password does not match!';

                  }
                  else{
                    // if there is noe same value of table rows and input
                    //execute query for insert the input value in table users
                     mysqli_query($conn,"INSERT INTO `users`(name, email, password, user_type) VALUES('$name','$email','$cpass','user')") or die('query failed!');
                     $message[]='successfully login';
                     //redirect login page
                     header('location:login.php');
                  }
              }
        }
       ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

    <div class="form-container">
        <form action="" method="post">
            <div class="title">
                  <h2>Register <span>Now</span></h2>
            </div>

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
            <div class="form">
                <span><img src="./assets/icons/name.png" alt=""></span> <input type="text" name="name"
                    placeholder="Enter your name" class="box" required>
            </div>
            <div class="form">
                <span><img src="./assets/icons/user.png" alt=""></span> <input type="email" name="email"
                    placeholder="Enter your email" class="box" required>
            </div>
            <div class="form">
                <span><img src="./assets/icons/password.png" alt=""></span> <input type="password" name="password"
                    placeholder="Enter your password" class="box" required>
            </div>
            <div class="form">
                <span><img src="./assets/icons/password.png" alt=""></span> <input type="password" name="cpassword"
                    placeholder="Confirm your password" class="box" required>
            </div>
          <div class="form">
             <input type="submit" name="submit" value="register now" class="box btn" >
        </div>
           <p>already have an account? <a href="login.php">loin now</a></p>
        </form>

    </div>
</body>

</html>