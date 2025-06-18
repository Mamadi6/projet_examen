<?php

class CategorieModel extends ModelAbstract{

    public function findAll(){
        $stmt = $this->getAll('categories');
        $tab = [];

        while ($res = $stmt->fetch()) {
            extract($res);
            $tab []=new Categorie($id, $nom, $description);
        }
        return $tab;
    }

    public function new($categorie){
        $query = "INSERT INTO categories (nom, description) VALUES(:nom, :description)";

        $stmt = $this->executerequete($query, [
            "nom"      => $categorie->getNom(),
            "description"      => $categorie->getDescription()
        ]);
    }


    public function delete($identifiant){
        $stmt = $this->executerequete("DELETE FROM categories WHERE id =:id", ["id"=>$identifiant]);
    }

    public function update($categorie){
        $query = "UPDATE categories SET nom =:nom, description =:description WHERE id =:id";
        $data = [
            "nom"         =>$categorie->getNom(),
            "id"         =>$categorie->getId(),
            "description" =>$categorie->getDescription()];
        $stmt = $this->executerequete($query, $data);
    }

    public function show($identifiant){
        $stmt = $this->getOne("categories", $identifiant);

        $res = $stmt->fetch();
        extract($res);
        return new Categorie($id, $nom, $description);
    }

    function findById(int $id){
        $stmt = $this->getOne("categories", $id);

        // fetch retourne une ligne si pas de ligne, null
        $res = $stmt->fetch();
        extract($res);

        return new Categorie($id, $nom, $description);
    }

}