<?php require_once 'config/functions.php' ?>

<?php require_once 'config/header.php'?>
</nav>
	<div class="card" id='dabox'>
		<div class='card-header'>
			<center>
				<h5>Student Login</h5>
			</center>
		</div>
		<div class='card-body'>

			<form action='student_login.php' method='POST'>
				<?php echo display_error() ?>
				<input type="text" class="form-control text-center mt-4" placeholder="ID Number" name="idnum">
				<input type="text" class="form-control text-center mt-2" placeholder="Advisor Last Name" name="adviser">
		<center>
					<input type="submit" class="btn btn-success mt-4" value='Login' name='subm'>
					</center>
			</form>

		</div>
	</div>

<?php require_once 'config/footer.php'?>