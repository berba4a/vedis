<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	/*in order to skip type of products because we have only bags for now type is not in array to add it just add this to the array 'Вид'=>'product_type', */
	$table_arr = array('Пол'=>'product_gender','Употреба'=>'product_usage');
	echo "<h1>Филтрирай по :</h1>";
	echo "<ul>";
		foreach($table_arr as $label=>$table)
		{	
			echo "<li>";
				echo "<div class='accordion_link'><a href='javascript:void(0)'>".$label."</a></div>";
				echo "<div class='accordion_ithem left'>";
					
					/*all input*/
					$all_check = "";
					if(!isset($_GET[$table]))
						$all_check = "checked";
						
					echo "<input ".$all_check." type='radio' name='".$table."' id='".$table."0' value='-1' />";
					echo "<label for='".$table."0'>Всички</label><br />";
					/*end all input*/
					
					$stmt = $db->query("SELECT * FROM ".$table." ");
					while($row = $db->fetchArray($stmt))
					{
						$checked = "";
						/*check for passed parameter*/
						if(isset($_GET[$table])&&$_GET[$table]>0&&$_GET[$table]!=""&&$_GET[$table]==$row[$db->getPrKey($table)])
							$checked = "checked";
				
						echo "<input ".$checked." type='radio' name='".$table."' id='".$table.$row[$db->getPrKey($table)]."' value='".$row[$db->getPrKey($table)]."' />";
						echo "<label for='".$table.$row[$db->getPrKey($table)]."'>".$row['name']."</label><br />";
					}
				echo "</div>";
			echo "</li>";
		}
		
			
		/*datepicker include scripts ,css and initialization*/
		echo "<link type='text/css' rel='stylesheet' href='".ADMIN_CSS."default.css' />";
		echo "<script type='text/javascript' src='".ADMIN_JS."zebra_datepicker.js'></script>";
		echo "<li>";
			echo "<div class='accordion_link'><a href='javascript:void(0)'>Дата</a></div>";
			echo "<div class='accordion_ithem left'>";
			$dates_arr = array('from'=>'Произведено от :','to'=>'Произведено до :');
			foreach($dates_arr as $date_type=>$date_label)
			{
				${'date_'.$date_type}="";
				if(isset($_GET['date_'.$date_type])&&(false!==strtotime($_GET['date_'.$date_type])||-1!==strtotime($_GET['date_'.$date_type])))
				{
					${'date_'.$date_type} = date('d-M-Y',strtotime($_GET['date_'.$date_type]));
				}
				echo "<label for='date_".$date_type."'>".$date_label."</label>";
				echo "<input class='main_search datepicker' type='text' name='date_".$date_type."' id='date_".$date_type."' value='".${'date_'.$date_type}."' /><br />";
			}
			echo "<div class='clear'></div>";
			echo "</div>";
		echo "</li>";
	echo "</ul>";
?>

<div class='bottom_link text_right'>
	<!--#product_type=1 because for now we have only bags-->
	<a href='<?php echo SITE_URL.SITE_ROOT;?>pages/products.php#product_type=1' >&raquo; Виж всички продукти</a>
</div>