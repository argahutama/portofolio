<?php 
	date_default_timezone_set('Europe/Bucharest');//or change to whatever timezone you want
	$site_url = "http://digitalreputation.ro/portofoliu";
	define('base_url','http://digitalreputation.ro/portofoliu');
	function url_slug($str, $replace=array(), $delimiter='-', $maxLength=200) {
	if( !empty($replace) ) {
		$str = str_replace((array)$replace, ' ', $str);
	}

	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("%[^-/+|\w ]%", '', $clean);
	$clean = strtolower(trim(substr($clean, 0, $maxLength), '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

	return $clean;
}



	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";





	$nameSite = "portofoliu";
   /*date acces email pt trimite de mesaje*/
	$server_trimite_email="localhost";
	$email_trimite_email="argahut@gmail.com";
	$parola_trimite_email='T&]9v$5u~uiu';
	$alt_trimite_email="joftalmologie1";
	$email_administrator="argahut@gmail.com";
	$catreName = "Administrator";

 ?>



	
<?php
//reCAPTCHA ionut formular offers
define('SITE_KEY',"6Le7ufUUAAAAADNB1GnuN_E8H1GqmGahuBdgeZfr"); 
define('SECRET_KEY',"6Le7ufUUAAAAAHJHq47QSx9e-BlNzb_co_EbOHl3");
?>