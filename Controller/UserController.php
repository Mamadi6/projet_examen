<?php

class UserController{

    private $userMdl;

    public function __construct()
    {
        $this->userMdl =new UserModel;
    }

    public function userAction(){
        $user = new User(0,"", "", "","", "", "","");

        if (isset($_GET['actionUser'])) {
            extract($_GET);
           
            switch ($actionUser) {
                case 'user':
                    $users = $this->userMdl->findAll();

                    include "Vue/user/index.phtml";
                    break;
                
                case 'new':
                    if (!empty($_POST['email'])) {
                        extract($_POST);
                        $user= new User(0, $nom, $prenom, $email, $password, $adresse, $telephone);
                        $this->userMdl->new($user);
                        header("location:?actionUser=user");
                        exit;
                    }

                    include "Vue/user/new.phtml";
                    break;
                
                case 'update':
                    if (isset($_POST['email'])) {
                        extract($_POST);
                        $user = new User($id, $nom, $prenom, $email, $password, $adresse, $telephone);
                        $this->userMdl->update($user);

                        header("location: ?actionUser=user");
                        exit;
                    }
                    
                    $user= $this->userMdl->show($id);
                    include "Vue/user/new.phtml";
                    break;
                
                case 'delete':
                    $this->userMdl->delete($id);
                    header("location: ?actionUser=user");
                    exit;
                    break;
                
                case 'show':
                    $user = $this->userMdl->findById($id);

                    include "Vue/user/show.phtml";
                    break;
                
                case 'deconnexion':
                    session_destroy();
                    header("location: ?actionUser=connexion");
                    exit;
           

                case "inscription":
                    
                    if( isset($_POST['nom']) ){
                        extract($_POST);
                        $user= new User(0, $nom, $prenom, $email, $password, $adresse, $telephone);
                        $this->userMdl->new($user);
                        header("location: ?actionUser=connexion");
                        exit;
                        }

                    include "Vue/user/inscription.phtml";
                    break;


                case 'connexion':

                    if( isset($_POST['email']) ){
                        // user = un user si login et mdp OK, sinon NULL
                        $user = $this->userMdl->connexion($_POST['email'], $_POST['password']);
                        header("location: .");
                        exit;
                    }
                
                    include "Vue/user/connexion.phtml";
                    break;
                
                    
                default:
                    # code...
                    break;
            }
        }
    }
}