<?php 

class CommandeModel extends ModelAbstract{

    public function findAll(){
        $userMdl = new UserModel();
    
        $stmt = $this->getAll('orders');
        $tab = [];

        while($res = $stmt->fetch()){
            extract($res);
            $tab[]=new Commande($id, $date_commande, $statut, $total_montant,$userMdl->findById($user_id) );
        }
        return $tab;
    }

    public function new($order){
        $query ="INSERT INTO orders(date_commande, statut, total_montant, user_id) VALUES(:date_commande, :statut, :total_montant, :user)";

        $stmt = $this->executerequete($query, [
            "date_commande"  =>$order->getDateCommande(),
            "statut"  =>$order->getStatut(),
            "total_montant"  =>$order->getTotalMontant(),
            "user"  =>$order->getUser(),
        ]);
    }

    public function delete($identifiant){
        $query = "DELETE FROM orders WHERE id=:id";
        $stmt = $this->executerequete($query,["id"=>$identifiant]);
    }

    public function update($order){
        $query = "UPDATE orders SET date_commande =:date_commande, statut =:statut, total_montant =:total_montant, user_id =:user WHERE id =:id";

        $data = [
            "date_commande"       =>$order->getDateCommande(),
            "statut"    =>$order->getStatut(),
            "total_montant"     =>$order->getTotalMontant(),
            "user"   =>$order->getUser(),
            "id"        =>$order->getId()];
        $stmt = $this->executerequete($query, $data);
    }

    public function show($identifiant){

        $stmt = $this->getOne("orders", $identifiant);

        $res = $stmt->fetch();
        extract($res);
        
        return new Commande($id, $date_commande, $statut, $total_montant,$user_id);
         
    }

    function findById(int $id){
        $stmt = $this->getOne("orders", $id);

        // fetch retourne une ligne si pas de ligne, null
        $res = $stmt->fetch();
        extract($res);

        return new Commande($id, $date_commande, $statut, $total_montant,$user_id);
    }
    
}