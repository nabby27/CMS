<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

include 'database_connection.php';
include 'functions.php';
include 'head.php';
include 'header.php';
if (isset($_REQUEST['send'])){
	$user=$_REQUEST['user'];
	$name=$_REQUEST['name'];
	$surname=$_REQUEST['surname'];
	$email=$_REQUEST['email'];
	$telephon=$_REQUEST['telephon'];
	$address=$_REQUEST['address'];
	$password=$_REQUEST['password'];
	$password2=$_REQUEST['password2'];
	if($password==$password2){
		if(empty($telephon)){
			$cond="INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', '', '".$address."', ".$password.", 2, ".$id_show_company.")";
		}
		else{
			$cond="INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', ".$telephon.", '".$address."', ".$password.", 2, ".$id_show_company.")";
		}
		if ($result = mysqli_query($link, $cond)){
			$_SESSION['s_user']=$user;
			echo "<div class='login_form'>";
				echo $S_registered_user_correctly "$user"."<br><br>";
				echo "<a href='index.php'>"$S_log_in"</a>";
			echo "</div>";
		}
		else{
			echo "<div class='login_form'>";
				echo $S_failed_to_register_user"<br><br>";
				echo "<a href='sign_up.php'>"$S_try_again"</a>";
			echo "</div>";
		}
	}
	else{
		echo "<div class='login_form'>";
			echo $S_password_does_not_match"<br><br>";
			echo "<a href='sign_up.php'>"$S_try_again"</a>";
		echo "</div>";
	}
}
else{
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
		echo "<body>";
			echo "<div class='container_sign_up'>";
				echo "<a href='index.php'><div class='sign_up'>";
					echo $S_log_in;
				echo "</div></a>";
			echo "</div>";
			echo "<div class='login_form'>";	
				echo "<form action='sign_up.php'>";
					echo $S_sign_up"<br><br>";
					echo "<fieldset>";
						echo "<legend>"$S_personal_information"</legend>";
						echo $S_name"*:<br><input type='text' name='name' placeholder="$S_name" required><br><br>";
						echo $S_surname":<br><input type='text' name='surname' placeholder="$S_surname"><br><br>";
						echo $S_email"*:<br><input type='text' name='email' placeholder="$S_email" pattern='[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}' required><br><br>";
						echo $S_telephon":<br><input type='number' name='telephon' placeholder="$S_telephon"><br><br>";
						echo $S_address":<br><input type='text' name='address' placeholder="$S_address"><br><br>";
					echo "</fieldset>";
					echo "<fieldset>";
						echo "<legend>"$S_account_data"</legend>";
						echo $S_user"*:<br><input type='text' name='user' placeholder="$S_username" required><br><br>";
						echo $S_password"*:<br><input type='password' name='password' placeholder="$S_password" pattern='[a-zA-Z0-9_]{5,16}' required><br><br>";
						echo $S_repeat_password"*:<br><input type='password' name='password2' placeholder="$S_password" required><br><br>";
					echo "</fieldset><br><br>";
					echo "<input class='boton' type='submit' name='send' value="$S_sign_up"><br><br>";
					echo "*"$S_required_fields;
				echo "</form>";
			echo "</div>";
		echo "</body>";
	echo "</html>";
}
?>