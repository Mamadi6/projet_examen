<?php

class User{

    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $adresse;
    private $telephone;
    private $date_inscription;

    public function __construct( $id,  $nom,  $prenom,  $email,  $password,  $adresse,  $telephone,  $date_inscription=[]){
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = $password;
        $this->adresse = $adresse;
        $this->telephone = $telephone;
        $this->date_inscription = $date_inscription;}

    public function getId() {return $this->id;}

	public function getNom() {return $this->nom;}

	public function getPrenom() {return $this->prenom;}

	public function getEmail() {return $this->email;}

	public function getPassword() {return $this->password;}

	public function getAdresse() {return $this->adresse;}

	public function getTelephone() {return $this->telephone;}

	public function getDateInscription() {return $this->date_inscription;}

	
    public function setId( $id): void {$this->id = $id;}

	public function setNom( $nom): void {$this->nom = $nom;}

	public function setPrenom( $prenom): void {$this->prenom = $prenom;}

	public function setEmail( $email): void {$this->email = $email;}

	public function setPassword( $password): void {$this->password = $password;}

	public function setAdresse( $adresse): void {$this->adresse = $adresse;}

	public function setTelephone( $telephone): void {$this->telephone = $telephone;}

	public function setDateInscription( $date_inscription): void {$this->date_inscription = $date_inscription;}

	

}