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
			if (isset($_REQUEST['enviar'])){
				$id_usuario=$_REQUEST['id_usuario'];
				$nombre=$_REQUEST['nombre'];
				$apellidos=$_REQUEST['apellidos'];
				$email=$_REQUEST['email'];
				$telefono=$_REQUEST['telefono'];
				$direccion=$_REQUEST['direccion'];
				$pass=$_REQUEST['pass'];
				$pass2=$_REQUEST['pass2'];
				if($pass==$pass2){
					$cond="UPDATE cms_usuarios set nombre='".$nombre."', apellido='".$apellidos."', email='".$email."', telefono=".$telefono.", direccion='".$direccion."', contraseña='".$pass."', id_empresa=".$id_empresa_a_mostrar." where id_usuario='".$id_usuario."'";
					echo $cond;
					if ($result = mysqli_query($link, $cond)){
						header("Location: users.php");
					}
				}
				else{
					echo "<div class='formulario_inicio_sesion'>";
						echo "Rellene los campos obligatorios<br>";
						echo "<a href='users.php?id_usuario='".$id_usuario."''>ATRAS</a>";
					echo "</div>";
				}
			}
			elseif(isset($_REQUEST['id_usuario'])){
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='main.php'>INICIO</a></li>";
						echo "<li><a href='users.php'>ATRAS</a></li>";
					echo "</ul>";
				echo "</nav>";
				$id_usuario=$_REQUEST['id_usuario'];
				$cond="SELECT * from cms_usuarios where id_usuario='".$id_usuario."'";
				$result= mysqli_query($link, $cond);
				$row=mysqli_fetch_assoc($result);
				echo "<div class='formulario_inicio_sesion'>";	
					echo "<form action='users.php'>";
						echo "ACTUALIZA USUARIO"."<br><br>";
						echo "<fieldset>";
						echo "<legend>Datos personales</legend>";
						echo "Nombre*:<br><input type='text' name='nombre' placeholder='nombre' value='".$row['nombre']."' required><br><br>";
						echo "Apellidos:<br><input type='text' name='apellidos' placeholder='apellidos' value='".$row['apellido']."'><br><br>";
						echo "Email*:<br><input type='text' name='email' placeholder='email' pattern='[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}' value=".$row['email']." required><br><br>";
						echo "Teléfono:<br><input type='number' name='telefono' placeholder='teléfono' value=".$row['telefono']."><br><br>";
						echo "Dirección:<br><input type='text' name='direccion' placeholder='dirección' value='".$row['direccion']."'><br><br>";
					echo "</fieldset>";
					echo "<fieldset>";
						echo "<legend>Datos de la cuenta</legend>";
						echo "Usuario*:<br>".$row['id_usuario']."<br><br>";
						echo "Contraseña*:<br><input type='password' name='pass' placeholder='contraseña' pattern='[a-zA-Z0-9]{5,16}' value=".$row['contraseña']." required><br><br>";
						echo "Repita la contraseña*:<br><input type='password' name='pass2' placeholder='contraseña' value=".$row['contraseña']." required><br><br>";
					echo "</fieldset><br><br>";
					echo "<input class='boton' type='submit' name='enviar' value='Actualizar'><br><br>";
					echo "<input type='hidden' name='id_usuario' value='".$row['id_usuario']."'>";
					echo "* Campos obligatorios";
				echo "</form>";
			echo "</div>";
			}
			else{
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='main.php'>INICIO</a></li>";
						echo "<li><a href='add_users.php'>AÑADIR</a></li>";
					echo "</ul>";
				echo "</nav>";
				$contador=0;
				$cond="SELECT * from cms_usuarios, cms_tipo_usuario where cms_usuarios.id_tipo=cms_tipo_usuario.id_tipo";
				$result=mysqli_query($link, $cond);
				echo "<table border=1>";
				echo "<tr><td>Usuario</td><td>Nombre</td><td>Apellidos</td><td>Email</td><td>Teléfono</td><td>Dirección</td><td>Contraseña</td><td>Tipo</td><td>Editar</td><td>Borrar</td></tr>";
				while($row=mysqli_fetch_assoc($result)){
					$contador+=1;
					if ($contador%2==0){
   						$clase='par';
					}
					else{
   						$clase='impar';
					}
					echo "<tr class=".$clase.">";
					echo "<td>".$row['id_usuario']."</td>";
					echo "<td>".$row['nombre']."</td>";
					echo "<td>".$row['apellido']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td>".$row['telefono']."</td>";
					echo "<td>".$row['direccion']."</td>";
					echo "<td>*****</td>";
					echo "<td>".$row['tipo_usuario']."</td>";
					echo "<td>";
						echo "<div class='lapiz2'>";
							echo "<a width='0px' href='users.php?id_usuario=".$row['id_usuario']."'>";
								echo "<div class='icon-pencil2'></div>";
							echo "</a>";
						echo "</div>";
					echo "</td>";
					echo "<td>";
						if($row['id_tipo']!=1){
							echo "<div class='papelera2'>";
								echo "<a width='0px' href='delete.php?id_usuario=".$row['id_usuario']."'>";
									echo "<div class='icon-basura'></div>";
								echo "</a>";
							echo "</div>";
						}
					echo "</td>";
					echo "</tr>";
				}	
			}
			echo "</table>";
		}	
		else{
			header("Location: index.php");
		}	
	echo "</body>";
echo "</html>";
?>