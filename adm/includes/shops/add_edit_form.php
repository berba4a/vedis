<?php

$cities_prKey = $db->getPrKey('cities');

/*check if $_GET is properly passed if no redirects to home*/
if(!isset($_GET['table'])||!in_array($_GET['table'],$tables_arr))
	header('location:'.SITE_URL.ADMIN.'');

if(isset($_GET['action'])&&(trim($_GET['action']) == 'add'|| trim($_GET['action'])=='edit'))
{
	$title = "Добавяне на магазин .";
	
	${$db->getPrKey($_GET['table'])} = -1;
	$name = "";
	$address = "";
	$phone = "";
	$mail = "";
	$web = "";
	$gpsLat = "";
	$gpsLon = "";
	${$cities_prKey} = -1;
	$is_active = 0;
	$is_active_checked = "";
	
	if((trim($_GET['action'])=='edit')&&isset($_GET[$table_prKey])&&$_GET[$table_prKey]>0)
	{
		$query = "SELECT * FROM ".$db->escapeString($_GET['table'])." WHERE ".$table_prKey." = ".$db->escapeString($_GET[$table_prKey])." ";
		if($row = $db->fquery($query))
		{
			$title = "Редактиране на Магазин<br /><span class='red'> ".$row->name."</span>";
			foreach($db->getTableFields($_GET['table']) as $value)
			{
				${$value} = $row->{$value};
			}
		}
		else
			header('location:'.SITE_URL.ADMIN.'pages/?table='.$_GET['table'].'');
	}
	else if((trim($_GET['action'])=='edit')&&isset($_GET[$table_prKey])&&$_GET[$table_prKey]<=0)
			header('location:'.SITE_URL.ADMIN.'pages/?table='.$_GET['table'].'');
		
	/*start output*/
	echo "<script type='text/javascript' src='".ADMIN_JS."submit_form_".$_GET['table'].".js'></script>";
	echo "<script type='text/javascript'>
	$(document).ready(function()
	{
		$('.submit_btn').click(function()
		{
			checkSubmitForm('".SITE_URL.ADMIN."');
		});
	});</script>";
	echo "<div class='title'>".$title."</div>";
	
	echo "<form id='add_edit_form' method='POST' enctype='multipart/form-data'>";
		echo "<input type='hidden' class='pr_key' name='".$table_prKey."' id='".$table_prKey."' value='".${$db->getPrKey($_GET['table'])}."' />";
		echo "<input type='hidden' name='table' id='table' value='".$_GET['table']."' />";
		
		if($is_active==1)
			$is_active_checked = "checked";
		
			echo "<span class='warning'>Всички полета означени със * за задължителни!</span>";
		echo "<div class='clear'></div>";
		echo "<div class='input_field'>";
			echo "<label for='is_active'>Активен : </label><br />";
			echo "<input type='checkbox' name='is_active' id='is_active' class='' ".$is_active_checked." />";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<span class='red'>*</span><label for='name'> Име на магазина : </label><br />";
			echo "<input type='text' name='name' id='name' class='mandatory' value='".$name."' />";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<span class='red'>*</span><label for='".$cities_prKey."'> Град : </label><br />";
			$c_stmt = $db->query(" SELECT ".$cities_prKey.",city_name FROM cities ORDER BY city_name ASC ");
			
			
			
			echo "<select name='".$cities_prKey."' id='".$cities_prKey."' class='mandatory'>";
				echo "<option value='-1'>--Избери град--</option>";
			while($c_row = $db->fetchObject($c_stmt))
			{
				$selected_city = "";
				if(${$cities_prKey} == $c_row->{$cities_prKey})
					$selected_city = "selected";
				echo "<option ".$selected_city." value='".$c_row->{$cities_prKey}."'>".$c_row->city_name."</option>";
			}
			echo "</select>";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<span class='red'>*</span><label for='address'> Адрес на магазина : </label><br />";
			echo "<input type='text' name='address' id='address' class='mandatory' value='".$address."' />";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<span class='red'>*</span><label for='phone'> Телефон : </label><br />";
			echo "<input type='text' name='phone' id='phone' class='mandatory' value='".$phone."' />";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<label for='mail'> E-mail : </label><br />";
			echo "<input type='text' name='mail' id='mail' value='".$mail."' />";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<label for='web'> WEB сайт : </label><br />";
			echo "<input type='text' name='web' id='web' value='".$web."' />";
		echo "</div>";
		echo "<div class='clear'></div>";
		echo "<div class='input_field left'>";
			echo "<label for='gpsLat'> GPS ширина : </label><br />";
			echo "<input type='text' name='gpsLat' id='gpsLat' value='".$gpsLat."' />";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<label for='gpsLon'> GPS дължина : </label><br />";
			echo "<input type='text' name='gpsLon' id='gpsLon' value='".$gpsLon."' />";
		echo "</div>";
		
		echo "<div class='clear'></div>";
		echo "<div class='input_field submit'>";
			echo "<a href='javascript:void(0)' class='submit_btn'>Запази промените</a>";
		echo "</div>";
	echo "</form>";
	
	echo "<div class='loading'></div>";
}
else
	header('location:'.SITE_URL.ADMIN.'?table='.$_GET['table'].'');
?>