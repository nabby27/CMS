<!--***********************************************************************************-->
<!--************created by Iván Córdoba Donet ivancordoba77@gmail.com******************-->
<!--***********************************************************************************-->

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
	<title>
		<?php
		$cond = "SELECT name from cms_company where id_company=$id_show_company";
		$result = mysqli_query($link, $cond);
		if ($row = mysqli_fetch_array($result)){
			echo $row['name'];
		}
		?>
	</title>
	<link rel='icon' type='image/ico' href='./img/favicon.ico'/>
	<link href='./css/normalize.css' type='text/css' rel='stylesheet'>
	<link href='./css/main_desingn.css' type='text/css' rel='stylesheet'>
	<link href='./bootstrap/css/bootstrap.min.css' media='screen' rel='stylesheet'>
</head>