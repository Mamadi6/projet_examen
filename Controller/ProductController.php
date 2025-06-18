<?php

class ProductController{
    private $prodMdl;

    public function __construct()
    {
        $this->prodMdl= new ProductModel;
    }

    public function prodAction(){
        $product = new Product(0,"","","","","","","");
        

        if(isset($_GET['actionProd'])){
            extract($_GET);
            $catMdl = new CategorieModel();

            switch ($actionProd) {
                case 'product':
                    $products = $this->prodMdl->findAll();
                    include "Vue/product/index.phtml";
                    break;
                
                case 'new':
                    if(!empty($_POST['nom'])){
                        extract($_POST);
                        $product = new Product(0, $nom, $description, $prix, $stock, $categorie, $image);
                        $this->prodMdl->new($product);
                        header("location: ?actionProd=product");
                        exit;
                    }
                    $categories =$catMdl->findAll();

                    include "Vue/product/new.phtml";
                    break;
                
                case 'delete':
                    $this->prodMdl->delete($id);
                    header("location: ?actionProd=product");
                    exit;
                    break;
                
                case 'update':
                    if (isset($_POST['nom'])) {
                        extract($_POST);
                        $product = new Product($id, $nom, $description, $prix, $stock, $categorie, $image);
                        $this->prodMdl->update($product);

                        header("location: ?actionProd=product");
                        exit;
                    }
                    
                    $product= $this->prodMdl->show($id);
                    include "Vue/product/new.phtml";
                    break;
                
                case 'show':
                    $product = $this->prodMdl->findById($id);

                    include "Vue/product/show.phtml";
                    break;
                    break;
                
                default:
                    # code...
                    break;
            }

        }
    }
}