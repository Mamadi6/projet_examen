<?php

class Commande{

    private $id;
    private $date_commande;
    private $statut;
    private $total_montant;
    private $user;

    public function __construct( $id, $date_commande,  $statut,  $total_montant,  $user){
        $this->id = $id;
        $this->date_commande = $date_commande;
        $this->statut = $statut;
        $this->total_montant = $total_montant;
        $this->user = $user;}
    
	
    public function getId() {return $this->id;}

	public function getDateCommande() {return $this->date_commande;}

	public function getStatut() {return $this->statut;}

	public function getTotalMontant() {return $this->total_montant;}

	public function getUser() {return $this->user;}

	
    public function setId( $id): void {$this->id = $id;}

	public function setDateCommande( $date_commande): void {$this->date_commande = $date_commande;}

	public function setStatut( $statut): void {$this->statut = $statut;}

	public function setTotalMontant( $total_montant): void {$this->total_montant = $total_montant;}

	public function setUser( $user): void {$this->user = $user;}

	
}