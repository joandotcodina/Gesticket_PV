<?php

class Ticket{
    
    private $_id;
    private $_nom;
    private $_data;
    private $_estat;
    private $_preu;
    private $_motiu;
    private $_entregatFisic;
	private $_comentarisAdm;
	private $_correu;
	private $_imatge;
    private $_comentariExtraUser;
    private $_nuccorrent;
    private $_comhorebra;
    private $_grup;
    private $_mails;
    
    public function __construct($id = null, $nom = null, $data = null, $estat = null, $preu = null, $motiu = null, $entregatFisic = null, $comentarisAdm = null, $correu = null, $imatge = null, $comentariExtraUser = null, $nuccorrent = null, $comhorebra = null, $grup = null, $mails=null){
        $this->setId($id);
        $this->setNom($nom);
        $this->setData($data);
        $this->setEstat($estat);
        $this->setPreu($preu);
        $this->setMotiu($motiu);
		$this->setEntregatFisic($entregatFisic);
        $this->setComentarisAdm($comentarisAdm);
        $this->setCorreu($correu);
        $this->setImatge($imatge);
        $this->setComentariExtraUser($comentariExtraUser);
        $this->setNuccorrent($nuccorrent);
        $this->setComhorebra($comhorebra);
        $this->setGrup($grup);
        $this->setMails($mails);
    }
    
    public function getId(){
        return $this->_id;
    }
    public function getNom(){
        return $this->_nom;
    }
    public function getData(){
        return $this->_data;
    }
    public function getEstat(){
        return $this->_estat;
    }
    public function getPreu(){
        return $this->_preu;
    }
    public function getMotiu(){
        return $this->_motiu;
    }
	public function getEntregatFisic(){
        return $this->_entregatFisic;
    }
	public function getComentarisAdm(){
        return $this->_comentarisAdm;
    }
    public function getCorreu(){
        return $this->_correu;
    }
    public function getImatge(){
        return $this->_imatge;
    }
    public function getComentariExtraUser(){
        return $this->_comentariExtraUser;
    }
    public function getNuccorrent(){
        return $this->_nuccorrent;
    }
    public function getComhorebra(){
        return $this->_comhorebra;
    }
    public function getGrup(){
        return $this->_grup;
    }
    public function getMails(){
        return $this->_mails;
    }
    
	public function setId($id){
        $this->_id = $id;
    }
    public function setNom($nom){
        $this->_nom = $nom;
    }
    public function setData($data){
        $this->_data = $data;
    }
    public function setEstat($estat){
        $this->_estat = $estat;
    }
    public function setPreu($preu){
        $this->_preu = $preu;
    }
    public function setMotiu($motiu){
        $this->_motiu = $motiu;
    }
	public function setEntregatFisic($entregatFisic){
        $this->_entregatFisic = $entregatFisic;
    }
	public function setComentarisAdm($comentarisAdm){
        $this->_comentarisAdm = $comentarisAdm;
    }
    public function setCorreu($correu){
        $this->_correu = $correu;
    }
    public function setImatge($imatge){
        $this->_imatge = $imatge;
    }
    public function setComentariExtraUser($comentariExtraUser){
        $this->_comentariExtraUser = $comentariExtraUser;
    }
    public function setNuccorrent($nuccorrent){
        $this->_nuccorrent = $nuccorrent;
    }
    public function setComhorebra($comhorebra){
        $this->_comhorebra = $comhorebra;
    }
    public function setGrup($grup){
        $this->_grup = $grup;
    }
    public function setMails($mails){
        $this->_mails = $mails;
    }

}