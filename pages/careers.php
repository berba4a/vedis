<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$page_title = "Vedis style Кариери";
include_once('includes/header_meta.php');
include_once('includes/slimscroll_scripts.php');
?>
	<script type='text/javascript'>
		$(document).ready(function()
		{
			$('.carr_name').click(function()
			{
				$(this).siblings('p.career_description').slideToggle('slow');
			});
			var column_height = parseInt($('.content_column').css('height'));
			var header_height = parseInt($('.content_column h1').css('height'));
			var height = column_height-header_height-75;
			  $('.scrollable').slimScroll({
					height: height,
					color: '#000000'
			  });
		});
	</script>
	<script type='text/javascript' src='<?php echo SITE_JS;?>right_sidebar_accordeon.js'></script>
	</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>background_images/careers_back.png' />
			<img class='bg' src='<?php echo SITE_IMG;?>background_images/overlay.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='content_column'>
					<h1 class='cir'>кариери</h1>
					<?php 
						$query = "SELECT * FROM careers WHERE is_active = '1' ";
						$careers_stmt = $db->query($query);
						$num_rows = $db->numRows($careers_stmt);
						if($num_rows>0)
						{
							if($num_rows==1)
								$header = "В момента има ".$num_rows." свободна работна позиция";
							if($num_rows>1)
								$header = "В момента има ".$num_rows." свободни работни позиции";
							echo "<h2>".$header."</h2>";
							echo "<div class='scrollable carr'>";
							while($car_row = $db->fetchObject($careers_stmt))
							{
								echo "<div class='career_row'>";
									echo "<span class='carr_name'>".$car_row->name."</span>";
									echo "<p class='career_description'>".$car_row->description."</p>";
								echo "</div>";
							}	
							echo "<br /></div>";
						}
						else
							echo "<h2>В момента няма свободни работни позиции</h2>";
					?>
				</div>
				<?php include_once('includes/right_sidebar.php');?>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>