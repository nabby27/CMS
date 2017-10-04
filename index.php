<!--***********************************************************************************-->
<!--************created by Iván Córdoba Donet ivancordoba77@gmail.com******************-->
<!--***********************************************************************************-->

<?php
session_start();
if (isset($_SESSION['s_user'])){
	header('Location: main.php');
}
else{
?>
	<!DOCTYPE html>
	<html lang='en'>
		<?php
		include 'database_connection.php';
		include 'head.php';
		?>
		<body>
			<?php
			include 'header.php';
			if (isset($_POST['send'])){
				$user=$_POST['name'];
				$password=$_POST['password'];
				$cond = "SELECT id_user FROM cms_users where (id_user='$user' or email='$user') and password=$password";
				$result = mysqli_query($link, $cond);
				if ($row = mysqli_fetch_assoc($result)){
					$_SESSION['s_user']=$row['id_user'];
					header('Location: main.php');
				}
				else{
			?>		
					<div class='login_form'>
						<?= $S_wrong_user ; ?>
						<br><br>
						<a href='index.php'><?= $S_try_again ; ?></a>
					</div>
				<?php
				}
			}
			else{
				?>
				<div class='login_form'>	
					<form action='index.php' method='post'>
						<fieldset>
							<legend><?= $S_log_in ; ?></legend>
							<?= $S_username_or_email ; ?>: <br><input type='text' name='name'><br><br>
							<?= $S_password ?>:<br><input type='password' name='password'><br><br>
							<?= "<input class='button' type='submit' name='send' value='$S_log_in'><br>"; ?>
						</fieldset>
					</form>
				</div>
				<div class='container_sign_up'>
					<a href='sign_up.php'><div class='sign_up'>
						<?= $S_sign_up_here ; ?>
					</div></a>
				</div>
			<?php	
			}
			include 'scripts.php';
			?>
		</body>
	</html>
<?php } ?>