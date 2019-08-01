<?php
session_start();

// connect to database
require_once 'connection.php';
// variable declaration
$username = "";
$errors   = array();

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

if (isset($_POST['subm'])) {
	loginStudent();
}

if (isset($_POST['sub'])) {
	loginAdviser();
}

function e($val)
{
	global $connect;
	return mysqli_real_escape_string($connect, trim($val));
}

function display_error()
{
	global $errors;

	if (count($errors) > 0) {
		echo '<div class="alert alert-danger error">';
		foreach ($errors as $error) {
			echo $error . '<br>';
		}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['student'])) {
		return true;
	} else {
		return false;
	}
}

function isAdmin()
{
	if (isset($_SESSION['adviser'])) {
		return true;
	} else {
		return false;
	}
}
function loginAdviser()
{
	global $connect, $username, $errors;

	// grap form values
	$username = e($_POST['un']);
	$password = e($_POST['pw']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {

		$loginqry = "SELECT * FROM adviser WHERE username = '$username' AND password = '$password'";

		$result = $connect->query($loginqry);

		if ($result->num_rows > 0) {
			$logged_adviser = mysqli_fetch_assoc($result);
			$_SESSION['adviser'] = $logged_adviser;

			header("location:index.php");
		} else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function loginStudent()
{
	global $connect, $idnum, $errors, $logged_student;

	// grap form values
	$idnum = e($_POST['idnum']);
	$adviser = e($_POST['adviser']);

	// make sure form is filled properly
	if (empty($idnum)) {
		array_push($errors, "ID number is required");
	}
	if (empty($adviser)) {
		array_push($errors, "Enter correct details");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {

		$loginqry = "SELECT student_index, concat(lname, ', ', fname, ' ',mname, '.') AS student,
		concat(last, ', ', first, ' ', middle, '.') AS adviser
		FROM student 
		INNER JOIN adviser ON student.adviser = adviser.adviser_index
		WHERE idnum = '$idnum' AND last = '$adviser'";

		$result = $connect->query($loginqry);

		if ($result->num_rows > 0) {
			$logged_student = mysqli_fetch_assoc($result);
			$_SESSION['student'] = $logged_student;

			header("location:student_home.php");
		} else {
			array_push($errors, "Wrong username/password combination");
			header("location:student_login.php");
		}
	}
}

function studentTable() {
	global $connect, $studentrow;
	
	$qry = "SELECT DISTINCT student_index, concat(lname, ', ', fname, ' ', mname, '.') 
	AS student, concat(course, '-', yr) AS course FROM added_student
	INNER JOIN student ON student.idnum = added_student.id_num
	INNER JOIN documents ON documents.document_id = student.student_index;";
	
	echo "<table class='table mt-5'>
	<thead class='thead-light'>
	<tr>
	<th>Student Name</th>
	<th>Course & Year</th>
	<th>Documents</th>
	<th>Approval</th>
	<th>Appointment</th>
	</tr>
	</thead>
	<tbody>";
	$result = $connect->query($qry);
	while($srow = mysqli_fetch_array($result)){
		echo "<tr id='" . $srow['student_index'] . "'>";
		echo "<td>" . $srow['student'] . "</td>";
		echo "<td>" . $srow['course'] . "</td>";
		echo "<td>Submitted <a href='documents.php' class='ml-5 se-"
		. $srow['student_index'] . "'>View</a></td>";
		echo "<td>Approved</td>";
		echo "<td> <a data-role='update' data-id='" . $srow['student_index'] . "' class='btn btn-info ml-5'>Set</a></td>";
		echo "</tr>";
		

	}
	echo "</tbody";

}

function viewDocuments() {
	global $connect, $srow;
	
	$qry = "SELECT concat(lname, ', ', fname, ' ', mname, '.') 
	AS student, title, approval, document_id FROM added_student
	INNER JOIN student ON student.idnum = added_student.id_num
	INNER JOIN documents ON documents.document_id = student.student_index ORDER BY title;";
	
	echo "<table class='table mt-5'>
	<thead class='thead-light'>
	<tr>
	<th>Student Name</th>
	<th>Internship Documents</th>
	<th>Approval</th>
	</tr>
	</thead>
	<tbody>";
	$result = $connect->query($qry);
	while($srow = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $srow['student'] . "</td>";
		echo "<td>" . $srow['title'] . "</td>";
		echo "<form action='id_pr.php' method='POST'>";
		echo "<td><select name='approval' id='" . $srow['document_id'] . "' class='form-control'>
			  <option value='Approved'>Approved</option>
			  <option value='Rejected'>Rejected</option>
			  </select></td>";
		
		
	}
	echo "<tr>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><input type='submit' name='set' class='btn btn-success' value='Save'></input></td>";
		echo "</form>";
		echo "</tr>";
		echo "</tbody";

}

function approvalTable() {
	global $connect, $studentrow;
	$student = $_SESSION['student']['student_index'];
	$qry = "SELECT title, approval FROM documents
	WHERE document_id = '$student';";
	
	echo "<table class='table mt-5'>
	<thead class='thead-light'>
	<tr>
	<th>Documents</th>
	<th>Approval</th>
	</tr>
	</thead>
	<tbody>";
	$result = $connect->query($qry);
	while($srow = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $srow['title'] . "</td>";
		echo "<td>" . $srow['approval'] . "</td>";
		echo "</tr>";
		echo "</tbody";

	}

}

function appointmentTable() {
	global $connect, $studentrow;
	$student = $_SESSION['student']['student_index'];
	$qry = "SELECT month, day, year, time, venue FROM appointment
	WHERE appointment_id = '$student';";
	
	echo "<table class='table mt-5'>
	<thead class='thead-light'>
	<tr>
	<th>Month</th>
	<th>Day</th>
	<th>Year</th>
	<th>Time</th>
	<th>Venue</th>
	</tr>
	</thead>
	<tbody>";
	$result = $connect->query($qry);
	while($srow = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" . $srow['month'] . "</td>";
		echo "<td>" . $srow['day'] . "</td>";
		echo "<td>" . $srow['year'] . "</td>";
		echo "<td>" . $srow['time'] . "</td>";
		echo "<td>" . $srow['venue'] . "</td>";
		echo "</tr>";
		echo "</tbody";

	}

}

function getStudent() {
	global $connect, $studentrow;

	$idnum2 = e($_POST['id_num']);
	
	$qry = "SELECT concat(lname, ', ', fname, ' ', mname, '.') 
	AS students FROM added_student
	INNER JOIN student ON student.idnum = added_student.id_num
	INNER JOIN documents ON documents.document_id = student.student_index
	WHERE idnum = '$idnum2'";
	
	$result = $connect->query($qry);
	$studentrow = $result->fetch_assoc();
	
}

function getAppointment() {
	global $connect, $arow;
	
	$qry = "SELECT * FROM appointment;";
	
	$result = $connect->query($qry);
	$arow = $result->fetch_assoc();
	
}