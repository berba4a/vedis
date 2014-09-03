				<div class='lateral_column'>
					<div class='logo'>
						<a href='<?php echo SITE_URL.SITE_ROOT;?>'>Vedis</a>
					</div>
					<div class='lateral_menu'>
						<ul>
							<li><a href='<?PHP ECHO SITE_URL.SITE_ROOT;?>'>начало</a></li>
							<li>
								<a href='javascript:void(0)' class='parent_submenu'><span class='arrow'>&#x25BE;</span> продукти</a>
								<ul>
									<?php 
										$tablename = "product_gender";
										$prKey = $db->getPrKey($tablename);
										$stmt = $db->query(" SELECT * FROM  ".$tablename." ");
										while($row = $db->fetchArray($stmt))
										{
											echo "<li><a href='".SITE_URL.SITE_ROOT."pages/products.php?product_type=1&".$tablename."=".$row[$prKey]."'>".$row['name']."</a></li>";
										}
									?>
								</ul>
							</li>
							<li><a href='<?php echo SITE_URL.SITE_ROOT;?>pages/shops.php'>магазини</a></li>
							<li><a href='<?php echo SITE_URL.SITE_ROOT;?>pages/contacts.php'>контакти</a></li>
							<li><a href='<?php echo SITE_URL.SITE_ROOT;?>pages/careers.php'>кариери</a></li>
						</ul>
					</div>
					<div class='bottom_link'>
						<img src='<?php echo SITE_IMG;?>facebook.png' />
						<img src='<?php echo SITE_IMG;?>twitter.png' />
						<img src='<?php echo SITE_IMG;?>google+.png' />
						<img src='<?php echo SITE_IMG;?>linkedin.png' />
					</div>
				</div>