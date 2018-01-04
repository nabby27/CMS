<?php session_start(); ?>
<!DOCTYPE html>
<html lang='en'>
	<?php
	include 'head.php';
	?>
	<body>
		<?php
		include 'header.php';
		if (isset($_SESSION['s_user'])){
			if (isset($_GET['home'])){
				unset($_SESSION['s_id_category']);
				unset($_SESSION['s_id_subcategory']);
			}
			if (isset($_GET['id_category'])){
				$id_category=$_GET['id_category'];
				unset($_SESSION['s_id_subcategory']);
				$_SESSION['s_id_category']=$id_category;
			}
			if (isset($_GET['id_subcategory'])){
				$id_subcategory=$_GET['id_subcategory'];
				$_SESSION['s_id_subcategory']=$id_subcategory;
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
				<div class='subcategories_section'>
					<?php mostrar('cms_category', 'id_category', 'id_category_father', $_SESSION['s_id_category'], 'name'); ?>
				</div>
				<?php mostrar('cms_article', 'id_article', 'id_category', $_SESSION['s_id_category'], 'name'); 
			}
			if (isset($_SESSION['s_id_subcategory'])){ 
			?>
				<div class='subcategories_section'>
					<?php mostrar('cms_category', 'id_category', 'id_category_father', $_SESSION['s_id_subcategory'], 'name'); ?>
				</div>
				<div class='general_picture'>
					<?php mostrar('cms_article', 'id_article', 'id_category', $_SESSION['s_id_subcategory'], 'name'); ?>
				</div>
			<?php
			}
		}
		else
			header('Location: ./index.php');
		include 'scripts.php';
		?>
	</body>
</html>