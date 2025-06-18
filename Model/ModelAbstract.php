<?php

abstract class ModelAbstract{
    protected $pdo;

    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=ecommerce_db;port=3308", "root", "",[
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
    }

    public function executerequete($query, $data=[]){
        $stmt = $this->pdo->prepare($query);

        $stmt->execute($data);
        return $stmt;
    }

    public function getAll($table){
        return $this->executerequete("SELECT * FROM $table");
    }

    public function getOne($table, $id){
        return $this->executerequete("SELECT * FROM $table WHERE id = :id", ["id"=>$id]);
    }
   
}