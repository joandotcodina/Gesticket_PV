<?php

class Grup{

    private $_id;
    private $_grup;


    public function __construct($id = null, $grup = null){
        $this->setId($id);
        $this->setGrup($grup);
    }

    public function getId(){
        return $this->_id;
    }
    public function getGrup(){
        return $this->_grup;
    }


    public function setId($id){
        $this->_id = $id;
    }
    public function setGrup($grup){
        $this->_grup = $grup;
    }


}

?>