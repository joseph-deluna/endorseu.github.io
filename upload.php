<?php
require_once 'config/functions.php';
require_once 'config/header.php';
?>
</nav>
<?php 
if(isset($_POST['btn-upload']))
{    
     
 $file = rand(1000,100000)."-".$_FILES['file']['name'];
 $file_loc = $_FILES['file']['tmp_name'];
 $title = $_POST['title'];
 $documentID = $_SESSION['student']['student_index'];
 $folder="uploads/";
 echo "title: " . $title . "<br>";
 echo "document_id: " . $documentID . "<br>";
 echo "file: " . $file . "<br>";
 
 
 if(move_uploaded_file($file_loc,$folder.$file)){
     
 $sql="INSERT INTO documents(file, title, document_id)
  VALUES('$file', '$title', '$documentID')";
 $connect->query($sql); 
 echo "<div class='alert alert-success' role='alert'>Uploaded Successfully</div>";
 echo "<a href='student_home.php'>Back</a>";
 } else {
    echo "<div class='alert alert-danger' role='alert'>Upload Failed. Try again</div>";
    echo "<a class='btn btn-default ml-4' href='student_home.php'>Back</a>";
 }
} else {
    header('location: student_home.php');
}

require_once 'config/footer.php';
?>
