<?php require_once 'config/header.php';?>
<?php require_once 'config/functions.php';
?>
<!-- Nav bar START -->
<div class="nav-item dropdown">
        
        <img class="nav-link dropdown-toggle" src="img/user.png" alt="admin" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <div class="dropdown-divider"></div>
          <a id="logout" href="index.php?logout='1'">Logout</a>
        </div>
      </div>
    
  </div> 
</nav>
<!-- Nav bar END -->


<div class="container">
<!-- Students table -->
<?php appointmentTable() ?>

 <!-- Add Student Button -->

<?php require_once 'config/footer.php'?>
