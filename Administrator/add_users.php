<?php
session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='main.php'>".$S_home."</a></li>";
					echo "<li><a href='users.php'>".$S_back."</a></li>";
				echo "</ul>";
			echo "</nav>";
			if(isset($_REQUEST['send'])){
				$id_user=$_REQUEST['user'];
				$name=$_REQUEST['name'];
				$surname=$_REQUEST['surname'];
				$email=$_REQUEST['email'];
				$telephon=$_REQUEST['telephon'];
				$address=$_REQUEST['address'];
				$password=$_REQUEST['password'];
				$password2=$_REQUEST['password2'];
				if ($password==$password2){
					if ($result = mysqli_query($link, "INSERT into cms_users VALUES (".$id_user.", ".$name.", ".$surname.", ".$email.", ".$telephon.", ".$address.", ".$password.", 2, ".$id_empresa_a_mostrar.")")){
						header("Location: users.php");
					}
				}
				else{
					echo "<div class='login_form'>";
						echo $S_password_does_not_matc."<br><br>";
						echo "<a href='add_users.php'>".$S_try_again."</a>";
					echo "</div>";
				}
			}
			else{
				echo "<div class='login_form'>";	
					echo "<form action='add_users.php'>";
						echo $S_add_user."<br><br>";
						echo "<fieldset>";
							echo "<legend>".$S_personal_data."</legend>";
							echo $S_name."*:<br><input type='text' name='name' placeholder=".$S_name." required><br><br>";
							echo $S_surname.":<br><input type='text' name='surname' placeholder=".$S_surname."><br><br>";
							echo $S_email."*:<br><input type='text' name='email' placeholder=".$S_email." pattern='[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}' required><br><br>";
							echo $S_telephon.":<br><input type='number' name='telephon' placeholder=".$S_telephon."><br><br>";
							echo $S_address.":<br><input type='text' name='address' placeholder=".$S_address."><br><br>";
						echo "</fieldset>";
						echo "<fieldset>";
							echo "<legend>".$S_account_data."</legend>";
							echo $S_username."*:<br><input type='text' name='user' placeholder=".$S_username." required><br><br>";
							echo $S_password."*:<br><input type='password' name='password' placeholder=".$S_password." pattern='[a-zA-Z0-9]{5,16}' required><br><br>";
							echo $S_repeat_password."*:<br><input type='password' name='password2' placeholder=".$S_password." required><br><br>";
						echo "</fieldset><br><br>";
						echo "<input class='boton' type='submit' name='send' value=".$S_sign_up."><br><br>";
						echo "* ".$S_required_fields;
					echo "</form>";
				echo "</div>";
			}
		}
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>