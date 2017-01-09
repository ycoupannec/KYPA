<?php
/* Connexion à une base ODBC avec l'invocation de pilote */
define('LOGIN','');
define('MDP','');
define('ADRESS','127.0.0.1');
define('DB','');
define('URL_SITE', "http://".$_SERVER['HTTP_HOST']."/KYPA/");


function crypteUrl($str){
	return uniqid().$str.uniqid();
}

function decrypte($str){
	 $str= substr($str, 13, 13);
	 return $str;

}
