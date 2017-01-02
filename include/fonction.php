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


function affichContDossier(){
	while(false !== ($fichier = readdir($dossier)))
	{

		if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
		{
			
		}


	}
}

function creeDossier(){
	$idDossier=uniqid();
		// Structure de répertoire désirée
	$structure = './'.$idDossier;

	// Pour créer une stucture imbriquée, le paramètre $recursive 
	// doit être spécifié.

	if (!mkdir($structure, 0777)) {
	    die('Echec lors de la création du répertoire...');
	}
	return $idDossier;
}

function verifChamps(){


}

function envoieMail(){

}

function inserChamps(){

}
