<?php

class PanierController{
    private $panierMdl;

    public function __construct()
    {
        $this->panierMdl= new PanierModel;
    }

    public function panAction(){
        $panier = new Panier(0,"","","","");
        

        if(isset($_GET['actionPan'])){
            extract($_GET);
            $userMdl = new UserModel();
            $prodMdl = new ProductModel();

            switch ($actionPan) {
                case 'panier':
                    $paniers = $this->panierMdl->findAll();
                    include "Vue/panier/index.phtml";
                    break;
                
                case 'new':
                    if(!empty($_POST['quantite'])){
                        extract($_POST);
                        $panier = new Panier(0, $user, $product, $quantite, $date_ajout);
                        $this->panierMdl->new($panier);
                        header("location: ?actionPan=panier");
                        exit;
                    }
                    $users = $userMdl->findAll();
                    $products = $prodMdl->findAll();

                    include "Vue/panier/new.phtml";
                    break;
                
                case 'delete':
                    $this->panierMdl->delete($id);
                    header("location: ?actionPan=panier");
                    exit;
                    break;
                
                case 'update':
                    if (isset($_POST['quantite'])) {
                        extract($_POST);
                        $panier = new Panier($id, $user, $product, $quantite, $date_ajout);
                        $this->panierMdl->update($panier);

                        header("location: ?actionPan=panier");
                        exit;
                    }
                    
                    $panier= $this->panierMdl->show($id);
                    include "Vue/panier/new.phtml";
                    break;
                
                case 'show':
                    $panier = $this->panierMdl->findById($id);

                    include "Vue/panier/show.phtml";
                    break;
                    break;
                
                default:
                    # code...
                    break;
            }

        }
    }
}