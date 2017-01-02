<?php

require_once ".init.php";
require_once "fonction.php";


if(isset($_FILES['file']))
{ 
     $dossier = 'upload/';
     $fichier = basename($_FILES['avatar']['name']);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}












