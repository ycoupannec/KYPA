

<?php

require_once "include/.init.php";
require_once "include/fonction.php";

/*------------------------------------------------------------------------*/
/*declaration des variables*/
/*------------------------------------------------------------------------*/
$sender=$_REQUEST['mailSender'];
$receiver=$_REQUEST['mailReceiver'];
$fileUpload=basename($_FILES['file']['name']);


if (verifChamps($sender, $receiver, $fileUpload)) {
     echo $sender;
     echo $receiver;
     echo $fileUpload;


     if(isset($_FILES['file']))
     { 
          $dossier = 'public/'.creeDossier();
          $fichier = basename($_FILES['file']['name']);
     if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier.'/'.$fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}

}
else {
 echo 'Start again!';  
}














