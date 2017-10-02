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
			echo "<nav>";
				echo "<ul>";
					echo "<li><a href='main.php'>"$S_home"</li></a>";
				echo "</ul>";
			echo "</nav>";
			if(isset($_REQUEST['send'])){
				$name=$_REQUEST['name'];
				$email=$_REQUEST['email'];
				$telephon=$_REQUEST['telephon'];
				$address=$_REQUEST['address'];
				$id_company=$_REQUEST['id_company'];

				if (is_uploaded_file($_FILES['picture']['tmp_name'][0])){
					$nameDirectory="../img/";
					$idUnique = time();
					$nameFile = $idUnique."-".$_FILES['picture']['name'][0];
					move_uploaded_file($_FILES['picture']['tmp_name'][0], $nameDirectory.$nameFile);
					$logo=$nameFile;
				}
				else{
					$logo=$_REQUEST['logo_ant'];
				}
				if (is_uploaded_file($_FILES['picture']['tmp_name'][1])){
					$nameDirectory="../img/";
					$idUnique = time();
					$nameFile = $idUnique."-".$_FILES['picture']['name'][1];
					move_uploaded_file($_FILES['picture']['tmp_name'][1], $nameDirectory.$nameFile);
					$header_picture=$nameFile;
				}
				else{
					$header_picture=$_REQUEST['header_picture_ant'];
				}
				if (is_uploaded_file($_FILES['picture']['tmp_name'][2])){
					$nameDirectory="../img/";
					$idUnique = time();
					$nameFile = $idUnique."-".$_FILES['picture']['name'][2];
					move_uploaded_file($_FILES['picture']['tmp_name'][2], $nameDirectory.$nameFile);
					$background_picture=$nameFile;
				}
				else{
					$background_picture=$_REQUEST['background_picture_ant'];
				}
				$result = mysqli_query($link, "UPDATE cms_company set name='".$name."', email='".$email."', telephon='".$telephon."', address='".$address."', logo='".$logo."', header_picture='".$header_picture."', background_picture='".$background_picture."' where id_company=".$id_company."");
			}
			$result=mysqli_query($link, "SELECT * from cms_company");
			while($row=mysqli_fetch_assoc($result)){
				echo "<form action='company.php' method='POST' class='form_company' enctype='multipart/form-data'>"; 
					echo $S_name": <br><br><input type='text' name='name' value='".$row['name']."'><br><br>";
					echo $S_email": <br><br><input type='text' name='email' value='".$row['email']."'><br><br>";
					echo $S_telephon": <br><br><input type='number' name='telephon' value='".$row['telephon']."'><br><br>";
					echo $S_address": <br><br><input type='text' name='address' value='".$row['address']."'><br><br>";
					echo $S_logo": <br><br><img src='../img/".$row['logo']."'><br><br>";
					echo "<input type='file' name='picture[]'><br><br>";
					echo $S_header": <br><br><img src='../img/".$row['header_picture']."' style='width: 100%'>";
					echo "<input type='file' name='picture[]'><br><br>";
					echo $S_background": <br><br><img src='../img/".$row['background_picture']."' style='width: 100%'>";
					echo "<input type='file' name='picture[]'><br><br>";
					echo "<input type='submit' name='send' value="$S_save_changes"><br>";
					echo "<input type='hidden' name='id_company' value='".$row['id_company']."'>";
					echo "<input type='hidden' name='logo_ant' value='".$row['logo']."'>";
					echo "<input type='hidden' name='header_picture_ant' value='".$row['header_picture']."'>";
					echo "<input type='hidden' name='background_picture_ant' value='".$row['background_picture']."'>";
				echo "</form>";			
			}
		}	
		else{
			header("Location: index.php");
		}
		include 'scripts.php';		
	echo "</body>";
echo "</html>";
?>