<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
if (isset($_SESSION['s_usuario'])){
	header("Location: main.php");
}
else{
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
		include 'database_connection.php';
		include 'head.php';
		echo "<body>";
			include 'header.php';
			if (isset($_REQUEST['Enviar'])){
				$usu=$_REQUEST['nombre'];
				$pass=$_REQUEST['pass'];
				$result = mysqli_query($link, "SELECT * FROM cms_usuarios where (id_usuario='$usu' or email='$usu') and contraseña='$pass'");
				if ($row = mysqli_fetch_assoc($result)){
					$_SESSION['s_usuario']=$row['id_usuario'];
					header("Location: main.php");
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Usuario incorrecto <br><br>";
						echo "<a href='index.php'>volver a intentarlo</a>";
					echo "</div>";
				}
			}
			else{
				echo "<div class='formulario_inicio_sesion'>";	
					echo "<form action='index.php'>";
						echo "<fieldset>";
							echo "<legend>INICIA SESIÓN</legend>";
							echo "Usuario o Email:<br><input type='text' name='nombre'><br><br>";
							echo "Contraseña:<br><input type='password' name='pass'><br><br>";
							echo "<input class='boton' type='submit' name='Enviar' value='Iniciar sesión'><br>";
						echo "</fieldset>";
					echo "</form>";
				echo "</div>";
				echo "<div class='container_registrarse'>";
					echo "<a href='sign_up.php'><div class='registrarse'>";
						echo "Regístrate aquí";
					echo "</div></a>";
				echo "</div>";
			}
			include 'scripts.php';
		echo "</body>";
	echo "</html>";
}
?>