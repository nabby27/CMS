<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

include 'database_connection.php';
include 'functions.php';
include 'head.php';
include 'header.php';
if (isset($_REQUEST['Enviar'])){
	$usuario=$_REQUEST['usuario'];
	$nombre=$_REQUEST['nombre'];
	$apellidos=$_REQUEST['apellidos'];
	$email=$_REQUEST['email'];
	$telefono=$_REQUEST['telefono'];
	$direccion=$_REQUEST['direccion'];
	$pass=$_REQUEST['pass'];
	$pass2=$_REQUEST['pass2'];
	if($pass==$pass2){
		if(empty($telefono)){
			$cond="INSERT into cms_usuarios VALUES ('".$usuario."', '".$nombre."', '".$apellidos."', '".$email."', '', '".$direccion."', ".$pass.", 2, ".$id_empresa_a_mostrar.")";
		}
		else{
			$cond="INSERT into cms_usuarios VALUES ('".$usuario."', '".$nombre."', '".$apellidos."', '".$email."', ".$telefono.", '".$direccion."', ".$pass.", 2, ".$id_empresa_a_mostrar.")";
		}
		if ($result = mysqli_query($link, $cond)){
			$_SESSION['s_usuario']=$usuario;
			echo "<div class='formulario_inicio_sesion'>";
				echo "Usuario $usuario registrado correctamente"."<br><br>";
				echo "<a href='index.php'>Iniciar sesión</a>";
			echo "</div>";
		}
		else{
			echo "<div class='formulario_inicio_sesion'>";
				echo "Fallo al registrar el ususario"."<br><br>";
				echo "<a href='sign_up.php'>Volver a intentarlo</a>";
			echo "</div>";
		}
	}
	else{
		echo "<div class='formulario_inicio_sesion'>";
			echo "La contraseña no coincide"."<br><br>";
			echo "<a href='sign_up.php'>Volver a intentarlo</a>";
		echo "</div>";
	}
}
else{
	echo "<div class='container_sign_up'>";
		echo "<a href='index.php'><div class='sign_up'>";
			echo "Inciar sesión";
		echo "</div></a>";
	echo "</div>";
	echo "<div class='formulario_inicio_sesion'>";	
		echo "<form action='sign_up.php'>";
			echo "REGÍSTRATE"."<br><br>";
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
				echo "Contraseña*:<br><input type='password' name='pass' placeholder='contraseña' pattern='[a-zA-Z0-9_]{5,16}' required><br><br>";
				echo "Repita la contraseña*:<br><input type='password' name='pass2' placeholder='contraseña' required><br><br>";
			echo "</fieldset><br><br>";
			echo "<input class='boton' type='submit' name='Enviar' value='sign_up'><br><br>";
			echo "* Campos obligatorios";
		echo "</form>";
	echo "</div>";
}
?>