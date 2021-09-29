<?php

class Usuari{

    private $_id;
    private $_nom;
    private $_correu;


    public function __construct($id = null, $nom = null, $correu = null){
        $this->setId($id);
        $this->setNom($nom);
        $this->setCorreu($correu);
    }

    public function getId(){
        return $this->_id;
    }
    public function getNom(){
        return $this->_nom;
    }
    public function getCorreu(){
        return $this->_correu;
    }


    public function setId($id){
        $this->_id = $id;
    }
    public function setNom($nom){
        $this->_nom = $nom;
    }
    public function setCorreu($correu){
        $this->_correu = $correu;
    }


}

?>