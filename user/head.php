<?php
include './database_connection.php';
include './functions.php';
include '../strings/strings_es.php';
$id_show_company=1;
?>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
	<meta http-equiv='x-ua-compatible' content='ie=edge'> 
	<link rel = 'icon' type='image/ico' href='../cms_img/favicon.ico'/>
	<link href = './css/normalize.css' type='text/css' rel='stylesheet'>
	<link href = './css/main_desingn.css' type='text/css' rel='stylesheet'>
	<title>
		<?php
		$cond = 'SELECT name from cms_company where id_company = '.$id_show_company;
		$result = mysqli_query($link, $cond);
		if ($row = mysqli_fetch_array($result)){
			echo $row['name'];
		}
		?>
	</title>
</head>