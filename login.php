<?php require_once ('config/header.php'); ?>
<?php require_once ('config/functions.php'); ?>


</nav>
	<div class="card" id='dabox'>
		<div class='card-header'>
			<center>
				<h5>Adviser Login</h5>
			</center>
		</div>
		<div class='card-body'>

			<form method='POST' action='login.php'>
				<?php echo display_error() ?>
				<input type="text" class="form-control mb-1" placeholder="Username" name="un">
				<input type="password" class="form-control" placeholder="Password" name="pw">
		<center>
					<input type="submit" class="btn btn-success mt-5" value='Login' name='sub'>
					</center>
			</form>

		</div>
	</div>

<?php require_once 'config/footer.php'?>