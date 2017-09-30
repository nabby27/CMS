<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
if (isset($_SESSION['s_admin'])){
	header("Location: main.php");
}
else{
	include 'database_connection.php';
	include 'head.php';
	include 'header.php';
	if (isset($_REQUEST['Enviar'])){
		$usu=$_REQUEST['nombre'];
		$pass=$_REQUEST['pass'];
		$result = mysqli_query($link, "SELECT * FROM cms_usuarios where (id_usuario='$usu' or email='$usu') and contraseña='$pass' and id_tipo=1");
		if ($row = mysqli_fetch_assoc($result)){
			$_SESSION['s_admin']=$row['nombre'];
			header("Location: main.php");
		}
		else{
			echo "<div class='formulario_inicio_sesion'>";
				echo "Usuario incorrecto <br>";
			echo "</div>";
			header( "Refresh:3; index.php");
		}
	}
	else{
		echo "<div class='formulario_inicio_sesion'>";	
			echo "<form action='index.php'>";
				echo "<fieldset>";
					echo "<legend>INICIA SESION DE ADMINISTRADOR</legend>";
					echo "Ususario o Email:<br><input type='text' name='nombre'><br><br>";
					echo "Contraseña:<br><input type='password' name='pass'><br><br>";
					echo "<input class='boton' type='submit' name='Enviar' value='Iniciar sesión'><br>";
				echo "</fieldset>";
			echo "</form>";
		echo "</div>";
	}
}
?>