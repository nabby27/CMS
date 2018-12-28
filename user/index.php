<?php
session_start();
if (isset($_SESSION['s_user'])){
	header('Location: main.php');
}
else{
	echo '<!DOCTYPE html>';
	echo '<html lang="en">';
		include 'head.php';
		echo '<body>';
			include 'header.php';
			if (isset($_POST['send'])){
				$user = mysqli_real_escape_string($_POST['name']);
				$password = mysqli_real_escape_string($_POST['password']);
				$cond = "SELECT id_user FROM cms_users where (id_user='$user' or email='$user') and password = '$password'";
				$result = mysqli_query($link, $cond);
				if ($row = mysqli_fetch_assoc($result)){
					$_SESSION['s_user']=$row['id_user'];
					header('Location: main.php');
				}
				else{
					echo '<div class="login_form">';
						echo $S_wrong_user; 
						echo '<br><br>';
						echo '<a href="index.php">'.$S_try_again.'</a>';
					echo '</div>';
				}
			}
			else{
				echo '<div class="login_form">';	
					echo '<form action="index.php" method="post">';
						echo '<fieldset>';
							echo '<legend>'.$S_log_in.'</legend>';
							echo $S_username_or_email.' : <br><input type="text" name="name"><br><br>';
							echo $S_password.' :<br><input type="password" name="password"><br><br>';
							echo '<input class="button" type="submit" name="send" value='.$S_log_in.'><br>';
						echo '</fieldset>';
					echo '</form>';
				echo '</div>';
				echo '<div class="container_sign_up">';
					echo '<a href="sign_up.php">';
						echo '<div class="sign_up">';
							echo $S_sign_up_here;
						echo '</div>';
					echo '</a>';
				echo '</div>';
			}
			include 'scripts.php';
		echo '</body>';
	echo '</html>';
} 
?>
