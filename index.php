<?php

  //amener la librairie Mustache qui permet de modifier ....
  require_once "include/Mustache/Autoloader.php";
  Mustache_Autoloader::register();
  //appeler .init
  require_once "include/.init.php";
  require_once "include/fonction.php";
  

  
  /*$sql = new SQLpdo();*/
  

  //on explique à Mustach qu'on va utiliser comme extension le .html
  $options =  array('extension' => '.html');

  $m = new Mustache_Engine(array(
      'loader' => new Mustache_Loader_FilesystemLoader('template', $options),
  ));

  if (isset($_GET['action']) && $_GET['action'] =="envoiMail" && isset($_GET['id']) && verif_alphaNum($_GET['id']) && strlen ( $_GET['id'])==39){
    $tabM=array('LINK'=>URL_SITE.'index.php?action=telechargement&id='.$_GET['id']);
    echo $m->render('pageReussite',$tabM);


  }
  elseif (isset($_GET['action']) && $_GET['action'] =="telechargement" && isset($_GET['id']) && verif_alphaNum($_GET['id']) && strlen ( $_GET['id'])==39){
    $idDecrypte=decrypte($_GET['id']);

    echo $m->render('page_download',array('FICHIER'=>affichContDossier($idDecrypte)));
  }
  else{
    
    echo $m->render('Page1');
    verifDateDossier();
    

    /*print_r(affichContDossier('586a7186b2773'));*/
  }