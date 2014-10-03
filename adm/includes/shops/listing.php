<?php
	echo "<div class='add_button'><a href='".$_SERVER['PHP_SELF']."?table=".$db_table_name."&action=add''><img src='".ADMIN_IMAGES."add.png' />&nbsp;Добави нов запис</a></div>";
	
	$cities_prKey = $db->getPrKey('cities');
	
	/*pagination variables*/
	$ipp = 10; //items por page
	$page = 1; //current page in url
	$p_around = 5; //shown pages around selected page into the list
	$num_rows = 0; //all returned rows
	
	$order = "ORDER BY sh.".$table_prKey." ";
	$direction = " DESC";
	if(isset($_GET['order_by'])&&in_array($_GET['order_by'],$fields_arr))
		$order = "ORDER BY ".$_GET['order_by']." ";
		
	if(isset($_GET['order'])&&($_GET['order']=='ASC'||$_GET['order']=='DESC'))
		$direction = $_GET['order'];
		
	$order_by = $order.$direction;
	
	$query = "SELECT
		sh.".$table_prKey." as id,
		sh.name,
		sh.address,
		sh.phone,
		sh.mail,
		sh.web,
		sh.is_active as activity,
		c.city_name as city
		FROM ".$db_table_name." sh 
		INNER JOIN cities AS c ON c.".$cities_prKey." = sh.".$cities_prKey."
		".$order_by."
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
					echo "<a href='".$curr_url.$query_string."&order_by=name&order=DESC'>&#9660;</a> Име <a href='".$curr_url.$query_string."&order_by=name&order=ASC'>&#9650;</a>";
				echo "</th>";
				echo "<th>";
					echo " Град ";
				echo "</th>";
				echo "<th>";
					echo " Адрес ";
				echo "</th>";
				echo "<th>";
					echo " Телефон ";
				echo "</th>";
				echo "<th>";
					echo " E-mail ";
				echo "</th>";
				echo "<th>";
					echo " WEB ";
				echo "</th>";
				echo "<th>";
					echo " Активност ";
				echo "</th>";
				echo "<th>";
					echo "Администрация";
				echo "</th>";
			echo "</tr>";
			$odd=0;
			$odd_class='';
			while($row = $db->fetchObject($stmt))
			{	
				if($odd%2 == 0)
						$odd_class = 'even';
					else
						$odd_class = 'odd';
					
					$odd++;	
				
				echo "<tr class='".$odd_class." parent_mark'>";
					echo "<td>";
						echo $row->id;
					echo "</td>";
					echo "<td>";
						echo $row->name;
					echo "</td>";
					echo "<td>";
						echo $row->city;
					echo "</td>";
					echo "<td>";
						echo $row->address;
					echo "</td>";
					echo "<td>";
						echo $row->phone;
					echo "</td>";
					echo "<td>";
						echo "<a href='mailto:".$row->mail."'>".$row->mail."</a>";
					echo "</td>";
					echo "<td>";
						$http = "http://";
						if(strpos($row->web,'http://')!==false)
							$http = "";
						echo "<a target='_blank' href='".$http.$row->web."'>".$row->web."</a>";
					echo "</td>";
					echo "<td>";
						if($row->activity == 1)
							echo "<span class='green'>Активен</span>";
						if($row->activity == 0)
							echo "<span class='red'>Неактивен</span>";
					echo "</td>";
					echo "<td>";
						echo "<a href='".SITE_URL.ADMIN."pages?table=".$db_table_name."&action=edit&".$table_prKey."=".$row->id."'><img src='".ADMIN."images/edit.png' alt='Редактирай' title='Редактирай' /></a>&nbsp;&nbsp;&nbsp;";
						echo "<a class='deleteIthem' id='".$row->id."' table ='".$db_table_name."' pr_key='".$table_prKey."' href='javascript:void(0);'><img src='".ADMIN."images/del.png' alt='Изтрий' title='Изтрий' /></a>";
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