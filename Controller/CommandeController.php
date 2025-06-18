<?php

class CommandeController{
    private $ordMdl;

    public function __construct()
    {
        $this->ordMdl= new CommandeModel;
    }

    public function ordAction(){
        $order = new Commande(0,"","","","");
        

        if(isset($_GET['actionOrd'])){
            extract($_GET);
            $userMdl = new UserModel();

            switch ($actionOrd) {
                case 'order':
                    $orders = $this->ordMdl->findAll();
                    include "Vue/order/index.phtml";
                    break;
                
                case 'new':
                    if(!empty($_POST['date_commande'])){
                        extract($_POST);
                        $order = new Commande(0, $date_commande, $statut, $total_montant, $user);
                        $this->ordMdl->new($order);
                        header("location: ?actionOrd=order");
                        exit;
                    }
                    $users = $userMdl->findAll();

                    include "Vue/order/new.phtml";
                    break;
                
                case 'delete':
                    $this->ordMdl->delete($id);
                    header("location: ?actionOrd=order");
                    exit;
                    break;
                
                case 'update':
                    if (isset($_POST['date_commande'])) {
                        extract($_POST);
                        $order = new Commande($id, $date_commande, $statut, $total_montant, $user);
                        $this->ordMdl->update($order);

                        header("location: ?actionOrd=order");
                        exit;
                    }
                    
                    $order= $this->ordMdl->show($id);
                    include "Vue/order/new.phtml";
                    break;
                
                case 'show':
                    $order = $this->ordMdl->findById($id);

                    include "Vue/order/show.phtml";
                    break;
                    break;
                
                default:
                    # code...
                    break;
            }

        }
    }
}