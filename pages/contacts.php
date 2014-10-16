<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

/*database connect object*/
include_once("includes/DBMYSQL.class.php");
$db = new DBMYSQL(DB_HOST,DB_USER,DB_PASS,DB_NAME);

$page_title = "Vedis style";
include_once('includes/header_meta.php');
?>
	<script type='text/javascript'>
		var SITE_URL = '<?php echo SITE_URL;?>';
		var SITE_ROOT = '<?php echo SITE_ROOT;?>';
	</script>
	<script type='text/javascript' src='<?php echo SITE_JS;?>contact_form.js'></script>
	</head>
	<body>
		<div class='main_wrapper'>
			<img class='bg' src='<?php echo SITE_IMG;?>background_images/contacts_back_new.png' />
			<img class='bg' src='<?php echo SITE_IMG;?>background_images/overlay.png' />
			<div class='content_wrapper'>
				<?php include_once('includes/left_sidebar.php');?>
				<div class='content_column'>
					<h1 class='cir'>контакти</h1>
					<span class='response'></span>
					<p>Свържете се с нас чрез автоматичната форма за контакт</p>
					<div id='form'>
						<span class='warning'>Празни или некоректо попълнени полета!</span>
						<form id='contact_form'>
							<span class='red'>*</span><label for='name' id='name_label'> Вашето име :</label><br />
							<input type='text' class='contact mandatory' id='name' name='name' value='' /><br />
							<span class='red'>*</span><label for='phone' id='phone_label'> Вашият телефон :</label><br />
							<input type='text' class='contact mandatory' name='phone' id='phone' value='' />
							<span class='tip'>&nbsp;&nbsp;&nbsp;/въведете само числа/</span><br />
							<span>&nbsp;</span><label for='mail' id='mail_label'> Вашият e-mail :</label><br />
							<span class='warning' id='invalid_email'>&nbsp;/Невалиден e-mail/</span>
							<input type='text' class='contact' name='mail' id='mail' value='' /><span class='tip'>&nbsp;&nbsp;&nbsp;/формат: name@domain.TLD/</span><br />
							<span class='red'>*</span><label for='question' id='question_label'> Вашето запитване :</label><br />
							<textarea class='contact mandatory' id='question' name='question'></textarea>
							<div class='pot'>
								<input type='text' name='pot' id='pot' value='' />
							</div>
							<a class='form_btn right' id='submit_btn' href='javascript:void(0)'>Изпрати</a>
							<a class='form_btn left' id='clear_btn' href='javascript:void(0)'>Изчисти полетата</a>

						</form>
					</div>
					<div class='loading'></div>
				</div>
				
				<div class='lateral_column'>
					<?php include_once('includes/search_form.php');?>
					<div class='left_content'>
						<h1>Свържи се чрез</h1>
						<ul>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Телефон</a>
								</div>
								<div class='accordion_ithem '>
									<span>0123456</span>
								</div>
							</li>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Viber</a>
								</div>
								<div class='accordion_ithem '>
									<span>0123456</span>
								</div>
							</li>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>E-mail</a>
								</div>
								<div class='accordion_ithem '>
									<span><a href='mailto:mail@mail.com'><?php echo DEFAULT_EMAIL_ADDRESS;?></a></span>
								</div>
							</li>
							<li>
								<div class='accordion_link'>
									<a href='javascript:void(0)'>Skype</a>
								</div>
								<div class='accordion_ithem '>
									<span>skype</span>
								</div>
							</li>
						</ul>
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