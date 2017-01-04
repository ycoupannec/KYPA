

<?php

require_once "include/.init.php";
require_once "include/fonction.php";

/*------------------------------------------------------------------------*/
/*declaration des variables*/
/*------------------------------------------------------------------------*/
$sender=$_REQUEST['mailSender'];
$receiver=$_REQUEST['mailReceiver'];
$messageUser=$_REQUEST['message'];
$dateUpload=date('Y-m-d h:i:s');
$nbDay=$_REQUEST['nbDay'];

$fileUpload=basename($_FILES['file']['name']);

//get all uploaded files
/*foreach (basename($_FILES['files']['name']) as $fileUpload => $name) {

}*/

if (verifChamps($sender, $receiver, $fileUpload)) {
     
     if(isset($_FILES['file']))
     { 
          $idDossier=creeDossier();
          $dossierPublic = 'public/'.$idDossier;
          $fichier = basename($_FILES['file']['name']);
          verifFile($_FILES['file']['tmp_name']);
     if(move_uploaded_file($_FILES['file']['tmp_name'], $dossierPublic.'/'.$fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          inserChamps($idDossier,$sender,$receiver,$messageUser,$dateUpload,$nbDay);
          echo 'Upload effectué avec succès !';
          envoieMail($sender, $receiver,$idDossier);
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !'."\r\n";
     }
}

}
else {
    echo 'Upload failed - Start again!';  
}



header('location:../KYPA/index.php?action=envoiMail&id='.crypteUrl($idDossier));



























