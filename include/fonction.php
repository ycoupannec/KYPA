<?php

/*------------------------------------------------------------------------*/
	/*require les variables pour la connexion SQL dans le fichier .ini.php*/
/*------------------------------------------------------------------------*/

require_once ".init.php";





 /*------------------------------------------------------------------------*/
				/*Class SQLpdo pour les requetes de bases*/
/*------------------------------------------------------------------------*/
class SQLpdo {
	function __construct(){

		try {
		    $this->db = new PDO('mysql:dbname='.DB.';host='.ADRESS.'',LOGIN,MDP);
		} catch (PDOException $e) {
		    echo 'Connexion échouée : ' . $e->getMessage();
		}

	}

	function fetchAll($sql,$execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requette sql
	    return $sth->fetchAll(PDO::FETCH_ASSOC);// recupère toutes les données
	}

	function insert($sql, $execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requette sql
	    return  $this->db->lastInsertId();// recupère toutes les données
	}

	function fetch($sql,$execute=null){
		$sth = $this->db->prepare($sql);//prepare SQL request
	    $sth->execute($execute);//execute la requette sql
	    return $sth->fetch(PDO::FETCH_ASSOC);// recupère toutes les données
	}
}

/*------------------------------------------------------------------------*/
					/*Exemple utilisation class SQLpdo*/
/*------------------------------------------------------------------------*/

function insertImg($img,$textTop,$textBot,$clrTop=null,$clrBot=null,$sizeTop=null,$sizeBot=null,$id, $type){
	
	$sql= new SQLpdo();
	$idGen=$sql->insert("INSERT INTO `memeGenerate` ( url, textTop, textBot, clrTop, clrBot, sizeTop, sizeBot, ID_memeImage, ID_type) VALUES ( :url, :textTop, :textBot, :clrTop, :clrBot, :sizeTop, :sizeBot, :ID_memeImage, :type)",
		array(":url" => $img,':textTop'=> $textTop, ':textBot'=> $textBot, ':clrTop'=> $clrTop, ':clrBot'=> $clrBot, ':sizeTop'=> $sizeTop, ':sizeBot'=> $sizeBot, ':ID_memeImage'=> $id, ':type' => $type ));

	

	return $idGen;
}


function affichContDossier($idDossier){
	$i=0;
	$cheminDossier='public/'.$idDossier;
	if($dossier = opendir($cheminDossier))
	{
		while(false !== ($fichier = readdir($dossier)))
		{

			if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
			{
				$allFichier[$i]=$fichier;
				$i++;
			}			
		}
		if ($i>0){
			return $allFichier;	
		}
	}
	return false;
	
}

function creeDossier(){
	$idDossier=uniqid();
		// Structure de répertoire désirée
	$structure = './public/'.$idDossier;


	// Pour créer une stucture imbriquée, le paramètre $recursive 
	// doit être spécifié.

	if (!mkdir($structure, 0777)) {
	    die('Echec lors de la création du répertoire...');
	}
	return $idDossier;
}

function verifChamps($sender, $receiver, $fileUpload){

if ($sender && $receiver && $fileUpload){
return true;
} else {
return false;
}
}

function envoieMail(){

$nberreur=0;
$nberreurmessage="Les champs erreur sont: \n";
$serveur=false;

$mail='aude.f@codeur.online';
$sujet="Formulaire";
$header='';
$header.= 'From: aude <aude.f@codeur.online>'."\r\n";
$header.='Reply-to:aude.f@codeur.online'."\r\n";
$header.='X-Mailer: PHP/'.phpversion()."\r\n";
$header.= 'Content-type: text/plain; charset=utf-8'."\r\n";

ini_set('display_error','on');
error_reporting (E_ALL);


if($_REQUEST['Nom']==""){
     $nberreur++;
     $nberreurmessage=$nberreurmessage."nom \n";
     $serveur=true;

}

if(($_REQUEST['Email']=="") || (!filter_var($_REQUEST['Email'], FILTER_VALIDATE_EMAIL))){
     $nberreur++;
     $nberreurmessage=$nberreurmessage."\n email \n";
     $serveur=true;
}


if ($serveur==true){
     echo "Le nombre d'erreur est \n".$nberreurmessage."\n";
     echo $nberreurmessage;
}

else {

          //Envoi de l'e-mail
     $message='Le formulaire a été rempli. Voici les informations: 
     Nom: '.$_REQUEST['Nom'].'
     Courriel:'.$_REQUEST['Email'];


     mail($mail,$sujet,$message,$header);

}    




}

function inserChamps($idDossier,$mailEmetteur,$mailRecepteur){
	if ($idDossier!=""){
		$sql= new SQLpdo();
		$idGen=$sql->insert("INSERT INTO `kypaLink` (`idDossier`, `mailEmetteur`, `mailRecepteur`) VALUES (':idDossier', ':mailEmetteur', ':mailRecepteur');",
		array(":idDossier" => $idDossier,':mailEmetteur'=> $mailEmetteur, ':mailRecepteur'=> $mailRecepteur));
	}
}
