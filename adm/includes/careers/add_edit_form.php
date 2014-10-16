<?php
/*check if $_GET is properly passed if no redirects to home*/
if(!isset($_GET['table'])||!in_array($_GET['table'],$tables_arr))
	header('location:'.SITE_URL.ADMIN.'');

if(isset($_GET['action'])&&(trim($_GET['action']) == 'add'|| trim($_GET['action'])=='edit'))
{
	$title = "Добавяне на позиция .";
	
	${$db->getPrKey($_GET['table'])} = -1;
	$name = "";
	$description = "";
	$is_active = 0;
	$is_active_checked = "";
	
	if((trim($_GET['action'])=='edit')&&isset($_GET[$table_prKey])&&$_GET[$table_prKey]>0)
	{
		$query = "SELECT * FROM ".$db->escapeString($_GET['table'])." WHERE ".$table_prKey." = ".$db->escapeString($_GET[$table_prKey])." ";
		if($row = $db->fquery($query))
		{
			$title = "Редактиране на позиция<br /><span class='red'> ".$row->name."</span>";
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
	echo "<script type='text/javascript' src='".ADMIN_JS."submit_form.js'></script>";
	echo "<script type='text/javascript'>
	$(document).ready(function()
	{
		$('.submit_btn').click(function()
		{
			checkSubmitForm('".SITE_URL.ADMIN."','".$_GET['table']."');
		});
	});</script>";
	echo "<span class='left'><a href='".SITE_URL.ADMIN."pages/?table=".$_GET['table']."'>&laquo;&nbsp;Обратно в списъка</a></span>";
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
			echo "<span class='red'>*</span><label for='name'> Позиция : </label><br />";
			echo "<input type='text' name='name' id='name' class='mandatory' value='".$name."' />";
		echo "</div>";
		
		echo "<div class='input_field left'>";
			echo "<span class='red'>*</span><label for='description'> Описание : </label><br />";
			echo "<textarea name='description' cols='200' id='description' class='mandatory'>".$description."</textarea>";
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