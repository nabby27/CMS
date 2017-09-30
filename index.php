<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
if (isset($_SESSION['s_user'])){
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
				$result = mysqli_query($link, "SELECT * FROM cms_users where (id_user='$user' or email='$user') and password='$password'");
				if ($row = mysqli_fetch_assoc($result)){
					$_SESSION['s_user']=$row['id_user'];
					header("Location: main.php");
				}
				else{
					echo "<div class='login_form'>";
						echo "Usuario incorrecto <br><br>";
						echo "<a href='index.php'>volver a intentarlo</a>";
					echo "</div>";
				}
			}
			else{
				echo "<div class='login_form'>";	
					echo "<form action='index.php'>";
						echo "<fieldset>";
							echo "<legend>INICIA SESIÓN</legend>";
							echo "Usuario o Email:<br><input type='text' name='name'><br><br>";
							echo "Contraseña:<br><input type='passwordword' name='password'><br><br>";
							echo "<input class='boton' type='submit' name='Enviar' value='Iniciar sesión'><br>";
						echo "</fieldset>";
					echo "</form>";
				echo "</div>";
				echo "<div class='container_sign_up'>";
					echo "<a href='sign_up.php'><div class='sign_up'>";
						echo "Regístrate aquí";
					echo "</div></a>";
				echo "</div>";
			}
			include 'scripts.php';
		echo "</body>";
	echo "</html>";
}
?>