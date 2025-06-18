<?php 

class PanierModel extends ModelAbstract{

    public function findAll(){
        $userMdl = new UserModel();
        $prodMdl = new ProductModel();
    
        $stmt = $this->getAll('cart_items');
        $tab = [];

        while($res = $stmt->fetch()){
            extract($res);
            $tab[]=new Panier($id, $userMdl->findById($user_id), $prodMdl->findById($product_id), $quantite, $date_ajout);
        }
        return $tab;
    }

    public function new($panier){
        $query ="INSERT INTO cart_items(user_id, product_id, quantite, date_ajout) VALUES(:user, :product, :quantite, :date_ajout)";

        $stmt = $this->executerequete($query, [
            "user"  =>$panier->getUser(),
            "product"  =>$panier->getProduct(),
            "quantite"  =>$panier->getQuantite(),
            "date_ajout"  =>$panier->getDateAjout(),
        ]);
    }

    public function delete($identifiant){
        $query = "DELETE FROM cart_items WHERE id=:id";
        $stmt = $this->executerequete($query,["id"=>$identifiant]);
    }

    public function update($panier){
        $query = "UPDATE cart_items SET user_id =:user, product_id =:product, quantite =:quantite WHERE id =:id";

        $data = [
            "quantite"       =>$panier->getQuantite(),
            "product"    =>$panier->getProduct(),
            "user"   =>$panier->getUser(),
            "id"        =>$panier->getId()];
        $stmt = $this->executerequete($query, $data);
    }

    public function show($identifiant){

        $stmt = $this->getOne("cart_items", $identifiant);

        $res = $stmt->fetch();
        extract($res);
        
        return new Panier($id,$user_id, $product_id, $quantite,$date_ajout);
         
    }

    function findById(int $id){
        $stmt = $this->getOne("cart_items", $id);

        // fetch retourne une ligne si pas de ligne, null
        $res = $stmt->fetch();
        extract($res);

        return new Panier($id,$user_id, $product_id, $quantite,$date_ajout);
    }
    
}