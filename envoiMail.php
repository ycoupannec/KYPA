<p> Nom : <?php echo $_REQUEST['mailSender']; ?>  </p>
<p> Email : <?php echo $_REQUEST['mailReceiver']; ?>  </p>

<?php

require_once "include/.init.php";
require_once "include/fonction.php";
/*print_r($_FILES['file']);*/
/*print_r($_FILES); */

if(isset($_FILES['file']))
{ 
     $dossier = 'public/'.creeDossier();
     $fichier = basename($_FILES['file']['name']);
     echo $fichier;
     if(move_uploaded_file($_FILES['file']['tmp_name'], $dossier.'/'.$fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}




/*$nberreur=0;
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
*/










