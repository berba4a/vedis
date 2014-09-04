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
		{
			if(isset($_POST[$value]))
				$record_arr[$value] = $_POST[$value];	
		}
	}
	if(isset($record_arr[$pr_key])&&$record_arr[$pr_key]<0)
	{
		unset($record_arr[$pr_key]);
		$result = $db->insertRecord($_POST['table'],$record_arr);
		$img_productID = $db->getLastInsertedId();
	}
	else if(isset($record_arr[$pr_key])&&$record_arr[$pr_key]>0)
	{
		$result = $db->updateRecord($_POST['table'],$record_arr,$record_arr[$pr_key]);	
		$img_productID = $record_arr[$pr_key];
	}
	else
	{
		$db->rollback();
		$result = -1;
	}
	
	if($result>=0)
	{
		if(!empty($_FILES))
		{
			$db_results = array();
			$file_res = array();
			foreach($_FILES['images']['name'] as $key=>$value)
			{
				if($_FILES['images']['error'][$key]==UPLOAD_ERR_OK)
				{
					$name = $_FILES['images']['name'][$key];
					$ext = end((explode('.', $name)));
					$file_name = "model_".$record_arr['catalogueID']."_".$key.".".$ext;
					$img_record_arr[$pr_key] = $img_productID;
					$img_record_arr['name'] = $file_name;
					$db_res = $db->insertRecord('product_images',$img_record_arr);
					if($db_res<0)
						$db_results[$key] = false;
					else
						$db_results[$key] = true;
						
					if($db_results[$key]===true)
					{
						$file_res[$key] = move_uploaded_file($_FILES['images']['tmp_name'][$key],PRODUCT_IMAGES.$file_name);
					}
				}
			}
		}
		if(!in_array(false,$db_results,true)&&!in_array(false,$file_res,true))
		{
			$db->commit();
			$msg =  "Записът е успешен!";
		}
		else
		{
			$db->rollback();
			$msg =  "Записът е неуспешен!";
		}
	}
	else
	{
		$db->rollback();
		$msg =  "Грешка при запис в базата данни!";
	}
}
else
	$msg =  "Грешно име на таблица свържете се с вашият програмист !";
?>
<!DOCTYPE>
<html>
	<head>
		<script src='//code.jquery.com/jquery-1.11.0.min.js'></script>
		<script type='text/javascript'>
			$(document).ready(function(){$('form').submit();});
		</script>
	</head>
	<body>
		<form method='POST' action='<?php echo ADMIN;?>pages/?table=<?php echo $_POST['table'];?>'>
			<input type='hidden' name='msg' id='msg' value='<?php echo $msg;?>'>
		</form>
	</body>
</html>