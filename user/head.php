<?php
include '../strings/strings_es.php';
include './functions.php';
include './database_connection.php';
$id_show_company=1;
echo '<head>';
	echo '<meta charset="UTF-8">';
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';
	echo '<meta http-equiv="x-ua-compatible" content="ie=edge">'; 
	echo '<link rel = "icon" type="image/ico" href="../cms_img/favicon.ico"/>';
	echo '<link href = "../css/normalize.css" type="text/css" rel="stylesheet">';
	echo '<link href = "../css/user_style.css" type="text/css" rel="stylesheet">';
	echo '<title>';
		$cond = 'SELECT name from cms_company where id_company = '.$id_show_company;
		$result = mysqli_query($link, $cond);
		if ($row = mysqli_fetch_array($result)){
			echo $row['name'];
		}
	echo '</title>';
echo '</head>';
?>
