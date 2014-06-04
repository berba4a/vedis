<?php 
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

include_once("includes/DBMYSQL.class.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

$db_tables_arr = $db->getTables();
$pr_key="";
$table_fields_arr = array();
if(isset($_POST['table'])&&in_array($_POST['table'],$db_tables_arr))
{
	$pr_key = $db->getPrKey($_POST['table']);
	$table_fields_arr = $db->getTableFields($_POST['table']);
	

	$record_arr = array();
	/*Start transaction*/
	$db->transaction();
	foreach($table_fields_arr as $value)
	{
		if($value == 'last_update')
			continue;
		else if($value == 'is_active')
		{
			if(isset($_POST[$value]))
				$record_arr[$value] = 1;
			else
				$record_arr[$value] = 0;
		}
		else if(strpos($value,'date')!==false)
			$record_arr[$value] = date('Y-m-d',strtotime($_POST[$value]));
		else
			$record_arr[$value] = $_POST[$value];
	}
	if($record_arr[$pr_key]<0)
	{
		unset($record_arr[$pr_key]);
		$result = $db->insertRecord($_POST['table'],$record_arr);
		echo $db->getLastInsertedId();
		$db->commit();
	}
	else
	{
		$result = $db->updateRecord($_POST['table'],$record_arr,$record_arr[$pr_key]);	
	}
}
else
	echo "Грешно име на таблица свържете се с вашият програмист !";
?>