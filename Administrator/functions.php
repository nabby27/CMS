<?php
include_once 'database_connection.php';
/*
function mostrar($table, $id, $field, $value, $show_field){
	global $link;
	$result = mysqli_query($link, "SELECT * from $table where $field=$value");
	while($row = mysqli_fetch_assoc($result)) {
		if ($value==0){
			echo "<li><a href='main.php?id_category=".$row[$id]."'>".$row[$show_field]."</a></li>";
		}
		elseif ($table=='cms_category'){
			echo "<li><a href='main.php?id_subcategory=".$row[$id]."'>".$row[$show_field]."</a></li>";
		}
		else{
			if($field!="id_article"){
				$parameter="id_article=".$row[$id]."";
				echo "<div class='general_section'>";
					echo "<div class='picture_section'><img src='".$row['picture']."' style='width: 100%; height: 100%'></div>";
					echo "<div class='name_section'><a href='detail.php?".$parameter."'>".$row[$show_field]."</a></div>";
				echo "</div>";
			}
			else{
				$parameter="id_article=".$row[$id]."";
				echo "<div class='general_section'>";
					echo "<div class='picture_section'><img src='".$row['picture']."' style='width: 100%; height: 100%'></div>";
					echo "<div class='name_section'>".$row[$show_field]."</div>";
				echo "</div>";
			}
		}
	}
}
*/

function category_form($table, $fieldId, $valueId){
	global $link;
	$result= mysqli_query($link, "SELECT * from $table");
	$result2 = mysqli_query($link, "SELECT * from $table where $fieldId=$valueId");
	while ($row2 = mysqli_fetch_assoc($result2)){
		echo "<form action='categories.php' method='POST' class='login_form'>"; 
			echo "$S_categories_father: <br><br>";
				echo "<select name='id_category_father'><br><br>";
					while ($row=mysqli_fetch_assoc($result)) {
						if ($row['id_category']==$row2['id_category_father']){
							echo "<option value='".$row['id_category']."' selected>".$row['name']."</option>";
						}
						else{
							echo "<option value='".$row['id_category']."'>".$row['name']."</option>";
						}
					}
				echo "</select><br><br>";
			echo "$_name: <br><br><input type='text' name='name' value=".$row2['name']."><br><br>";
			echo "<input type='submit' name='send' value='Guardar cambios'><br>";
			echo "<input type='hidden' name='id_category' value=".$valueId.">";
		echo "</form>";
	}
}

function formulario_article($table, $fieldId, $valueId){
	global $link;
	$result= mysqli_query($link, "SELECT * from cms_category");
	$result2 = mysqli_query($link, "SELECT * from $table where $fieldId=$valueId");
	while ($row2 = mysqli_fetch_assoc($result2)){
		echo "<form action='articles.php' method='POST' class='company_form' id='form_art' enctype='multipart/form-data'>"; 
			echo "$S_name: <br><br><input type='text' name='name' value='".$row2['name']."'><br><br>";
			echo "$S_description: <br><br><textarea name='description' form='form_art' rows='15' cols='50'>".$row2['descripcion']."</textarea><br><br>";
			echo "$S_main_picture:<br><br><img src='../img/".$row2['picture']."'style='width: 100%; height: 100%'><input type='file' name='picture'><br><br>";
			echo "$S_category: <br><br>";
				echo "<select name='id_category'><br><br>";
					while ($row=mysqli_fetch_assoc($result)){
						$result_p=mysqli_query($link, "SELECT name from cms_category where id_category in (select id_category_father from cms_category where id_category=".$row['id_category'].")");
						$row_p=mysqli_fetch_assoc($result_p);
						if ($row['id_category']==$row2['id_category']){
							echo "<option value='".$row['id_category']."' selected>".$row_p['name']."&nbsp".$row['name']."</option>";
						}
						else{
							echo "<option value='".$row['id_category']."'>".$row_p['name']."&nbsp".$row['name']."</option>";
						}
					}
				echo "</select><br><br>";
			echo "<input type='submit' name='send' value=".$S_save_changes."><br>";
			echo "<input type='hidden' name='id_article' value=".$valueId.">";
		echo "</form>";
	}
}
?>
