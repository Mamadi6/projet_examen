<?php
session_start();

spl_autoload_register(function($classe){
    $page = "Entity/" . $classe . ".php";

    if( file_exists($page) ){
        include $page;
    }else if( file_exists($page =  "Model/" . $classe . ".php") ){
        include $page;
    }else if( file_exists($page =  "Controller/" . $classe . ".php") ){
        include $page;
    }
});

$userCtl = new UserController();
$catCtl = new CategorieController();
$prodCtl = new ProductController();
$ordCtl = new CommandeController();
$accueilCtl = new AccueilController();
$panierCtl = new PanierController();


include_once "Vue/header.phtml";

$userCtl->userAction();
$catCtl->catAction();
$prodCtl->prodAction();
$ordCtl->ordAction();
$accueilCtl->accueilAction();
$panierCtl->panAction();

include_once "Vue/footer.phtml";