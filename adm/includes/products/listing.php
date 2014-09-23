<?php	

	/*$db_table_name comes from adm/pages/index.php script*/
	echo "<div class='add_button'><a href='".$_SERVER['PHP_SELF']."?table=".$db_table_name."&action=add''><img src='".ADMIN_IMAGES."add.png' />&nbsp;Добави нов запис</a></div>";
	
	$pr_typePrkey = $db->getPrKey('product_type');
	$pr_genderPrkey = $db->getPrKey('product_gender');
	$pr_usagePrkey = $db->getPrKey('product_usage');
	
	/*pagination variables*/
	$ipp = 10; //items por page
	$page = 1; //current page in url
	$p_around = 5; //shown pages around selected page into the list
	$num_rows = 0; //all returned rows
			
	$order = "ORDER BY p.release_date ";
	$direction = " DESC";
	if(isset($_GET['order_by'])&&in_array($_GET['order_by'],$fields_arr))
		$order = "ORDER BY ".$_GET['order_by']." ";
		
	if(isset($_GET['order'])&&($_GET['order']=='ASC'||$_GET['order']=='DESC'))
		$direction = $_GET['order'];
		
	$order_by = $order.$direction;
	
	/*$table_prKey comes from adm/pages/index.php script*/
	$query = "
		SELECT p.".$table_prKey." as ".$table_prKey.",
			p.catalogueID as catNum,
			p.".$pr_typePrkey.",
			p.".$pr_genderPrkey.",
			p.".$pr_usagePrkey.",
			pt.name as type,
			pg.name as gender,
			pu.name as use_type,
			p.is_active as activity,
			p.release_date as date
		FROM ".$db_table_name." p
		INNER JOIN product_type pt ON pt.".$pr_typePrkey." = p.".$pr_typePrkey."
		INNER JOIN product_gender pg ON pg.".$pr_genderPrkey." = p.".$pr_genderPrkey."
		INNER JOIN product_usage pu ON pu.".$pr_usagePrkey." = p.".$pr_usagePrkey."
		" .$order_by."
	";
	$all_stmt = $db->query($query);
	$num_allrows = $db->numRows($all_stmt);
	$all_pages = ceil($num_allrows/$ipp);
	$curr_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	
	//escape number of higher/lower then existing pages
	if(isset($_GET['page']))
	{
		if($_GET['page']>0&&$_GET['page']<=$all_pages)
			$page = $_GET['page'];
		else
		{
			$redirect_url = $curr_url.Utils::createUrlRequest($_GET,array('page'));
			if($_GET['page']<0)
				$redirect_url .= "&page=1";
			if($_GET['page']>$all_pages)
				$redirect_url .= "&page=".$all_pages."";
			header('location:'.$redirect_url.'');
		}
	}
	
	$limited_query = $query.Utils::createLimitString($ipp,$page,$num_allrows);
	$stmt = $db->query($limited_query);
	$num_rows = $db->numRows($stmt);
	
	
	if($num_rows>0)
	{
		$remove_arr = array('order_by','order');
		$query_string = Utils::createUrlRequest($_GET,$remove_arr);
		echo "<table class='list_table'>";
			echo "<tr class='headers'>";
				echo "<th>";
					echo "<a href='".$curr_url.$query_string."&order_by=".$table_prKey."&order=DESC'>&#9660;</a> # <a href='".$curr_url.$query_string."&order_by=".$table_prKey."&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo "<a href='".$curr_url.$query_string."&order_by=catalogueID&order=DESC'>&#9660;</a> Номер <a href='".$curr_url.$query_string."&order_by=catalogueID&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo "<a href='".$curr_url.$query_string."&order_by=".$pr_typePrkey."&order=DESC'>&#9660;</a> Тип <a href='".$curr_url.$query_string."&order_by=".$pr_typePrkey."&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo "<a href='".$curr_url.$query_string."&order_by=".$pr_genderPrkey."&order=DESC'>&#9660;</a> Пол <a href='".$curr_url.$query_string."&order_by=".$pr_genderPrkey."&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo "<a href='".$curr_url.$query_string."&order_by=".$pr_usagePrkey."&order=DESC'>&#9660;</a> Употреба <a href='".$curr_url.$query_string."&order_by=".$pr_usagePrkey."&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo "<a href='".$curr_url.$query_string."&order_by=is_active&order=DESC'>&#9660;</a> Активност <a href='".$curr_url.$query_string."&order_by=is_active&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo "<a href='".$curr_url.$query_string."&order_by=release_date&order=DESC'>&#9660;</a> Дата <a href='".$curr_url.$query_string."&order_by=release_date&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo "Администрация";
				echo "</th>";
			echo "</tr>";
			$odd=0;
			$odd_class='';
			while($row = $db->fetchArray($stmt))
			{
				if($odd%2 == 0)
					$odd_class = 'even';
				else
					$odd_class = 'odd';
				
				$odd++;	
				
				echo "<tr class='".$odd_class." parent_mark'>";
					echo "<td>";
						echo $row[$table_prKey];
					echo "</td>";
					echo "<td>";
						echo $row['catNum'];
					echo "</td>";
					echo "<td>";
						echo $row['type'];
					echo "</td>";
					echo "<td>";
						echo $row['gender'];
					echo "</td>";
					echo "<td>";
						echo $row['use_type'];
					echo "</td>";
					echo "<td>";
						if($row['activity']==1)
							echo "<span class='green'>Активен</span>";
						if($row['activity']==0)
							echo "<span class='red'>Неактивен</span>";
					echo "</td>";
					echo "<td>";
						echo date('d-M-Y',strtotime($row['date']));
					echo "</td>";
					echo "<td>";
						echo "<a href='".SITE_URL.ADMIN."pages?table=".$db_table_name."&action=edit&".$table_prKey."=".$row[$table_prKey]."'><img src='".ADMIN."images/edit.png' alt='Редактирай' title='Редактирай' /></a>&nbsp;&nbsp;&nbsp;";
						echo "<a class='deleteIthem' id='".$row[$table_prKey]."' table ='".$db_table_name."' pr_key='".$table_prKey."' href='javascript:void(0);'><img src='".ADMIN."images/del.png' alt='Изтрий' title='Изтрий' /></a>";
					echo "</td>";
				echo "</tr>";
			}
		echo "</table>";
		echo "<div class='pagination'>";
			Utils::drawPagination($ipp,$page,$num_allrows,5);
		echo "</div>";
	}
	else
		echo "Няма записи в тази таблица .";
		
	
?>