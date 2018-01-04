<?php
include 'head.php';
if (isset($_POST['send'])){
	include 'header.php';
	$user = $_POST['user'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$telephon = $_POST['telephon'];
	$address = $_POST['address'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	if ($password==$password2){
		if (empty($telephon)){
			$cond = "INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', '', '".$address."', ".$password.", 2, ".$id_show_company.")";
		}
		else{
			$cond = "INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', ".$telephon.", '".$address."', ".$password.", 2, ".$id_show_company.")";
		}
		if ($result = mysqli_query($link, $cond)){
			$_SESSION['s_user']=$user;
			echo '<div class="login_form">';
				echo $S_registered_user_correctly.' '.$user.'<br><br>';
				echo '<a href="./index.php">'.$S_log_in.'</a>';
			echo '</div>';
		}
		else{
			echo '<div class="login_form">';
				echo $S_failed_to_register_user.'<br><br>';
				echo '<a href="sign_up.php">'.$S_try_again.'</a>';
			echo '</div>';
		}
	}
	else{
		echo '<div class="login_form">';
			echo $S_password_does_not_match.'<br><br>';
			echo '<a href="sign_up.php">'.$S_try_again.'</a>';
		echo '</div>';
	}
}
else{
	echo '<!DOCTYPE html>';
	echo '<html lang="en">';
		echo '<body>';
			include 'header.php';
			echo '<div class="container_sign_up">';
				echo '<a href="../index.php">';
					echo '<div class="sign_up">';
						echo $S_log_in;
					echo '</div>';
				echo '</a>';
			echo '</div>';
			echo '<div class="login_form">';
				echo '<form action="sign_up.php" method="post">';
					echo $S_sign_up.'<br><br>';
					echo '<fieldset>';
						echo '<legend>'.$S_personal_data.'</legend>';
						echo $S_name."*:<br><input type='text' name='name' placeholder='".$S_name."' required><br><br>";
						echo $S_surname.":<br><input type='text' name='surname' placeholder='".$S_surname."'><br><br>";
						echo $S_email."*:<br><input type='email' name='email' placeholder='".$S_email."' required><br><br>";
						echo $S_telephon.":<br><input type='number' name='telephon' placeholder='".$S_telephon."'><br><br>";
						echo $S_address.":<br><input type='text' name='address' placeholder='".$S_address."'><br><br>";
					echo '</fieldset>';
					echo '<fieldset>';
						echo '<legend>'.$S_account_data.'</legend>';
						echo $S_user."*:<br><input type='text' name='user' placeholder='".$S_username."' required><br><br>";
						echo $S_password."*:<br><input type='password' name='password' placeholder='".$S_password."' pattern='[a-zA-Z0-9_]{5,16}' required><br><br>";
						echo $S_repeat_password."*:<br><input type='password' name='password2' placeholder='".$S_password."' required><br><br>";
					echo '</fieldset>';
					echo '<br><br>';
					echo "<input class='boton' type='submit' name='send' value='".$S_sign_up."'><br><br>";
					echo '*'.$S_required_fields;
				echo '</form>';
			echo '</div>';
			include 'scripts.php';
		echo '</body>';
	echo '</html>';
}
?>
