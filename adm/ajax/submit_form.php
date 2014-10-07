<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$db_tables = $db->getTables();

if(isset($_GET['table'])&&""!=trim($_GET['table'])&&in_array($_GET['table'],$db_tables))
{
	$table = $_GET['table'];
	$table_prKey = $db->getPrKey($table);
	
	/*prepare record array*/
	$record_arr = array();
	if(!isset($_GET['is_active']))
		$record_arr['is_active']=0;
		
	foreach($_GET as $key=>$value)
	{
		if($key=='is_active'&&$value=='on')
			$record_arr[$key]=1;
		else if($key==$table_prKey||$key=='table')
			continue;
		else if($value!="")
			$record_arr[$key] = $db->escapeString($value);
	}
	
	if(isset($_GET[$table_prKey])&&""!=trim($_GET[$table_prKey])&&$_GET[$table_prKey]>0)
	{
		if(!empty($record_arr))
		{
			$res = $db->updateRecord($table,$record_arr,$_GET[$table_prKey]);
			if($res==1)
				$suc_msg = "Редакцията е успешна!";
		}
		else
			echo "ГРЕШКА!!!<br />Празен масив за запис!";  
	}
	else
	{
		$res = $db->insertRecord($table,$record_arr);
		$suc_msg = "Записът е успешен!";
	}
	
	if(isset($res)&&$res==1)
		echo $suc_msg;
	else
		echo "ГРЕШКА!!!<br />".$res; 
	
}
else
	echo "ГРЕШКА!!!<br />Несъществуваща таблица!";
?>