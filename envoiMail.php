

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
$nbError=0;
$messgeError="Sorry, upload failed: ";


/* $_FILES['files']
foreach ($_FILES['files'] as $key => $value) {
     # code...
}
*/

$fileUpload=basename($_FILES['file']['name']);

//get all uploaded files
/*foreach (basename($_FILES['files']['name']) as $fileUpload => $name) {

}*/

if (verifChamps($sender, $receiver, $fileUpload, $nbDay)) {
     
     if(isset($_FILES['file']))
     { 
          $idDossier=creeDossier();
          $dossierPublic = 'public/'.$idDossier;
          $fichier = basename($_FILES['file']['name']);
          
          if (verifFile($_FILES['file']['tmp_name'])) {

                if(move_uploaded_file($_FILES['file']['tmp_name'], $dossierPublic.'/'.$fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
               {
                    if (inserChamps($idDossier,$sender,$receiver,$messageUser,$dateUpload,$nbDay)==false){
                         $messgeError.="Failed when we add all information in Data bases. ";
                         $nbError++;
                    }
                    
                    
                    if (envoieMail($sender, $receiver,$idDossier, $messageUser)==false){
                         $messgeError.="Failed when we send the mail. ";
                         $nbError++;
                    }
                    if (envoieMail($receiver, $receiver,$idDossier, $messageUser,'./template/mailRecpt.html')==false){
                         $messgeError.="Failed when we send the mail. ";
                         $nbError++;
                    }
               }
               else //Sinon (la fonction renvoie FALSE).
               {
                    $messgeError.= 'Upload failed';
                    $nbError++;
               }


          }else
          {
               $messgeError.="The file's too big. ";
               $nbError++;
          }
     }else
     {
          $messgeError.="Failed to find the file. ";
          $nbError++;
     }

}
else {
    $messgeError.="Missed information. ";
    $nbError++;
}
/*echo $nbError;
exit;*/
if ($nbError===0){
     header('location:../KYPA/index.php?action=envoiMail&id='.crypteUrl($idDossier));     
}else{
     header('location:../KYPA/index.php?action=envoiMail&id='.crypteUrl($idDossier).'&messgeError='.$messgeError);
}




























