<?php

/*------------------------------------------------------------------------*/
/*require les variables pour la connexion SQL dans le fichier .ini.php*/
/*------------------------------------------------------------------------*/
require_once "include/Mustache/Autoloader.php";
Mustache_Autoloader::register();
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


function affichContDossier($idDossier){
	$i=0;
	$cheminDossier='public/'.$idDossier;
	if($dossier = opendir($cheminDossier))
	{
		while(false !== ($fichier = readdir($dossier)))
		{

			if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
			{
				$stat=stat( realpath ($cheminDossier.'/'.$fichier));
				$allFichier[]= array('NOM'=>$fichier, 'TAILLE'=> $stat["size"].' octets', 'DATE'=> date ("F d Y H:i:s.", $stat["mtime"]), 'CHEMIN'=>URL_SITE.$cheminDossier.'/'.$fichier);
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
	$old_umask = umask(0);
	if (!mkdir($structure, 0777)) {
		die('Echec lors de la création du répertoire...');
	}
	umask($old_umask);
	return $idDossier;
}

function verifFile($fileUpload){	
$maxFileSize = 1024 * 100; // 100 kB
$tailleFile=filesize($fileUpload);
if ($tailleFile>$maxFileSize) {
	$erreur='file size is too big';
	echo $erreur;
	return false;
}
else {
echo "filesize OK";
return true;
}
}

function verifChamps($sender, $receiver, $fileUpload){

	if ((filter_var($sender, FILTER_VALIDATE_EMAIL)) && (filter_var($receiver, FILTER_VALIDATE_EMAIL)) && $fileUpload){
		echo ("Success"."\n\n");
		return true;
	} else {
		echo ("$failure"."\n\n");
		return false;
	}
}

function envoieMail($sender, $receiver, $idDossier, $messageUser){
	
	$m = new Mustache_Engine();

	$mail=$sender;
	$sujet="Download file";
	$header='';
	$header.= 'From:'.$receiver."\r\n";
	$header.='Reply-to:KAPYBox'."\r\n";
	$header.='X-Mailer: PHP/'.phpversion()."\r\n";
	$header.= 'Content-type: text/html; charset=utf-8'."\r\n";
	$dir = URL_SITE.'index.php?action=telechargement&id='.crypteUrl($idDossier);
	ini_set('display_error','on');
	error_reporting (E_ALL);
	$contenuMail=file_get_contents('./template/mail.html');     
	
	
    //Envoi de l'e-mail
	

	$message = $m->render($contenuMail,array('LIEN'=>$dir));

	if (mail($mail,$sujet,$message,$header)==false){
		
	}
}

function inserChamps($idDossier,$mailEmetteur,$mailRecepteur,$messageUser,$dateUpload,$nbDay){

	echo $idDossier; echo $mailEmetteur; echo $mailRecepteur; echo $messageUser; echo $dateUpload; echo $nbDay;

	if ($idDossier != ""){
		$sql= new SQLpdo();
		$idGen=$sql->insert("INSERT INTO `kypaLink` (idDossier, mailEmetteur, mailRecepteur, message, dateUpload, nbDay) VALUES (:idDossier, :mailEmetteur, :mailRecepteur, :message, :dateUpload, :nbDay);",
			array(":idDossier" => $idDossier,':mailEmetteur'=> $mailEmetteur, ':mailRecepteur'=> $mailRecepteur, ':message' => $messageUser, ':dateUpload'=>$dateUpload, ':nbDay'=>$nbDay));
	}
}
function verif_alphaNum($str){
    preg_match("/([^A-Za-z0-9])/",$str,$result);
//On cherche tt les caractères autre que [A-Za-z] ou [0-9]
    if(!empty($result)){//si on trouve des caractère autre que A-Za-z ou 0-9
        return false;
    }
    return true;
}

function dateCompar($dateOrig,$nbJour){
	
	$dateSQL = new DateTime($dateOrig);
	$dateSQL->add(new DateInterval('P'.$nbJour.'D'));
	$dateActu=new DateTime();
	if ($dateSQL>=$dateActu){
		/*à supprimer*/
		return true;	
	}
	return false;	
	
}

function litEnregSQL(){
	$sql= new SQLpdo();
	$contenu=$sql->fetchAll("SELECT * FROM `kypaLink`;");
	return $contenu;
}


function supprFich($dir) { 
   $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? supprFich("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
} 

function verifDateDossier(){

	$tabDossiers=litEnregSQL();
	foreach ($tabDossiers as $tabDossier) {
		if (dateCompar($tabDossier['dateUpload'],$tabDossier['nbDay'])==false){
			echo $tabDossier['idDossier'];
			supprFich('./public/'.$tabDossier['idDossier']);
			$sql= new SQLpdo();
			$sql->insert("DELETE FROM `kypaLink` WHERE kypaLink.idDossier =:idDossier ;",array(":idDossier" => $tabDossier['idDossier']));

		}
	}
	
}