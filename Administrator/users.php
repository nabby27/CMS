<?php
/*--------------------------------------------------------------------------------------*/
/*----------------created by Iván Córdoba Donet ivancordoba77@gmail.com-----------------*/
/*--------------------------------------------------------------------------------------*/

session_start();
echo "<!DOCTYPE html>";
echo "<html lang='en'>";
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	echo "<body>";
		include 'header.php';
		if (isset($_SESSION['s_admin'])){
			if (isset($_REQUEST['send'])){
				$id_user=$_REQUEST['id_user'];
				$name=$_REQUEST['name'];
				$surname=$_REQUEST['surname'];
				$email=$_REQUEST['email'];
				$telephon=$_REQUEST['telephon'];
				$address=$_REQUEST['address'];
				$password=$_REQUEST['password'];
				$password2=$_REQUEST['password2'];
				if($password==$password2){
					if ($result = mysqli_query($link, "UPDATE cms_users set name='".$name."', surname='".$surname."', email='".$email."', telephon=".$telephon.", address='".$address."', contraseña='".$password."', id_empresa=".$id_empresa_a_mostrar." where id_user='".$id_user."'")){
						header("Location: users.php");
					}
				}
				else{
					echo "<div class='login_form'>";
						echo $S_password_does_not_match"<br>";
						echo "<a href='users.php?id_user='".$id_user."''>"$S_back"</a>";
					echo "</div>";
				}
			}
			elseif(isset($_REQUEST['id_user'])){
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='main.php'>"$S_home"</a></li>";
						echo "<li><a href='users.php'>"$S_back"</a></li>";
					echo "</ul>";
				echo "</nav>";
				$id_user=$_REQUEST['id_user'];
				$result= mysqli_query($link, "SELECT * from cms_users where id_user='".$id_user."'");
				$row=mysqli_fetch_assoc($result);
				echo "<div class='login_form'>";	
					echo "<form action='users.php'>";
						echo $S_update_users"<br><br>";
						echo "<fieldset>";
						echo "<legend>"$S_personal_data"</legend>";
						echo $S_name"*:<br><input type='text' name='name' placeholder="$S_name" value='".$row['name']."' required><br><br>";
						echo $S_surname":<br><input type='text' name='surname' placeholder="$S_surname" value='".$row['surname']."'><br><br>";
						echo $S_email"*:<br><input type='text' name='email' placeholder="$S_email" pattern='[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}' value=".$row['email']." required><br><br>";
						echo $S_telephon":<br><input type='number' name='telephon' placeholder="$S_telephon" value=".$row['telephon']."><br><br>";
						echo $S_address":<br><input type='text' name='address' placeholder="$S_address" value='".$row['address']."'><br><br>";
					echo "</fieldset>";
					echo "<fieldset>";
						echo "<legend>"$S_account_data"</legend>";
						echo $S_username"*:<br>".$row['id_user']."<br><br>";
						echo $S_password"*:<br><input type='password' name='password' placeholder="$S_password" pattern='[a-zA-Z0-9]{5,16}' value=".$row['contraseña']." required><br><br>";
						echo $S_repeat_password"*:<br><input type='password' name='password2' placeholder="$S_password" value=".$row['contraseña']." required><br><br>";
					echo "</fieldset><br><br>";
					echo "<input class='boton' type='submit' name='send' value="$S_update"><br><br>";
					echo "<input type='hidden' name='id_user' value='".$row['id_user']."'>";
					echo "* "$S_required_fields;
				echo "</form>";
			echo "</div>";
			}
			else{
				echo "<nav>";
					echo "<ul>";
						echo "<li><a href='main.php'>"$S_home"</a></li>";
						echo "<li><a href='add_users.php'>"$S_add"</a></li>";
					echo "</ul>";
				echo "</nav>";
				$contador=0;
				$result=mysqli_query($link, "SELECT * from cms_users, cms_type_user where cms_users.id_type=cms_type_user.id_type");
				echo "<table border=1>";
				echo "<tr><td>"$S_user"</td><td>"$S_name"</td><td>"$S_surname"</td><td>"$S_email"</td><td>"$S_telephon"</td><td>"$S_address"</td><td>"$S_password"</td><td>"$S_type"</td><td>"$S_edit"</td><td>"$S_edit"</td></tr>";
				while($row=mysqli_fetch_assoc($result)){
					$contador+=1;
					if ($contador%2==0){
   						$clase='par';
					}
					else{
   						$clase='impar';
					}
					echo "<tr class=".$clase.">";
					echo "<td>".$row['id_user']."</td>";
					echo "<td>".$row['name']."</td>";
					echo "<td>".$row['surname']."</td>";
					echo "<td>".$row['email']."</td>";
					echo "<td>".$row['telephon']."</td>";
					echo "<td>".$row['address']."</td>";
					echo "<td>*****</td>";
					echo "<td>".$row['tipo_user']."</td>";
					echo "<td>";
						echo "<div class='pencil2'>";
							echo "<a width='0px' href='users.php?id_user=".$row['id_user']."'>";
								echo "<div class='icon-pencil2'></div>";
							echo "</a>";
						echo "</div>";
					echo "</td>";
					echo "<td>";
						if($row['id_type']!=1){
							echo "<div class='trash2'>";
								echo "<a width='0px' href='delete.php?id_user=".$row['id_user']."'>";
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
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>