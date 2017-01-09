<?php
/* Connexion à une base ODBC avec l'invocation de pilote */
define('LOGIN','yohannc');
define('MDP','RJ2q3Cq7QP');
define('ADRESS','127.0.0.1');
define('DB','yohannc');
define('URL_SITE', "http://".$_SERVER['HTTP_HOST']."/KYPA/");


function crypteUrl($str){
	return uniqid().$str.uniqid();
}

function decrypte($str){
	 $str= substr($str, 13, 13);
	 return $str;

}
