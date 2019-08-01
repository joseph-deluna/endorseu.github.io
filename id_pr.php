<?php 
$connect = new mysqli("127.0.0.1","root","newpassword","endorseu");

// $str=($_POST['str']);
// if(isset($_POST['str'])){
    
// $qry="SELECT concat(lname, ', ', fname, ' ', mname, '.') 
// AS students FROM student WHERE idnum = '$str'";
// $result = $connect->query($qry);
// while($row = $result->fetch_assoc()){
//     echo $row['students'];
//     }
// }

if (isset($_POST['id_num'])) {
    $idnum = strip_tags($_POST['id_num']);
    

    $qry="INSERT INTO added_student(id_num) 
    VALUES ('$idnum')";
    
    if ($connect->query($qry) === TRUE){
    echo "Student succesfully added! <br>";
    echo "<strong>ID number: </strong>" . $idnum . "<br>";
 
    } else {
        "Error: " . $qry . "<br>" . $connect->error;
    }
}

if(isset($_POST['todo']) && $_POST['todo']=='getAppoint'){
    $month = $_POST['month'];
    $day = $_POST['day'];
    $year = $_POST['year'];
    $time = $_POST['time'];
    $venue = $_POST['venue'];
    $id = $_POST['id'];
    
    $qry = "INSERT INTO appointment(appointment_id, month, day, year, time, venue)
   // $qry = "UPDATE appointment INNER JOIN student ON
    // appointment.appointment_id = student.student_index
    // SET month = '$month', day = '$day', year = '$year', time = '$time',
    // venue = '$venue'
    // WHERE appointment_id = '$id';";

    die($qry);
    if ($connect->query($qry) === TRUE){
        echo "Success! Appointment has been set!";
        
    } else {
        "Error: " . $qry . "<br>" . $connect->error;
    }
}

if(isset($_POST['set'])) {
    $approval = $_POST['approval'];

    $qry = "UPDATE documents 
    INNER JOIN student ON documents.document_id = student.student_index
    SET approval='$approval'
    WHERE document_id=student_index;";  
    if ($connect->query($qry) === TRUE){
        echo "Success! Approval has been set!";
        echo "<a href='index.php'> Go Back</a>";
        
    } else {
        "Error: " . $qry . "<br>" . $connect->error;
    }
}
 


?>