<?php require_once 'config/header.php';?>
<?php require_once 'config/functions.php';
if (!isAdmin()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
?>
</nav>

<div class="container">
<?php viewDocuments()?>

</div>

<?php require_once 'config/footer.php'?>