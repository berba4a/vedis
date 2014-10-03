<?php
/*$shops_prKey isset in pages/shops_preview.php script*/
if(isset($_GET[$shops_prKey])&&""!=$_GET[$shops_prKey]&&$_GET[$shops_prKey]>0)
{

}
else
	echo "<h1>Грешка!Невалиден идентификатор на магазин!</h1>";
?>