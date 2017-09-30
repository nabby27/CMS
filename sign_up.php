<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

if (isset($_REQUEST['send'])){
	$user=$_REQUEST['user'];
	$name=$_REQUEST['name'];
	$surname=$_REQUEST['surname'];
	$email=$_REQUEST['email'];
	$telephon=$_REQUEST['telephon'];
	$address=$_REQUEST['address'];
	$contraseña=$_REQUEST['contraseña'];
	$contraseña2=$_REQUEST['contraseña2'];
	if($contraseña==$contraseña2){
		if(empty($telephon)){
			$cond="INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', '', '".$address."', ".$contraseña.", 2, ".$id_show_company.")";
		}
		else{
			$cond="INSERT into cms_users VALUES ('".$user."', '".$name."', '".$surname."', '".$email."', ".$telephon.", '".$address."', ".$contraseña.", 2, ".$id_show_company.")";
		}
		if ($result = mysqli_query($link, $cond)){
			$_SESSION['s_user']=$user;
			echo "<div class='login_form'>";
				echo "Usuario $user registrado correctamente"."<br><br>";
				echo "<a href='index.php'>Iniciar sesión</a>";
			echo "</div>";
		}
		else{
			echo "<div class='login_form'>";
				echo "Fallo al registrar el ususario"."<br><br>";
				echo "<a href='sign_up.php'>Volver a intentarlo</a>";
			echo "</div>";
		}
	}
	else{
		echo "<div class='login_form'>";
			echo "La contraseña no coincide"."<br><br>";
			echo "<a href='sign_up.php'>Volver a intentarlo</a>";
		echo "</div>";
	}
}
else{
	echo "<!DOCTYPE html>";
	echo "<html lang='en'>";
		include 'database_connection.php';
		include 'functions.php';
		include 'head.php';
		echo "<body>";
			include 'header.php';
			echo "<div class='container_sign_up'>";
				echo "<a href='index.php'><div class='sign_up'>";
					echo "Inciar sesión";
				echo "</div></a>";
			echo "</div>";
			echo "<div class='login_form'>";	
				echo "<form action='sign_up.php'>";
					echo "REGÍSTRATE"."<br><br>";
					echo "<fieldset>";
						echo "<legend>Datos personales</legend>";
						echo "name*:<br><input type='text' name='name' placeholder='name' required><br><br>";
						echo "surname:<br><input type='text' name='surname' placeholder='surname'><br><br>";
						echo "Email*:<br><input type='text' name='email' placeholder='email' pattern='[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}' required><br><br>";
						echo "Teléfono:<br><input type='number' name='telephon' placeholder='teléfono'><br><br>";
						echo "Dirección:<br><input type='text' name='address' placeholder='dirección'><br><br>";
					echo "</fieldset>";
					echo "<fieldset>";
						echo "<legend>Datos de la cuenta</legend>";
						echo "Usuario*:<br><input type='text' name='user' placeholder='name de usuario' required><br><br>";
						echo "Contraseña*:<br><input type='contraseñaword' name='contraseña' placeholder='contraseña' pattern='[a-zA-Z0-9_]{5,16}' required><br><br>";
						echo "Repita la contraseña*:<br><input type='contraseñaword' name='contraseña2' placeholder='contraseña' required><br><br>";
					echo "</fieldset><br><br>";
					echo "<input class='boton' type='submit' name='Enviar' value='sign_up'><br><br>";
					echo "* Campos obligatorios";
				echo "</form>";
			echo "</div>";
		echo "</body>";
	echo "</html>";
}
?>