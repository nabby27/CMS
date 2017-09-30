<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='main.php'>INICIO</a></li>";
					echo "<li><a href='users.php'>ATRAS</a></li>";
				echo "</ul>";
			echo "</nav>";
			if(isset($_REQUEST['Enviar'])){
				$id_usuario=$_REQUEST['usuario'];
				$nombre=$_REQUEST['nombre'];
				$apellidos=$_REQUEST['apellidos'];
				$email=$_REQUEST['email'];
				$telefono=$_REQUEST['telefono'];
				$direccion=$_REQUEST['direccion'];
				$pass=$_REQUEST['pass'];
				$pass2=$_REQUEST['pass2'];
				if ($pass==$pass2){
					$cond="INSERT into cms_usuarios VALUES (".$id_usuario.", ".$nombre.", ".$apellidos.", ".$email.", ".$telefono.", ".$direccion.", ".$pass.", 2, ".$id_empresa_a_mostrar.")";
					if ($result = mysqli_query($link, $cond)){
						header("Location: users.php");
					}
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "La contraseña no coincide"."<br><br>";
						echo "<a href='add_users.php'>Volver a intentarlo</a>";
					echo "</div>";
				}
			}
			else{
				echo "<div class='formulario_inicio_sesion'>";	
					echo "<form action='add_users.php'>";
						echo "AÑADE USUARIO"."<br><br>";
						echo "<fieldset>";
							echo "<legend>Datos personales</legend>";
							echo "Nombre*:<br><input type='text' name='nombre' placeholder='nombre' required><br><br>";
							echo "Apellidos:<br><input type='text' name='apellidos' placeholder='apellidos'><br><br>";
							echo "Email*:<br><input type='text' name='email' placeholder='email' pattern='[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}' required><br><br>";
							echo "Teléfono:<br><input type='number' name='telefono' placeholder='teléfono'><br><br>";
							echo "Dirección:<br><input type='text' name='direccion' placeholder='dirección'><br><br>";
						echo "</fieldset>";
						echo "<fieldset>";
							echo "<legend>Datos de la cuenta</legend>";
							echo "Usuario*:<br><input type='text' name='usuario' placeholder='nombre de usuario' required><br><br>";
							echo "Contraseña*:<br><input type='password' name='pass' placeholder='contraseña' pattern='[a-zA-Z0-9]{5,16}' required><br><br>";
							echo "Repita la contraseña*:<br><input type='password' name='pass2' placeholder='contraseña' required><br><br>";
						echo "</fieldset><br><br>";
						echo "<input class='boton' type='submit' name='Enviar' value='Registrarse'><br><br>";
						echo "* Campos obligatorios";
					echo "</form>";
				echo "</div>";
			}
		}
		else{
			header("Location: index.php");
		}
	echo "</body>";
echo "</html>";
?>