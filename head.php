<?php
if (isset($_POST['language'])){ 
	$_SESSION['language']=$_POST['language'];
} 
elseif (empty($_SESSION['language'])){
	 $_SESSION['language']='es'; 
}
$id_show_company=1;
include 'strings/strings_'.$_SESSION['language'].'.php';
?>
<head>
	<meta charset='UTF-8'>
	<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
	<meta http-equiv='x-ua-compatible' content='ie=edge'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/aaefcbe50d.js"></script> 
	<link rel="stylesheet" type="text/css" href="normalize.css">  
	<link rel="stylesheet" type="text/css" href="style.css">    
	<title>
		<?php
		$cond = 'SELECT name from cms_company where id_company = '.$id_show_company;
		$result = mysqli_query($link, $cond);
		if ($row = mysqli_fetch_array($result)){
			echo $row['name'];
		}
		?>
	</title>
	<link rel = 'icon' type='image/ico' href='./img/favicon.ico'/>
	<link href = './css/normalize.css' type='text/css' rel='stylesheet'>
	<link href = './css/main_desingn.css' type='text/css' rel='stylesheet'>
	<link href = './bootstrap/css/bootstrap.min.css' media='screen' rel='stylesheet'>
</head>