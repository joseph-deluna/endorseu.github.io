<?php
session_start();
      if(isset($_GET['logout']))
      {
      session_destroy();
      unset($_SESSION['User']);
      header("location:login.php");
      }
?>
