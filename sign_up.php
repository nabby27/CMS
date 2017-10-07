<!--***********************************************************************************-->
<!--************created by Iván Córdoba Donet ivancordoba77@gmail.com******************-->
<!--***********************************************************************************-->

<?php
include 'database_connection.php';
include 'functions.php';
include 'head.php';
if (isset($_POST['send'])){
	$user=$_POST['user'];
	$name=$_POST['name'];
	$surname=$_POST['surname'];
	$email=$_POST['email'];
	$telephon=$_POST['telephon'];
	$address=$_POST['address'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];
	if($password==$password2){
		if(empty($telephon)){
			$cond="INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', '', '".$address."', ".$password.", 2, ".$id_show_company.")";
		}
		else{
			$cond="INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', ".$telephon.", '".$address."', ".$password.", 2, ".$id_show_company.")";
		}
		if ($result = mysqli_query($link, $cond)){
			$_SESSION['s_user']=$user;
?>
			<div class='login_form'>
				<?=	$S_registered_user_correctly.' '.$user.'<br><br>'; ?>
				<?= "<a href='index.php'>".$S_log_in.'</a>'; ?>
			</div>
		<?php
		}
		else{
		?>	
			<div class='login_form'>
				<?= $S_failed_to_register_user.'<br><br>'; ?>
				<?= "<a href='sign_up.php'>".$S_try_again.'</a>'; ?>
			</div>
		<?php
		}
	}
	else{
	?>
		<div class='login_form'>
			<?= $S_password_does_not_match.'<br><br>'; ?>
			<?= "<a href='sign_up.php'>".$S_try_again.'</a>'; ?>
		</div>
	<?php	
	}
}
else{
?>
	<!DOCTYPE html>
	<html lang='en'>
		<body>
			<?php include 'header.php'; ?>
			<div class='container_sign_up'>
				<a href='index.php'><div class='sign_up'>
					<?= $S_log_in; ?>
				</div></a>
			</div>
			<div class='login_form'>
				<form action='sign_up.php' method='post'>
					<?= $S_sign_up.'<br><br>'; ?>
					<fieldset>
						<?= '<legend>'.$S_personal_data.'</legend>'; ?>
						<?= $S_name."*:<br><input type='text' name='name' placeholder='".$S_name."' required><br><br>"; ?>
						<?= $S_surname.":<br><input type='text' name='surname' placeholder='".$S_surname."'><br><br>"; ?>
						<?= $S_email."*:<br><input type='text' name='email' placeholder='".$S_email."' pattern='[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}' required><br><br>"; ?>
						<?= $S_telephon.":<br><input type='number' name='telephon' placeholder='".$S_telephon."'><br><br>"; ?>
						<?= $S_address.":<br><input type='text' name='address' placeholder='".$S_address."'><br><br>"; ?>
					</fieldset>
					<fieldset>
						<?= '<legend>'.$S_account_data.'</legend>'; ?>
						<?= $S_user."*:<br><input type='text' name='user' placeholder='".$S_username."' required><br><br>"; ?>
						<?= $S_password."*:<br><input type='password' name='password' placeholder='".$S_password."' pattern='[a-zA-Z0-9_]{5,16}' required><br><br>"; ?>
						<?= $S_repeat_password."*:<br><input type='password' name='password2' placeholder='".$S_password."' required><br><br>"; ?>
					</fieldset><br><br>
					<?= "<input class='boton' type='submit' name='send' value='".$S_sign_up."'><br><br>"; ?>
					<?= '*'.$S_required_fields; ?>
				</form>
			</div>
			<?php
			include 'scripts.php';
			?>
		</body>
	</html>
<?php	
}
?>