<?php

class Product{

    private $id;
    private $nom;
    private $description;
    private $prix;
    private $stock;
    private $categorie;
    private $image;
    private $date_creation;

    public function __construct( $id,  $nom,  $description,  $prix,  $stock,  $categorie,  $image,  $date_creation=[]){
        $this->id = $id;
        $this->nom = $nom;
        $this->description = $description;
        $this->prix = $prix;
        $this->stock = $stock;
        $this->categorie = $categorie;
        $this->image = $image;
        $this->date_creation = $date_creation;}

    
    public function getId() {return $this->id;}

	public function getNom() {return $this->nom;}

	public function getDescription() {return $this->description;}

	public function getPrix() {return $this->prix;}

	public function getStock() {return $this->stock;}

	public function getCategorie() {return $this->categorie;}

	public function getImage() {return $this->image;}

	public function getDateCreation() {return $this->date_creation;}

	
    public function setId( $id): void {$this->id = $id;}

	public function setNom( $nom): void {$this->nom = $nom;}

	public function setDescription( $description): void {$this->description = $description;}

	public function setPrix( $prix): void {$this->prix = $prix;}

	public function setStock( $stock): void {$this->stock = $stock;}

	public function setCategorie( $categorie): void {$this->categorie = $categorie;}

	public function setImage( $image): void {$this->image = $image;}

	public function setDateCreation( $date_creation): void {$this->date_creation = $date_creation;}

	
	

}