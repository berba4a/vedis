<?php
	$stmt = $db->query("SELECT * FROM ".$db_table_name." ");
	$num_rows = $db->numRows($stmt);
	if($num_rows>0)
	{
		echo "listing start";
	}
	else
		echo "Няма записи в тази таблица .";
?>