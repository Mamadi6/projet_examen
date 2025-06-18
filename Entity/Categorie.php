<?php

class Categorie{

    private $id;
    private $nom;
    private $description;


    public function __construct( $id,  $nom,  $description){
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;}
    

    public function getId() {return $this->id;}

	public function getNom() {return $this->nom;}

	public function getDescription() {return $this->description;}

	
    public function setId( $id): void {$this->id = $id;}

	public function setNom( $nom): void {$this->nom = $nom;}

	public function setDescription( $description): void {$this->description = $description;}

	

}