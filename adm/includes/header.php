<!DOCTYPE>
<html>
	<head>
		<title>Vedis администрация</title>
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
		<meta name="robots" content="noindex, nofollow">
		
		<link type='text/css' rel='stylesheet' href='<?php echo ADMIN_CSS;?>admin.css' />
		<script src='//code.jquery.com/jquery-1.11.0.min.js'></script>
		<script type='text/javascript' src='<?php echo ADMIN_JS;?>drags.js'></script>
		<script type='text/javascript' src='<?php echo ADMIN_JS;?>global.js'></script>
	</head>
	<body>
		<div class='main_wrapper'>
			<div class='content_wrapper'>
				<header>
					<span class='name'>Vedis</span><br />
					<span class='subname'>администрация</span>
					<div class='menu'>
						<ul>
							<?php 
								$sel_products = "";
								$sel_shops = "";
								if(isset($_GET['table']))
								{
									if($_GET['table']=='products')
										$sel_products = "class='selected'";
									
									if($_GET['table']=='shops')
										$sel_shops = "class='selected'";
										
								}
							?>
							<li><a <?php echo $sel_products;?> href='<?php echo SITE_URL.ADMIN;?>pages?table=products'>Продукти</a></li>
							<li><a <?php echo $sel_shops;?> href='<?php echo SITE_URL.ADMIN;?>pages?table=shops'>Магазини</a></li>
						</ul>
						<div class='clear'></div>
					</div>
				</header>						