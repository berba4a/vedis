<?php
//$doc_root="D:/SERVER/htdocs/web/vedis/";
$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");
?>
<!DOCTYPE>
<html>
	<head>
		<title>Demo template</title>
		<link type='text/css' rel='stylesheet' href='<?php echo SITE_CSS;?>global.css' />
		<link type='text/css' rel='stylesheet' href='<?php echo SITE_CSS;?>prettify.css' />
		<script src='//code.jquery.com/jquery-1.11.0.min.js'></script>
		<script type='text/javascript' src='<?php echo SITE_JS;?>prettify.js'></script>
		<script type='text/javascript' src='<?php echo SITE_JS;?>jquery.slimscroll.min.js'></script>
		<script type='text/javascript'>
		/*set bottom_link icons division width*/
			$(document).ready(function()
			{
				var width = $('.bottom_link').parent('.lateral_column').css('width');
				$('.bottom_link').css('width',width);
			});
		</script>
		<script type="text/javascript">
		/*set scrollable area height*/
			$(document).ready(function()
			{
				var column_height = parseInt($('.content_column').css('height'));
				var header_height = parseInt($('.content_column h1').css('height'));
				var height = column_height-header_height-55;
			  $('.content_column p').slimScroll({
					height: height,
					color: '#000000'
			  });
			});
		</script>
		<script type='text/javascript'>
			/*change placeholder for search input*/
			$(document).ready(function()
			{
				$('.search_form').find('input[type="radio"]').change(function()
				{
					var radio_value = $('.search_form').find('input[type="radio"]:checked').attr('value');
					var new_value = '';
					if(radio_value=='product')
					{
						new_value = "Продукт";
					}
					if(radio_value=='shop')
					{
						new_value = "Магазин";
					}
					$('.search_form').find('input[type="text"]').attr('placeholder','търси : '+new_value);
				});
			});
		</script>
		<script type='text/javascript'>
			/*rigt side bar vertical accordion*/
			$(document).ready(function()
			{
				/*initial opening of the first ithem*/
				$('.last_models').find('.accordion_link').first().css('background','url(../images/slider_offer_lineUP.png) no-repeat bottom right')
				$('.last_models').find('.accordion_ithem').first().slideDown('slow');
				$('.last_models').find('.accordion_ithem').first().addClass('active');
				
				/*start accorion*/
				$('.last_models').find('.accordion_link').click(function()
				{
					if(!$(this).next().hasClass('active'))
					{
						$('.last_models').find('.accordion_ithem').each(function()
						{
							if($(this).hasClass('active'))
							{
								$(this).slideUp('slow');
								$(this).removeClass('active');
								$(this).prev().css('background','url(../images/slider_offer_lineDOWN.png) no-repeat bottom right');
							}
						});
						
						$(this).next('.accordion_ithem').addClass('active');
						$(this).css('background','url(../images/slider_offer_lineUP.png) no-repeat bottom right');
						$(this).next('.accordion_ithem').slideDown('slow');
					}
				});
			});
		</script>
	</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>content_background2.png' />
			<div class='content_wrapper'>
				<div class='lateral_column'>
					<div class='logo'>
						<span>Vedis</span>
					</div>
					<div class='lateral_menu'>
						<ul>
							<li class='selected'><a href='#'>начало</a></li>
							<li><a href='#'>продукти</a></li>
							<li><a href='#'>магазини</a></li>
							<li><a href='#'>контакти</a></li>
							<li><a href='#'>кариери</a></li>
						</ul>
					</div>
					<div class='bottom_link'>
						<img src='<?php echo SITE_IMG;?>facebook.png' />
						<img src='<?php echo SITE_IMG;?>twitter.png' />
						<img src='<?php echo SITE_IMG;?>google+.png' />
						<img src='<?php echo SITE_IMG;?>linkedin.png' />
					</div>
				</div>
				<div class='content_column'>
					<h1>vedis style</h1>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatu Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatu<br /><br /></p>
				</div>
				<div class='lateral_column'>
					<div class='search_form'>
						<form method='' action='' enctype='multipart-form/data'>
							<input class='main_search' type='text' name='search' id='search' placeholder='търси : Продукт' />
							<a href='javascript:void(0)'>
								<img class='search_arrow' src='<?php echo SITE_IMG;?>search_arrow.png' />
							</a>
							<div class='clear'></div>
							<input type='radio' name='search_type' id='product' value='product' checked />
							<label for='product' > Продукт</label>
							<input type='radio' name='search_type' id='shop' value='shop' />
							<label for='shop' > Магазин</label>
						</form>
					</div>
					<div class='last_models'>
						<h1>Най-нови модели</h1>
						<ul>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Модел 12345</a>
								</div>
								<div class='accordion_ithem'>
									test
								</div>
							</li>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Модел 12345</a>
								</div>
								<div class='accordion_ithem'>
									
								</div>
							</li>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Модел 12345</a>
								</div>
								<div class='accordion_ithem'>
									
								</div>
							</li>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Модел 12345</a>
								</div>
								<div class='accordion_ithem'>
									
								</div>
							</li>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Модел 12345</a>
								</div>
								<div class='accordion_ithem'>
									
								</div>
							</li>
						</ul>
						<div class='bottom_link text_right'>
							<a href='' >&raquo; Виж всички модели</a>
						</div>
					</div>
				</div>
				<div class='clear'></div>
			</div>
		</div>
	</body>
</html>