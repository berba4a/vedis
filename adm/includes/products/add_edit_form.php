<?php
$pr_typePrkey = $db->getPrKey('product_type');
$pr_genderPrkey = $db->getPrKey('product_gender');
$pr_usagePrkey = $db->getPrKey('product_usage');
$pr_imagesPrkey = $db->getPrKey('product_images');

/*check if $_GET is properly passed if no redirects to home*/
if(!isset($_GET['table'])||!in_array($_GET['table'],$tables_arr))
	header('location:'.SITE_URL.ADMIN.'');


if(isset($_GET['action'])&&(trim($_GET['action']) == 'add'|| trim($_GET['action'])=='edit'))
{
	$title = "Добавяне на продукт .";
	$catalogueID = "";
	$typeID = 1;
	$genderID = 0;
	$usageID = 0;
	$description = "";
	$release_date = "";
	$is_active = 0;
	$is_active_checked = "";
	$images_string = "";
	if((trim($_GET['action'])=='edit')&&isset($_GET[$table_prKey])&&$_GET[$table_prKey]>0)
	{
		$query = "SELECT * FROM ".$db->escapeString($_GET['table'])." WHERE ".$table_prKey." = ".$db->escapeString($_GET[$table_prKey])." ";
		if($row = $db->fquery($query))
		{
			$title = "Редактиране на <span class='red'>модел ".$row->catalogueID."</span> последно обновяван на : ".date('d-M-Y',strtotime($row->last_update));
			$catalogueID = $row->catalogueID;
			$typeID = $row->typeID;
			$genderID= $row->genderID;
			$usageID = $row->usageID;
			$description = $row->description;
			$release_date = date('d-M-Y',strtotime($row->release_date));
			$is_active = $row->is_active;
			
			/*get images*/
			$query = "SELECT * FROM product_images WHERE ".$table_prKey."=".$_GET[$table_prKey]." ";
			$stmt = $db->query($query);
			if($db->numRows($stmt)>0)
			{
				while($row = $db->fetchArray($stmt))
				{
					$images_string .="<div class='image parent_mark'>";
						$images_string .= "<span class='id_num'>ID #".$row[$pr_imagesPrkey]."</span><br />";
						$images_string .= "<img src='".SITE_UPOLADS."product_images/".$row['name']."' />\n";
						$images_string .= "<br /><span class='deleteIthem del_img' id='".$row[$pr_imagesPrkey]."' table='product_images' pr_key='".$pr_imagesPrkey."' >Изтрии снимката </span><br />\n";
					$images_string .="</div>";
				}
			}
		}
		else
			header('location:'.SITE_URL.ADMIN.'pages/?&table='.$_GET['table'].'');
	}
	else if((trim($_GET['action'])=='edit')&&isset($_GET[$table_prKey])&&$_GET[$table_prKey]<=0)
		header('location:'.SITE_URL.ADMIN.'pages/?&table='.$_GET['table'].'');
	
	/*datepicker include scripts ,css and initialization*/
	echo "<link type='text/css' rel='stylesheet' href='".ADMIN_CSS."default.css' />";
	echo "<script type='text/javascript' src='".ADMIN_JS."zebra_datepicker.js'></script>";
	echo "<script type='text/javascript'>";
		echo "$(document).ready(function()
		{
			$('input.datepicker').Zebra_DatePicker({
				direction: false,
				format: 'd-M-Y'
			});
		});";
	echo "</script>";
	
	
	echo "<div class='title'>".$title."</div>";
	
	echo "<form id='' method='POST' enctype='multipart-form/data' action='".ADMIN."includes/".$_GET['table']."/submit_form.php'>";
		
		if($is_active==1)
			$is_active_checked = "checked";
		
		echo "<div class='input_fields'>";
			echo "<div class='input_field'>";
				echo "<label for='is_active'>Активен : </label>";
				echo "<input type='checkbox' name='is_active' id='is_active' class='' ".$is_active_checked." value='".$is_active."' />";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<label for='catalogueID'>Номер на модела : </label><br />";
				echo "<input type='text' name='catalogueID' id='catalogueID' class='mandatory' value='".$catalogueID."' />";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<label for='release_date'>Дата на производство : </label><br />";
				echo "<input type='text' name='release_date' id='release_date' class='datepicker mandatory' value='".$release_date."' />";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<label for='description'>Вид на продукта : </label><br />";
				echo "<select name='typeID'>";
					echo "<option value='-1'>-- Избери вид на продукта --</option>";
					$type_selected = "";
					$query = "SELECT * FROM product_type ";
					$stmt = $db->query($query);
					while($row = $db->fetchArray($stmt))
					{
						if($typeID == $row[$pr_typePrkey])
							$type_selected = "selected";
							
						echo "<option value='".$row[$pr_typePrkey]."' ".$type_selected.">".$row['name']."</option>";
					}
				echo "</select>";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<label for='description'>Употреба на продукта : </label><br />";
				echo "<select name='usageID'>";
					echo "<option value='-1'>-- Избери употреба на продукта --</option>";
					$usage_selected = "";
					$query = "SELECT * FROM product_usage ";
					$stmt = $db->query($query);
					while($row = $db->fetchArray($stmt))
					{
						if($usageID == $row[$pr_usagePrkey])
							$usage_selected = "selected";
							
						echo "<option value='".$row[$pr_usagePrkey]."' ".$usage_selected.">".$row['name']."</option>";
					}
				echo "</select>";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<label for='description'>Пол : </label><br />";
				echo "<select name='genderID'>";
					echo "<option value='-1'>-- Избери пол --</option>";
					$gender_selected = "";
					$query = "SELECT * FROM product_gender ";
					$stmt = $db->query($query);
					while($row = $db->fetchArray($stmt))
					{
						if($genderID == $row[$pr_genderPrkey])
							$gender_selected = "selected";
							
						echo "<option value='".$row[$pr_genderPrkey]."' ".$gender_selected.">".$row['name']."</option>";
					}
				echo "</select>";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<label for='description'>Описание на продукта : </label><br />";
				echo "<textarea>".$description."</textarea><br />";			
			echo "</div>";
		echo "</div>";
		echo "<div class='images_fields'>";
			echo $images_string;
			echo "<div class='clear'></div>";
			echo "<label for='image[]'>Прикачи снимки : </label><br />";
			echo "<input type='file' name='image[]' id='images[]' />";
		echo "</div>";
		echo "<div class='clear'></div>";
		echo "<div class='input_field'>";
			echo "<input type='submit' value='Запази промените' /><br />";
		echo "</div>";
	echo "</form>";
}
else
	header('location:'.SITE_URL.ADMIN.'?table='.$_GET['table'].'');
?>