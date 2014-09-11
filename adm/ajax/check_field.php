<?php
	//$doc_root="D:/SERVER/htdocs/web/vedis/";
	$doc_root="C:/xampp/htdocs/web/vedis/";
	$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
	ini_set("include_path",ini_get('include_path'). $old_path);
	include_once("setup/setup.php");
	
	include_once("includes/DBMYSQL.class.php");

	/*database connect object*/
	include_once("includes/DBMYSQL.class.php");
	$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	if(isset($_GET['table'])&&in_array($_GET['table'],$db->getTables()))
	{
		$prKey = $db->getPrKey($_GET['table']);
		if(isset($_GET['field_name'])&&in_array($_GET['field_name'],$db->getTableFields($_GET['table'])))
		{
			if(isset($_GET[$prKey])&&""!=$_GET[$prKey])
			{
				if(isset($_GET['value'])&&filter_var($_GET['value'], FILTER_VALIDATE_INT))
				{
					$query = "SELECT * FROM ".$_GET['table']." WHERE ".$_GET['field_name']."=".$_GET['value']." AND ".$prKey."<>".$_GET[$prKey]." ";
					if($db->numRows($db->query($query))<1)
						echo $db->numRows($db->query($query));
					else
						echo "ГРЕШКА!!!\nТози каталожен номер вече съществува в базата данни!";
				}
				else
					echo "ГРЕШКА!!!\nВъведената стойност в полето 'Номер на модела' не е цяло число!";
			}
			else
				echo "ГРЕШКА!!!\nГрешен първичен ключ!";
		}
		else
			echo "ГРЕШКА!!!\nНесъществуващо поле в таблицата ".$_GET['table'];		
	}
	else
		echo "ГРЕШКА!!!\nНесъществуваща таблица в базата данни!";
?>