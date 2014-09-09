				<div class='lateral_column'>
					<div class='search_form'>
						<form method='GET' action='' enctype='multipart-form/data'>
							<input class='main_search' type='text' name='search' id='search' placeholder='търси : Продукт' />
							<a id='form_submit' href='javascript:void(0)'>
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
						<?php include_once("includes/last_five.php");?>
						<div class='bottom_link text_right'>
							<!--#product_type=1 because for now we have only bags-->
							<a href='<?php echo SITE_URL.SITE_ROOT;?>pages/products.php#product_type=1' >&raquo; Виж всички продукти</a>
						</div>
					</div>
				</div>