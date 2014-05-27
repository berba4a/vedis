<?php
/*check if $_GET is properly passed if no redirects to home*/
if(!isset($_GET['table'])||!in_array($_GET['table'],$tables_arr))
	header('location:'.SITE_URL.ADMIN.'');


if(isset($_GET['action'])&&(trim($_GET['action']) == 'add'|| trim($_GET['action'])=='edit'))
{
	echo "Creating form";
}
else
	header('location:'.SITE_URL.ADMIN.'?table='.$_GET['table'].'');
?>