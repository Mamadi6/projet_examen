<?php

class CategorieController{

    private $catMdl;

    public function __construct()
    {
        $this->catMdl =new CategorieModel;
    }

    public function catAction(){
        $categorie= new Categorie(0, "","");

        if (isset($_GET['actionCat'])) {
            extract($_GET);
            
            switch ($actionCat) {
                case 'categorie':
                    $categories = $this->catMdl->findAll();

                    include "Vue/categorie/index.phtml";
                    break;
                
                case 'new':
                    if (!empty($_POST['nom'])) {
                        extract($_POST);
                        $categorie= new Categorie(0, $nom, $description);
                        $this->catMdl->new($categorie);
                        header("location:?actionCat=categorie");
                        exit;
                    } 

                    include "Vue/categorie/new.phtml";
                    break;
                    break;
                
                case 'update':
                    if (isset($_POST['nom'])) {
                        extract($_POST);
                        $categorie = new Categorie($id, $nom, $description);
                        $this->catMdl->update($categorie);
                        header("location: ?actionCat=categorie");
                        exit;
                    }
                    $categorie = $this->catMdl->show($id);
                    include "Vue/categorie/new.phtml";
                    break;
                
                case 'delete':
                    $this->catMdl->delete($id);
                    header("location: ?actionCat=categorie");
                    exit;
                    break;
                
                case 'show':
                    $categorie =$this->catMdl->findById($id);
                    include "Vue/categorie/show.phtml";
                    break;
                
                default:
                    # code...
                    break;
            }

        }

    }

}