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
										/*$property_arr = array('Вид продукт'=> $typeID , 'Каталожен номер'=>'catalogueID','Пол'=>$genderID,'Употреба'=>$usageID,'Дата на производство'=>'release_date','Описание'=>'description');*/
										
										echo "<li>";
											echo "<div class='accordion_link'>";
												echo "<a href='javascript:void(0)'>";
													echo "Описание";
												echo "</a>";
											echo "</div>";
											echo "<div class='accordion_ithem left'>";
												echo $product_arr['description'];
											echo "</div>";
										echo "</li>";
										
										echo "<li>";
											echo "<div class='accordion_link'>";
												echo "<a href='javascript:void(0)'>";
													echo "Дата на производство";
												echo "</a>";
											echo "</div>";
											echo "<div class='accordion_ithem left'>";
												echo date('d - m - Y',strtotime($product_arr['release_date']));
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