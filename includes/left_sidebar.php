﻿				<div class='lateral_column'>
					<div class='logo'>
						<a href='<?php echo SITE_URL.SITE_ROOT;?>'>Vedis</a>
					</div>
					<div class='lateral_menu'>
						<ul>
							<li id='home'><a href='<?PHP ECHO SITE_URL.SITE_ROOT;?>'>начало</a></li>
							<li id='product'>
								<a href='javascript:void(0)' class='parent_submenu'><span class='arrow'>&#x25BE;</span> продукти</a>
								<ul>
									<?php 
										$tablename = "product_gender";
										$gender_prKey = $db->getPrKey($tablename);
										$stmt = $db->query(" SELECT * FROM  ".$tablename." ");
										while($row = $db->fetchArray($stmt))
										{
											echo "<li id='#".$tablename."=".$row[$gender_prKey]."'><a class='product_types' href='".SITE_URL.SITE_ROOT."pages/products.php#product_type=1#".$tablename."=".$row[$gender_prKey]."'>".$row['name']."</a></li>";
										}
									?>
								</ul>
							</li>
							<li id='shops'><a href='<?php echo SITE_URL.SITE_ROOT;?>pages/shops.php'>магазини</a></li>
							<li id='contacts'><a href='<?php echo SITE_URL.SITE_ROOT;?>pages/contacts.php'>контакти</a></li>
							<li id='careers'><a href='<?php echo SITE_URL.SITE_ROOT;?>pages/careers.php'>кариери</a></li>
						</ul>
					</div>
					<div class='bottom_link'>
						<img src='<?php echo SITE_IMG;?>facebook.png' />
						<img src='<?php echo SITE_IMG;?>twitter.png' />
						<img src='<?php echo SITE_IMG;?>google+.png' />
						<img src='<?php echo SITE_IMG;?>linkedin.png' />
					</div>
				</div>