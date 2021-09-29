<?php

class LoginC{

    private $_id;
    private $_nom;
    private $_usuari;
    private $_correu;
    private $_perfil;
    private $_clau;
    private $_entitat;
    private $_notificacions;


    public function __construct($id = null, $nom = null, $usuari = null, $correu = null, $perfil = null, $clau = null,  $entitat = null, $notificacions = null){
        $this->setId($id);
        $this->setNom($nom);
        $this->setUsuari($usuari);
        $this->setCorreu($correu);
        $this->setPerfil($perfil);
        $this->setClau($clau);
        $this->setEntitat($entitat);
        $this->setNotificacions($notificacions);
    }

    public function getId(){
        return $this->_id;
    }
    public function getNom(){
        return $this->_nom;
    }
    public function getUsuari(){
        return $this->_usuari;
    }
    public function getCorreu(){
        return $this->_correu;
    }
    public function getPerfil(){
        return $this->_perfil;
    }
    public function getClau(){
        return $this->_clau;
    }
    public function getEntitat(){
        return $this->_entitat;
    }
    public function getNotificacions(){
        return $this->_notificacions;
    }


    public function setId($id){
        $this->_id = $id;
    }
    public function setNom($nom){
        $this->_nom = $nom;
    }
    public function setUsuari($usuari){
        $this->_usuari = $usuari;
    }
    public function setCorreu($correu){
        $this->_correu = $correu;
    }
    public function setPerfil($perfil){
        $this->_perfil = $perfil;
    }
    public function setClau($clau){
        $this->_clau = $clau;
    }
    public function setEntitat($entitat){
        $this->_entitat = $entitat;
    }
    public function setNotificacions($notificacions){
        $this->_notificacions = $notificacions;
    }


}

?>