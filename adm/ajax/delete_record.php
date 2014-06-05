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

	$tables_arr = $db->getTables();
	$msg="";
	if(isset($_POST['table'])&&in_array($_POST['table'],$tables_arr))
	{
		if(isset($_POST['pr_key'])&&$_POST['pr_key']==$db->getPrKey($_POST['table']))
		{
			if(isset($_POST[$_POST['pr_key']])&&$_POST[$_POST['pr_key']]>0)
			{
				if(isset($_POST["show_dialog"])&&1==$_POST["show_dialog"])
				{
					echo "<div class='dialogue_close' onclick='closeDialogue()'></div>";
					echo "<div class='dialogue_text'>Найстина ли искате да изтриете маркирания с червено запис с ID# ".$_POST[$_POST['pr_key']]."</div>";
					echo "<div class='dialogue_buttons confirm' onclick='deleteIthem();'>Изтрий</div>";
					echo "<div class='dialogue_buttons cancel' onclick='closeDialogue()'>Отмяна</div>";
					echo "<form id='delete_form'>";
						echo "<input type='hidden' name='table' value='".$_POST['table']."'>";
						echo "<input type='hidden' name='pr_key' value='".$_POST['pr_key']."'>";
						echo "<input type='hidden' name='".$_POST['pr_key']."' value='".$_POST[$_POST['pr_key']]."'>";
					echo "</form>";
				}
				else
				{
					/*Start transaction*/
					$db->transaction();
					
					/*check if deleted item is product in order to remove the images from file system*/
					$file_res = array();
					if(strpos('product',$_POST['pr_key'])!==false)
					{
						$query = " SELECT * FROM product_images WHERE ".$db->getPrKey($_POST['table'])." = ".$_POST[$_POST['pr_key']]." ";
						$stmt = $db->query($query);
						if($db->numRows($stmt)>0)
						{
							while($row=$db->fetchObject($stmt))
							{
								$file_res[] = @unlink(PRODUCT_IMAGES.$row->name);
							}
						}
						else
							$file_res[] = true;
					}
					else
						$file_res[] = true;
						
					if(!in_array(false,$file_res))
					{
						$db_res = $db->query("DELETE FROM ".$db->escapeString($_POST['table'])." WHERE ".$db->escapeString($_POST['pr_key'])." = ".$db->escapeString($_POST[$_POST['pr_key']])." ");
						if($db_res>0)
						{
							$db->commit();
							$msg = "Записът изтрит успешно!";
						}
						else
						{
							$db->rollback();
							$msg = "<span class='err_msg'>Грешка при изтриване на записа!</span>";
						}
					}
					else
					{
						$db->rollback();
						$msg = "<span class='err_msg'>Грешка при изтриването на файл от файловата система!</span>";
					}
				}
			}
			else
			{
				$db->rollback();
				$msg = "<span class='err_msg'>Грешно ИД на записа!</span>";	
			}
		}
		else
		{
			$db->rollback();
			$msg = "<span class='err_msg'>Грешно име на първичен ключ!</span>";
		}
	}
	else
	{
		$db->rollback();
		$msg = "<span class='err_msg'>Грешно име на таблица!</span>";
	}
	echo $msg;

?>