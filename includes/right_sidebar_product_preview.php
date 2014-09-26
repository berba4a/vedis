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
					<div class='last_models products'>
						<?php
							/*$main_prKey and rest of the primary keys are defined into product_preview.php*/
							if(isset($_GET[$main_prKey])&&""!=$_GET[$main_prKey]&&$_GET[$main_prKey]>0)
							{
								echo "<h1>Детайли</h1>";
									echo "<ul>";
									$product_arr = $db->getById($_GET[$main_prKey],'products');
									if(!empty($product_arr)&&false!==$product_arr)
									{
										$motnhs_arr = array(
											1=>'януари',
											2=>'февруари',
											3=>'март',
											4=>'април',
											5=>'май',
											6=>'юни',
											7=>'юли',
											8=>'август',
											9=>'септември',
											10=>'октомври',
											11=>'ноември',
											12=>'декември'
										);
										
										echo "<li>";
											echo "<div class='accordion_link'>";
												echo "<a href='javascript:void(0)'>";
													echo "Описание";
												echo "</a>";
											echo "</div>";
											echo "<div class='accordion_ithem left scrollable_descr'>";
												echo "<div class='descr'>".$product_arr['description']."<br />&nbsp;</div>";
											echo "</div>";
										echo "</li>";
										
										echo "<li>";
											echo "<div class='accordion_link'>";
												echo "<a href='javascript:void(0)'>";
													echo "Дата на производство";
												echo "</a>";
											echo "</div>";
											echo "<div class='accordion_ithem left'>";
												echo "<span>".date('d',strtotime($product_arr['release_date']))." ".$motnhs_arr[date('n',strtotime($product_arr['release_date']))]." ".date('Y',strtotime($product_arr['release_date']))." година</span>";
											echo "</div>";
										echo "</li>";
										
									}
									else
									{
										echo "<li>";
											echo "<div class='accordion_link'><a href='javascript:void(0)'>Грешка : </a>
											</div>";
											echo "<div class='accordion_ithem left'>";
												echo "Няма продукт с такъв номер!";
											echo "</div>";
										echo "</li>";
									}
									echo "</ul>";
							}
							else 
							 echo "<h1>Невалиден продуктов номер !</h1>";
						?>
					</div>
					<div class='bottom_link text_right'>
						<!--#product_type=1 because for now we have only bags-->
						<a href='<?php echo SITE_URL.SITE_ROOT;?>pages/products.php#product_type=1' >&raquo; Виж всички продукти</a>
					</div>
				</div>