<?php
$doc_root="D:/SERVER/htdocs/web/vedis/";
//$doc_root="C:/xampp/htdocs/web/vedis/";
$old_path =  ini_set("include_path",$doc_root);//ini_get('include_path'). PATH_SEPARATOR .
ini_set("include_path",ini_get('include_path'). $old_path);
include_once("setup/setup.php");

$val_arr = array('name'=>'Име','phone'=>'Телефон','question'=>'Въпрос');

$name = "";
$phone = "";
$question = "";
$err_msg = "Празно поле за" ;
$err=0;
foreach($val_arr as $key=>$value)
{
	if(isset($_GET[$key])&&""!=$_GET[$key])
		${$key} = $_GET[$key];
	else
	{
		$err_msg.= "," .$value;
		$err++;
	}
}
if($err>0)
{
	echo $err_msg." !";
	exit;
}


?>