<!--***********************************************************************************-->
<!--************created by Iván Córdoba Donet ivancordoba77@gmail.com******************-->
<!--***********************************************************************************-->

<?php session_start(); ?>
<!DOCTYPE html>
<html lang='en'>
	<?php
	include 'database_connection.php';
	include 'functions.php';
	include 'head.php';
	?>
	<body>
		<?php
		include 'header.php';
		if (isset($_SESSION['s_user'])){
			if (isset($_REQUEST['home'])){
				unset($_SESSION['s_id_category']);
				unset($_SESSION['s_id_subcategory']);
			}
			if (isset($_REQUEST['id_category'])){
				$id_category=$_REQUEST['id_category'];
				unset($_SESSION['s_id_subcategory']);
				$_SESSION['s_id_category']=$id_category;
			}
			if (isset($_REQUEST['id_subcategoria'])){
				$id_subcategoria=$_REQUEST['id_subcategoria'];
				$_SESSION['s_id_subcategory']=$id_subcategoria;
			}
		?>	
			<nav>
				<ul>
					<?php mostrar('cms_category', 'id_category', 'id_category_father', 0, 'name'); ?>
				</ul>
			</nav>
			<?php
			if (isset($_SESSION['s_id_category'])){	
			?>
				<div class='section_subcategories'>
					<?php mostrar('cms_category', 'id_category', 'id_category_father', $_SESSION['s_id_category'], 'name'); ?>
				</div>
				<?php mostrar('cms_article', 'id_article', 'id_category', $_SESSION['s_id_category'], 'name'); 
			}
			if (isset($_SESSION['s_id_subcategory'])){ ?>
				<div class='section_subcategories'>
					<?php mostrar('cms_category', 'id_category', 'id_category_father', $_SESSION['s_id_subcategory'], 'name'); ?>
				</div>
				<div class='general_foto'>
					<?php mostrar('cms_article', 'id_article', 'id_category', $_SESSION['s_id_subcategory'], 'name'); ?>
				</div>
			<?php
			}
		}
		else{
			?>
			<div class='login_form'>
				<?= $S_wrong_user ; ?><br>
				<a href='index.php'><?= $S_try_again ; ?></a>
			</div>
		<?php	
		}
	include 'scripts.php';
	?>
	</body>
</html>