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
	$prKey = -1;
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
			$title = "Редактиране на <span class='red'>модел ".$row->catalogueID."</span><br /> последно обновен на ".date('d-M-Y',strtotime($row->last_update));
			$prKey = $_GET[$table_prKey];
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
	
	/*start output*/
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
	echo "<script type='text/javascript' src='".ADMIN_JS."submit_form_".$_GET['table'].".js'></script>";
	echo "<span class='left'><a href='".SITE_URL.ADMIN."pages/?table=".$_GET['table']."'>&laquo;&nbsp;Обратно в списъка</a></span>";
	echo "<div class='title'>".$title."</div>";
	
	echo "<form id='add_adit_form' method='POST' enctype='multipart/form-data' action='".ADMIN."includes/".$_GET['table']."/submit_form.php'>";
		echo "<input type='hidden' class='pr_key' name='".$table_prKey."' id='".$table_prKey."' value='".$prKey."' />";
		echo "<input type='hidden' name='table' id='table' value='".$_GET['table']."' />";
		
		if($is_active==1)
			$is_active_checked = "checked";
		
		echo "<div class='input_fields'>";
			echo "<span class='warning'>Всички полета означени със * за задължителни!</span>";
			echo "<div class='input_field'>";
				echo "<label for='is_active'>Активен : </label>";
				echo "<input type='checkbox' name='is_active' id='is_active' class='' ".$is_active_checked." />";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<span class='red'>*</span><label for='catalogueID'> Номер на модела : </label><br />";
				echo "<input type='text' name='catalogueID' id='catalogueID' class='mandatory' value='".$catalogueID."' />";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<span class='red'>*</span><label for='release_date'> Дата на производство : </label><br />";
				echo "<input type='text' name='release_date' id='release_date' class='datepicker mandatory' value='".$release_date."' />";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<span class='red'>*</span><label for='description'> Вид на продукта : </label><br />";
				echo "<select name='typeID' class='mandatory'>";
					echo "<option value='-1'>-- Избери вид на продукта --</option>";
					$query = "SELECT * FROM product_type ";
					$stmt = $db->query($query);
					while($row = $db->fetchArray($stmt))
					{
						$type_selected = "";
						if($typeID == $row[$pr_typePrkey])
							$type_selected = "selected";
							
						echo "<option value='".$row[$pr_typePrkey]."' ".$type_selected.">".$row['name']."</option>";
					}
				echo "</select>";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<span class='red'>*</span><label for='description'> Употреба на продукта : </label><br />";
				echo "<select name='usageID' class='mandatory'>";
					echo "<option value='-1'>-- Избери употреба на продукта --</option>";
					$query = "SELECT * FROM product_usage ";
					$stmt = $db->query($query);
					while($row = $db->fetchArray($stmt))
					{
						$usage_selected = "";
						if($usageID == $row[$pr_usagePrkey])
							$usage_selected = "selected";
													
						echo "<option value='".$row[$pr_usagePrkey]."' ".$usage_selected.">".$row['name']."</option>";
					}
				echo "</select>";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<span class='red'>*</span><label for='description'> Пол : </label><br />";
				echo "<select name='genderID' class='mandatory'>";
					echo "<option value='-1'>-- Избери пол --</option>";
					$query = "SELECT * FROM product_gender ";
					$stmt = $db->query($query);
					while($row = $db->fetchArray($stmt))
					{
						$gender_selected = "";
						if($genderID == $row[$pr_genderPrkey])
							$gender_selected = "selected";
							
						echo "<option value='".$row[$pr_genderPrkey]."' ".$gender_selected.">".$row['name']."</option>";
					}
				echo "</select>";
			echo "</div>";
			
			echo "<div class='input_field'>";
				echo "<span class='red'>*</span><label for='description'> Описание на продукта : </label><br />";
				echo "<textarea class='mandatory' name='description' id='description'>".$description."</textarea><br />";			
			echo "</div>";
		echo "</div>";
		echo "<div class='images_fields'>";
			echo $images_string;
			echo "<div class='clear'></div>";
			
			
			echo "<fieldset>";
				echo "<legend>Прикачи снимки : ";
					echo "<span class='add_files'><img src='".ADMIN_IMAGES."add.png' />&nbsp;Добави полета за файлове</span>";
				echo "</legend>";
				echo "<span class='warning'>Позволени формати на изображения : 'jpg','png','gif','bmp' .<br /> Полетата с непозволен формат или празните полета ще бъдат изтрити !</span>";
				echo "<div class='input_file'>";
					echo "<input type='file' name='images[]' id='images[]' onchange='readURL(this);' />";
				echo "</div>";
				echo "<div class='clear'></div>";
			echo "</fieldset>";
		echo "</div>";
		echo "<div class='clear'></div>";
		echo "<div class='input_field submit'>";
			echo "<a href='javascript:void(0)' class='submit_btn'>Запази промените</a>";
		echo "</div>";
	echo "</form>";
}
else
	header('location:'.SITE_URL.ADMIN.'?table='.$_GET['table'].'');
?>