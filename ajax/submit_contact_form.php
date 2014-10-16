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
if(isset($_GET['pot'])&&$_GET['pot']=="")
{
	/*check for empty or invalid email values if javascript is skipped*/
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
	
	/*check mail validity if javascript is skipped*/
	if(isset($_GET['mail'])&&""!=$_GET['mail']&&filter_var($_GET['mail'], FILTER_VALIDATE_EMAIL))
		$mail = $_GET['mail'];
	else
		$mail = "";
		
	$subject = "Запитване от автоматична форма на vedis.bg";	
	$headers = ""; 	
	$headers .= "From: ".$_GET['name']."<".$mail.">\n";
	$headers .= "Reply-To: ".$mail."<".$mail.">\n";
	$headers .= "Subject: =?UTF-8?B?".base64_encode($subject)."?=";
	$mail_res = mail(DEFAULT_EMAIL_ADDRESS,"Subject: =?UTF-8?B?".base64_encode($subject)."?=",$_GET['question'],$headers);
	if($mail_res===true)
		echo "<span class='succ_msg'>Вашето запитване беше изпратено успешно.<br /> Благодарим ,че се свързахте с екипа на Vedis.bg !</span><br /><a href='".SITE_URL.SITE_ROOT."pages/contacts.php' style='text-decoration:underline'>&raquo;Изпратете ново запитване</a>";
	else
		echo "<span class='red'>Вашето запитване не е изпратето порати технически проблем!<br /> Mоля свържете се с нас на e-mail :<br /> <a href='mailto:".DEFAULT_EMAIL_ADDRESS."' >".DEFAULT_EMAIL_ADDRESS."</a></span>";
}
else
	echo "Not human attempt for submission! ";
?>