<?php

  //amener la librairie Mustache qui permet de modifier ....
  require_once "include/Mustache/Autoloader.php";
  Mustache_Autoloader::register();
  //appeler .init
  require_once "include/.init.php";
  require_once "include/fonction.php";
  

  
  $sql = new SQLpdo();
  

  //on explique à Mustach qu'on va utiliser comme extension le .html
  $options =  array('extension' => '.html');

  $m = new Mustache_Engine(array(
      'loader' => new Mustache_Loader_FilesystemLoader('template', $options),
  ));

  if (isset($_GET['action']) && $_GET['action'] =="envoiMail"){
    echo $m->render('testPage2');


  }
  elseif (isset($_GET['action']) && $_GET['action'] =="telechargement"){
    echo $m->render('testPage3');
  }
  else{
    echo $m->render('Page1');
    /*print_r(affichContDossier('586a7186b2773'));*/
  }