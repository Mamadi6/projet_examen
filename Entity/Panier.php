<?php

class Panier{

    private $id;
    private $user;
    private $product;
    private $quantite;
    private $date_ajout;


    public function __construct( $id,  $user,  $product,  $quantite,  $date_ajout=[]){
        $this->id = $id;
        $this->user = $user;
        $this->product = $product;
        $this->quantite = $quantite;
        $this->date_ajout = $date_ajout;}
	

    public function setId( $id): void {$this->id = $id;}

	public function setUser( $user): void {$this->user = $user;}

	public function setProduct( $product): void {$this->product = $product;}

	public function setQuantite( $quantite): void {$this->quantite = $quantite;}

	public function setDateAjout( $date_ajout): void {$this->date_ajout = $date_ajout;}

	

    public function getId() {return $this->id;}

	public function getUser() {return $this->user;}

	public function getProduct() {return $this->product;}

	public function getQuantite() {return $this->quantite;}

	public function getDateAjout() {return $this->date_ajout;}

	

}