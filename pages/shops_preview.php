<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);
$shops_prKey = $db->getPrKey('shops');
$cities_prKey = $db->getPrKey('cities');

$page_title = "Vedis style Преглед на магазин";
include_once('includes/header_meta.php');
?>
	<script type='text/javascript'>
		$(document).ready(function()
		{
			$('.accordion_ithem').each(function()
			{
				if($(this).css('display')=='none')
				{
					$(this).slideDown(50);
				}
			});
			/*$('.accordion_link').click(function()
			{
				$(this).siblings('.accordion_ithem').slideToggle('slow');
			});*/
		});
	</script>
	</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>background_images/shops_back.png' />
			<img class='bg' src='<?php echo SITE_IMG;?>background_images/overlay.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='content_column wider'>
				<?php
				
					$active_shop = false;
					if(isset($_GET[$shops_prKey])&&""!=$_GET[$shops_prKey]&&$_GET[$shops_prKey]>0)
					{	
						$query = "
							SELECT 
							sh.*,c.city_name as city
							FROM shops sh 
							INNER JOIN cities AS c ON c.".$cities_prKey." = sh.".$cities_prKey."
							WHERE ".$shops_prKey." = ".$_GET[$shops_prKey]."
						";
						$sh_stmt = $db->query($query);
						
						/*set values*/
						$val_arr = array('city'=>'','address'=>'','phone'=>'','mail'=>'','web'=>'');
						echo "<a class='back_link' href='".SITE_URL.SITE_ROOT."pages/shops.php' >&laquo; Обратно в списъка</a>";
						if($db->numRows($sh_stmt)>0)
						{
							while($sh_row = $db->fetchObject($sh_stmt))
							{
								if($sh_row->is_active==1)
								{
									$active_shop = true;
									foreach($val_arr as $key=>$val)
									{
										$val_arr[$key] = $sh_row->{$key};
									}
									
									echo "<h1>".$sh_row->name."</h1>";
									echo "<h2>".$sh_row->city."</h2>";
									if(""!=$sh_row->gpsLat&&""!=$sh_row->gpsLon)
									{
										echo "<script src='https://maps.googleapis.com/maps/api/js'></script>";
										echo " <script>
											  function initialize() {
												var mapCanvas = document.getElementById('map_canvas');
												var position = new google.maps.LatLng(".$sh_row->gpsLat.", ".$sh_row->gpsLon.");
												var mapOptions = {
												  center: position,
												  zoom: 16,
												  mapTypeId: google.maps.MapTypeId.ROADMAP
												}
												var map = new google.maps.Map(mapCanvas, mapOptions)
												var marker = new google.maps.Marker({
													position: position,
													map: map,
													title:'".$sh_row->name."'
												});
											 }									  
											  google.maps.event.addDomListener(window, 'load', initialize);
											</script>";
											echo "<div id='map_canvas'></div>";
									}
									else
										echo "<p>Няма налични координати за карта!</p>";
								}
								else
									echo "<h1>Неактивен магазин !</h1>";
							}
						}
						else
							echo "<h1>Няма намерен магазин с този идентификатор!</h1>";
					}
					else
						echo "<h1>Грешка!Невалиден идентификатор на магазин!</h1>";
				?>
				</div>
				<div class='lateral_column'>
					<?php include_once('includes/search_form.php');?>
					<div class='left_content'>
						<?php
							if($active_shop===true)
							{
								echo "<h1>Детайли</h1>";
								echo "<ul>";
									echo "<li>";
										echo "<div class='accordion_link'>";
											echo "<a href='javascript:void(0)'>Адрес</a>";
										echo "</div>";
										echo "<div class='accordion_ithem '>";
											echo "<span>".$val_arr['city'].", ".$val_arr['address']."</span>";
										echo "</div>";
									echo "</li>";
									echo "<li>";
										echo "<div class='accordion_link'>";
											echo "<a href='javascript:void(0)'>Телефон</a>";
										echo "</div>";
										echo "<div class='accordion_ithem '>";
											echo "<span>".$val_arr['phone']."</span>";
										echo "</div>";
									echo "</li>";
									if(""!=$val_arr['mail'])
									{
										echo "<li>";
											echo "<div class='accordion_link'>";
												echo "<a href='javascript:void(0)'>E-mail</a>";
											echo "</div>";
											echo "<div class='accordion_ithem '>";
												echo "<span><a href='mailto:".$val_arr['mail']."'>".$val_arr['mail']."</a></span>";
											echo "</div>";
										echo "</li>";
									}
									if(""!=$val_arr['web'])
									{
										echo "<li>";
											echo "<div class='accordion_link'>";
												echo "<a href='javascript:void(0)'>Уебсайт</a>";
											echo "</div>";
											echo "<div class='accordion_ithem '>";
												$http = "http://";
												if(strpos($val_arr['web'],'http://')!==false)
													$http = "";
													
												echo "<span><a target='_blank' href='".$http.$val_arr['web']."'>".$val_arr['web']."</a></span>";
											echo "</div>";
										echo "</li>";
									}
								echo "</ul>";
							}
							else
								echo "<h1>Грешка!</h1>";
						?>
						<div class='bottom_link text_right'>
							<!--#product_type=1 because for now we have only bags-->
							<a href='<?php echo SITE_URL.SITE_ROOT;?>pages/products.php#product_type=1' >&raquo; Виж всички продукти</a>
						</div>
					</div>
				</div>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>