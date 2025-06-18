<?php

class UserModel extends ModelAbstract
{

    public function findAll(){

        $stmt = $this->getAll('users');
        $tab = [];

        while ($res = $stmt->fetch()) {
            extract($res);
            $tab[] = new User($id, $nom, $prenom, $email, $password, $adresse, $telephone, $date_inscription);
            
        }
        return $tab;
    }

    public function new($user){
        $query = "INSERT INTO users (nom, prenom, email, password, adresse, telephone) VALUES(:nom, :prenom, :email, :password, :adresse, :telephone)";

        $stmt = $this->executerequete($query, [
            "nom"      => $user->getNom(),
            "prenom"      => $user->getPrenom(),
            "email"      => $user->getEmail(),
            "password"      => $user->getPassword(),
            "adresse"      => $user->getAdresse(),
            "telephone"      => $user->getTelephone()
        ]);
    }

    public function update($user){
        $query = "UPDATE users SET nom =:nom, prenom =:prenom, email =:email, adresse =:adresse, telephone =:telephone WHERE id = :id";

        $data = [
            "nom"       =>$user->getNom(),
            "prenom"    =>$user->getPrenom(),
            "email"     =>$user->getEmail(),
            "adresse"   =>$user->getAdresse(),
            "telephone" =>$user->getTelephone(),
            "id"        =>$user->getId()];
        $stmt = $this->executerequete($query, $data);
    }

    public function show($identifiant){

        $stmt = $this->getOne("users", $identifiant);

        $res = $stmt->fetch();
        extract($res);
        
        return new User($id, $nom, $prenom, $email,$password, $adresse, $telephone, $date_inscription);
         
    }

    public function delete($identifiant){
        $stmt = $this->executerequete("DELETE FROM users WHERE id =:id", ["id"=>$identifiant]);
    }

    function findById(int $id){
        $stmt = $this->getOne("users", $id);

        // fetch retourne une ligne si pas de ligne, null
        $res = $stmt->fetch();
        extract($res);

        return new User($id, $nom, $prenom, $email, $password, $adresse, $telephone, $date_inscription);
    }

    public function connexion(string $login, $mdpForm){
        
        $stmt = $this->executerequete("SELECT * FROM users WHERE email = :email AND password=:password", ["email" => $login, "password" =>$mdpForm]);


        // TEST si on a une ligne récupérée par le 'login'
        if( $stmt->rowCount() ){
            extract($stmt->fetch());

            // TEST si le mdp de la BD est égal celui du mdpFormulaire
            if( password_verify($mdpForm, $password) ){
                //On retourne un 'USER'
                $user = $this->findById($id);  
                return $user;
            }
        }

        // Si LOGIN et MDP pas correctes, on retourne NULL
        return null;
    }
    
}
