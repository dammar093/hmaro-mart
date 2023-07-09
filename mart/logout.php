<?php
// logout from the page
   include 'config.php';
   session_start();
  //unset the session
   session_unset();
   //destroy the session
   session_destroy();
  //redirect login page
   header('location:login.php');
?>