<?php
	echo "<div class='add_button'><a href='".$_SERVER['PHP_SELF']."?table=".$db_table_name."&action=add''><img src='".ADMIN_IMAGES."add.png' />&nbsp;Добави нов запис</a></div>";
	
	
	
	$stmt = $db->query("SELECT * FROM ".$db_table_name." ");
	$num_rows = $db->numRows($stmt);
	if($num_rows>0)
	{
		echo "listing start";
	}
	else
		echo "Няма записи в тази таблица .";
?>