<?php 

class ProductModel extends ModelAbstract{

    public function findAll(){
        $catMdl = new CategorieModel();
    
        $stmt = $this->getAll('products');
        $tab = [];

        while($res = $stmt->fetch()){
            extract($res);
            $tab[]=new Product($id, $nom, $description, $prix, $stock,$catMdl->findById($category_id), $image_url, $date_creation);
        }
        return $tab;
    }

    public function new($product){
        $query ="INSERT INTO products(nom, description, prix, stock, category_id, image_url) VALUES(:nom, :description, :prix, :stock, :categorie, :image)";

        $stmt = $this->executerequete($query, [
            "nom"  =>$product->getNom(),
            "description"  =>$product->getDescription(),
            "prix"  =>$product->getPrix(),
            "stock"  =>$product->getStock(),
            "categorie"  =>$product->getCategorie(),
            "image"  =>$product->getImage()
        ]);
    }

    public function delete($identifiant){
        $query = "DELETE FROM products WHERE id=:id";
        $stmt = $this->executerequete($query,["id"=>$identifiant]);
    }

    public function update($product){
        $query = "UPDATE products SET nom =:nom, description =:description, prix =:prix, stock =:stock, categorie =:categorie, image =:image WHERE id = :id";

        $data = [
            "nom"       =>$product->getNom(),
            "description"    =>$product->getDescription(),
            "prix"     =>$product->getPrix(),
            "stock"   =>$product->getStock(),
            "categorie" =>$product->getCategorie(),
            "image" =>$product->getImage(),
            "id"        =>$product->getId()];
        $stmt = $this->executerequete($query, $data);
    }

    public function show($identifiant){

        $stmt = $this->getOne("products", $identifiant);

        $res = $stmt->fetch();
        extract($res);
        
        return new Product($id, $nom, $description, $prix,$stock, $category_id, $image_url, $date_creation);
         
    }

    function findById(int $id){
        $stmt = $this->getOne("products", $id);

        // fetch retourne une ligne si pas de ligne, null
        $res = $stmt->fetch();
        extract($res);

        return new Product($id, $nom, $description, $prix,$stock, $category_id, $image_url, $date_creation);
    }
    
}