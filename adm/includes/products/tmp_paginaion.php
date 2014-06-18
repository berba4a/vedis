<?php

	$FWD = dirname(__FILE__);

	$footer = file_get_contents($FWD . '/../templates/footer.html');

	

	/**

	 * Поставя бутоните за следваща и предишна страница

	 */

	if (((!(strpos($_SERVER['REQUEST_URI'], '/estate.php') === false) && (!isset($_GET['action'])))/*||((isset($_GET['action']))&&$_GET['action'] === 'add_search_resusts' )*/)) 
	{

		$link = '';

		if ($page > 1) 
		{

			$url = preg_replace('/page=\d*/', 'page=' . ($page-1), $_SERVER['REQUEST_URI'], -1, $count);

			if ($count == 0) {

				$url = preg_replace('/\.php\?/', '.php?page=' . ($page-1) . '&', $_SERVER['REQUEST_URI'], -1, $count);

				if ($count == 0) {

					$url = preg_replace('/\.php/', '.php?page=' . ($page-1) . '&', $_SERVER['REQUEST_URI'], -1, $count);

				}

			}

			$link = '<a href="' . $url . '"><li>&laquo; Предишна</li></a>';

		}

		$footer = str_replace('<@previous_page@>', $link, $footer);

		

		$link = '';

		if (strpos($CWD, '/admin') === false)
		{

			$query = "SELECT COUNT(0) AS ESTATES FROM ESTATE E " . $where_clause;

		}
		 else
		{

			$query = "SELECT COUNT(0) AS ESTATES FROM ESTATE E " . $where_clause;;

		}

		$row = $db->fquery($query);
		$num_rows = $row->ESTATES;
		
		if (ceil($num_rows/$results_on_page) > ($page)) 
		{

			$url = preg_replace('/page=\d*/', 'page=' . ($page+1), $_SERVER['REQUEST_URI'], -1, $count);

			if ($count == 0) 
			{

				$url = preg_replace('/\.php\?/', '.php?page=' . ($page+1) . '&', $_SERVER['REQUEST_URI'], -1, $count);

				if ($count == 0) {

					$url = preg_replace('/\.php/', '.php?page=' . ($page+1) . '&', $_SERVER['REQUEST_URI'], -1, $count);

				}

			}

			$link = '<a href="' . $url . '"><li>Следваща &raquo;</li></a>';

		}
		
		/*pagination*/
		$pages_around = 5;
		$num_pages = ceil($num_rows/$results_on_page);
		$pages_list = "";
		for($i=1;$i<=$num_pages;$i++)
		{
			$selected_css = "";
			if($i==$page)
				$selected_css = "class='selected_page'";
			
			$query_str_arr = array();
			if(isset($_SERVER['QUERY_STRING'])&&!empty($_SERVER['QUERY_STRING']))
				parse_str($_SERVER['QUERY_STRING'],$query_str_arr);	
			
			$query_str_arr['page']=$i;							
			$q_str = http_build_query($query_str_arr);
			$pages_from = 1;
			$pages_till = 0;
			if(($page-$pages_around)>0)
			{
				$pages_from = $page-$pages_around;
				$pages_till = $page+$pages_around;
			}
			else
			{
				$pages_from = 0;
				$pages_till = 10;
			}
			if($i>$pages_from&&$i<$pages_till)	
				$pages_list.="<a href='".$_SERVER['PHP_SELF']."?".$q_str."'><li ".$selected_css.">".$i."</li></a>";
			
			
		}
		$footer = str_replace('<@pages_list@>', $pages_list, $footer);
		$footer = str_replace('<@next_page@>', $link, $footer);

	} else {

		$link = '&nbsp;&nbsp;';
		$footer = str_replace('<@next_page@>', $link, $footer);
		$footer = str_replace('<@pages_list@>', $link, $footer);
		$footer = str_replace('<@previous_page@>', $link, $footer);

	}
	
	

	/**

	 * Поставя топ обявите в дясно

	 */

	$footer_body = '';

	$row_template = file_get_contents('./templates/estate_top_offer.html');

	$results_on_page = 8;

	$where_clause = ' WHERE E.IS_ACTIVE = 1 AND E.IS_TOP_OFFER = 1';

	$order_by = ' ORDER BY E.`DATE` DESC';

	

	$query = '

		SELECT

			E.ID AS estate_id,

			T.NAME AS estate_type,

			C.NAME AS estate_category,

			CO.NAME AS estate_construction,

			E.TITLE AS estate_title,

			E.PRICE AS estate_price,

			E.DATE AS estate_date,

			E.PLACE AS estate_place,

			E.DESCRIPTION AS estate_description,

			E.IS_PREFERED AS estate_is_prefered,

			E.IS_TOP_OFFER AS estate_is_top_offer,

			E.IS_ACTIVE AS estate_is_active

		FROM `ESTATE` E

		INNER JOIN `TYPE` T ON T.ID = E.TYPE_ID

		INNER JOIN `CATEGORY` C ON C.ID = E.CATEGORY_ID

		LEFT JOIN `CONSTRUCTION` CO ON CO.ID = E.CONSTRUCTION_ID ' .

		$where_clause . $order_by .

		' LIMIT ' . $results_on_page . '

	';

	$stmt = $db->query($query);

	while ($row = $db->fetchObject($stmt)) {

		$tmp_row_template = $row_template;

		foreach ($row as $key=>$value) {

			$tmp_row_template = str_replace('<@' . $key . '@>', $value, $tmp_row_template);

		}

		

		$image_html = '';

		$query = 'SELECT IMAGE FROM IMAGE WHERE IS_ACTIVE=1 AND ESTATE_ID = ' . $db->realEscapeString($row->estate_id);

		if ($row = $db->fquery($query)) {

			$image_html .= '<img class="topimot" src="/attachments/' . $row->IMAGE . '" width="120" height="80" border="0" />';

		}
		else
		{
			$image_html .= '<img src="images/Logo_bez_snimka.jpg" width="120" height="80" border="0" class="mainfield" />';
		}

		$tmp_row_template = str_replace('<@estate_image@>', $image_html, $tmp_row_template);

		

		$footer_body .= $tmp_row_template;

	}

	

	$footer = str_replace('<@estate_top_offer@>', $footer_body, $footer);

	

	$header = str_replace("<@content_title@>", $title, $header);

	

	echo $header;

	echo $body;

	echo $footer;

	

	