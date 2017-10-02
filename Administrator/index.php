<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
if (isset($_SESSION['s_admin'])){
	header("Location: main.php");
}
else{
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
		include 'database_connection.php';
		include 'head.php';
		echo "<body>";
			include 'header.php';
			if (isset($_REQUEST['send'])){
				$user=$_REQUEST['name'];
				$password=$_REQUEST['password'];
				$result = mysqli_query($link, "SELECT * FROM cms_users where (id_user='$user' or email='$user') and password='$password' and id_type=1");
				if ($row = mysqli_fetch_assoc($result)){
					$_SESSION['s_admin']=$row['name'];
					header("Location: main.php");
				}
				else{
					echo "<div class='login_form'>";
						echo $S_wrong_user"<br>";
					echo "</div>";
					header( "Refresh:3; index.php");
				}
			}
			else{
				echo "<div class='login_form'>";	
					echo "<form action='index.php'>";
						echo "<fieldset>";
							echo "<legend>"$S_administrator_login"</legend>";
							echo $S_username_or_email":<br><input type='text' name='name'><br><br>";
							echo $S_password":<br><input type='passwordword' name='password'><br><br>";
							echo "<input class='boton' type='submit' name='send' value='Iniciar sesión'><br>";
						echo "</fieldset>";
					echo "</form>";
				echo "</div>";
			}
			include 'scripts.php';		
		echo "</body>";
	echo "</html>";
}
?>