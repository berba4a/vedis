<?php
if (!defined("CONSTANTS"))
{
    if ( !defined('PATH_SEPARATOR') ) define('PATH_SEPARATOR', ( substr(PHP_OS, 0, 3) == 'WIN' ) ? ';' : ':');
     
    define('DB_HOST', '127.0.0.1'); 
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'vedis');
    define('DB_PORT', '3306');
    define('DB_TYPE', 'MySQLiO');
    $site_path = realpath(dirname(__FILE__)) . '/..';
	define('HTDOCS', $site_path);
    //$docroot="C:/xampp/htdocs/web/vedis/";
	$doc_root="D:/SERVER/htdocs/web/vedis/";
	 
    define("DIR_SEP","/" ); 
    define("SEP", ( substr(PHP_OS, 0, 3) == 'WIN' ) ? "\\" : "/");
    
    define ("SITE_URL","http://localhost"); //www.sete.gr // url
    //define ("COOKIE_DOMAIN", ".localhost"); // domain name here with dot before it
  
	 //define ("SITE_ROOT","/web/vedis/");
	define ("SITE_ROOT","/web/vedis/");
    //define ("SITE_ROOT","/");      // site folder if site is in the root leave it /
    
	define ("DOC_ROOT",$doc_root);  // feiNew
    define ("FILES_FOLDER",DOC_ROOT."fileuploads".DIR_SEP);
	define ("PRODUCT_IMAGES",FILES_FOLDER."product_images".DIR_SEP);
	
    // remove this below and uncomment 4 lines above if you move to live
    
    /*start dev - will be removed after going live*/
    /*
     define ("SITE_URL","http://ixpander.com"); // url
    define ("COOKIE_DOMAIN", ".ixpander.com"); // domain name here with dot before it
    define ("SITE_ROOT","/sete.gr/");      //  site folder if site is in the root leave it /
    define ("DOC_ROOT",$docroot);  // feiNew
    */
    /*end dev*/
   // define ("SITE","/"); // needed for proper admin modules include,  added for SETE because of Win server' setting 
    define ("SITE_CSS", SITE_ROOT."css/"); 
	define ("SITE_JS", SITE_ROOT."js/");    	
    define ("SITE_UPOLADS", SITE_ROOT."fileuploads/");
	
	
    define ("SITE_IMG", SITE_ROOT."images/");
    //define ("DEFAULT_EMAIL_ADDRESS", "info@sete.gr");   
	define ("DEFAULT_TABLE","products");
	
	/*admin*/
	define ("ADMIN" , SITE_ROOT."adm/");
	define ("ADMIN_CSS" , ADMIN."css/");
	define ("ADMIN_JS" , ADMIN."js/");
	define ("ADMIN_AJAX" , ADMIN."ajax/");
	define ("ADMIN_IMAGES" , ADMIN."images/");
}
?>