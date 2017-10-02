<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include '../strings_es.php';
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='main.php'>"$S_home"</a></li>";
					echo "<li><a href='users.php'>"$S_back"</a></li>";
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
						echo "La contraseña no coincide"."<br><br>";
						echo "<a href='add_users.php'>Volver a intentarlo</a>";
					echo "</div>";
				}
			}
			else{
				echo "<div class='login_form'>";	
					echo "<form action='add_users.php'>";
						echo "AÑADE USUARIO"."<br><br>";
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
							echo "user*:<br><input type='text' name='user' placeholder='name de user' required><br><br>";
							echo "Contraseña*:<br><input type='password' name='password' placeholder='password' pattern='[a-zA-Z0-9]{5,16}' required><br><br>";
							echo "Repita la contraseña*:<br><input type='password' name='password2' placeholder='password' required><br><br>";
						echo "</fieldset><br><br>";
						echo "<input class='boton' type='submit' name='send' value="$S_sign_up"><br><br>";
						echo "* Campos obligatorios";
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