<?php 


class AccueilController{




    public function accueilAction(){

        $prodMdl = new ProductModel();

        if( empty($_GET) ){
            $products = $prodMdl->findAll();
            include ("Vue/accueil.phtml");

        }else if( isset($_GET["accueilAction"]) ){
            extract($_GET);

            switch( $accueilAction ){
                case "panier":
                    $product = $prodMdl->show($id);
                    include("Vue/product/show.phtml");
                    // include("Vue/reservation/new.phtml");
                    break;

                
            }
        }
    }

}