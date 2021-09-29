<?php

require_once(__DIR__.'/../model/Ticket.php');
require_once(__DIR__.'/../model/db/TicketBD.php');


class IndexController{
    
    public function getLlistat(){
        $jdb = new TicketBD();
        return $jdb->getAll();
    }
    public function getLlistatFull(){
        $jdb = new TicketBD();
        return $jdb->getAllFull();
    }

    public function getLlistatAdvance($start_from,$results_per_page){
        $jdb = new TicketBD();
        return $jdb->getLlistatAdvance2($start_from,$results_per_page);
    }
    public function getPages(){
        $jdb = new TicketBD();
        return $jdb->getPages2();
    }
    public function getPagesS($value){
        $jdb = new TicketBD();
        return $jdb->getPagesS2($value);
    }

    public function nouTicketA($nom = null, $correu = null, $quantitat = null, $motiu = null, $imatge = null, $comhorebra = null, $nuccorrent = null, $grup = null, $mails=null){
        $jdb = new TicketBD();
        return $jdb->nouTicketA2($nom, $correu, $quantitat, $motiu, $imatge, $comhorebra, $nuccorrent, $grup, $mails);
    }

    public function getTicketById($id = null){
        if($id == null){
            return null;
        }
        $jdb = new TicketBD();
        return $jdb->getTicketById2($id);
    }

    public function modificarComentari($id,$comentari){
        $jdb = new TicketBD();
        return $jdb->modificarComentari2($id,$comentari);
    }

    public function modificarComentariV2($id,$nom,$preu,$motiu,$comentari,$comhorebra,$nuccorrent){
        $jdb = new TicketBD();
        return $jdb->modificarComentariV22($id,$nom,$preu,$motiu,$comentari,$comhorebra,$nuccorrent);
    }

    public function modificarTicketAdm($id,$estat,$efisicament,$comentariAdmin,$comhorebra,$nuccorrent,$grup){
        $jdb = new TicketBD();
        return $jdb->modificarTicketAdm2($id,$estat,$efisicament,$comentariAdmin,$comhorebra,$nuccorrent,$grup);
    }
    public function deleteTiquet($id){
        $jdb = new TicketBD();
        return $jdb->deleteTiquet($id);
    }


    //GESTIÓ D'USUARIS
    public function beforeNouUsuari($usuari){
        $jdb = new TicketBD();
        return $jdb->beforeNouUsuari2($usuari);
    }
    public function beforeNouUsuariName($nom){
        $jdb = new TicketBD();
        return $jdb->beforeNouUsuariName2($nom);
    }
    public function nouUsuari($nom = null, $correu = null){
        $jdb = new TicketBD();
        return $jdb->nouUsuari2($nom, $correu);
    }

    public function getPagesU(){
        $jdb = new TicketBD();
        return $jdb->getPagesU2();
    }
    public function getLlistatUsuarisOldW(){
        $jdb = new TicketBD();
        return $jdb->getLlistatUsuarisOldW2();
    }

    public function getLlistatUsuaris($start_from,$results_per_page){
        $jdb = new TicketBD();
        return $jdb->getLlistatUsuaris2($start_from,$results_per_page);
    }

    public function getUsuariById($id = null){
        if($id == null){
            return null;
        }
        $jdb = new TicketBD();
        return $jdb->getUsuariById2($id);
    }

    public function modificarUsuariAdm($id,$nom,$correu){
        $jdb = new TicketBD();
        return $jdb->modificarUsuariAdm2($id,$nom,$correu);
    }

    public function deleteUser($id = null){
        if($id == null){
            return null;
        }
        $jdb = new TicketBD();
        return $jdb->deleteUser2($id);
    }


    /* GESTIONS ADMINS */
    public function modificarPerfilAdmin($id,$nom,$correu){
        $jdb = new TicketBD();
        return $jdb->modificarPerfilAdmin2($id,$nom,$correu);
    }

    public function getLlistatUsuarisAdm(){
        $jdb = new TicketBD();
        return $jdb->getLlistatUsuarisAdm2();
    }
    public function getUsuariAdminById($id){
        $jdb = new TicketBD();
        return $jdb->getUsuariAdminById2($id);
    }
    public function modificarPerfilAdm($id,$nom,$correu,$usuari,$perfil){
        $jdb = new TicketBD();
        return $jdb->modificarPerfilAdm2($id,$nom,$correu,$usuari,$perfil);
    }
    public function deleteUserAdmin($id = null){
        if($id == null){
            return null;
        }
        $jdb = new TicketBD();
        return $jdb->deleteUserAdmin2($id);
    }
    public function nouUsuariLogin($nom, $correu, $usuari,$clau1,$perfil){
        $jdb = new TicketBD();
        return $jdb->nouUsuariLogin2($nom, $correu, $usuari,$clau1,$perfil);
    }

    public function beforeNouUsuariLogin($usuari){
        $jdb = new TicketBD();
        return $jdb->beforeNouUsuariLogin2($usuari);
    }
    public function novaClauUsuari($id, $clau1){
        $jdb = new TicketBD();
        return $jdb->novaClauUsuari2($id, $clau1);
    }

    /* GESTIO NOTIFICACIONS */
    public function searchCorreu($nom){
        $jdb = new TicketBD();
        return $jdb->searchCorreu2($nom);
    }
    public function canviarNoti($opcio,$id){
        $jdb = new TicketBD();
        return $jdb->canviarNoti2($opcio,$id);
    }
    public function getLlistatUsuarisMail($entitat){
        $jdb = new TicketBD();
        return $jdb->getLlistatUsuarisMail2($entitat);
    }

    /* COMPTADORS, per barra lateral i index */
    public function getNumTicketsT(){
        $jdb = new TicketBD();
        return $jdb->getNumTicketsT2();
    }
    public function getNumTickets2(){
        $jdb = new TicketBD();
        return $jdb->getNumTickets22();
    }
    public function getNumTickets(){
        $jdb = new TicketBD();
        return $jdb->getNumTickets2();
    }

    public function getNumTicketsPaid(){
        $jdb = new TicketBD();
        return $jdb->getNumTicketsPaid2();
    }
    public function getNumTicketsPendent(){
        $jdb = new TicketBD();
        return $jdb->getNumTicketsPendent2();
    }
    public function getNumTicketsFDades(){
        $jdb = new TicketBD();
        return $jdb->getNumTicketsFDades2();
    }



    /* GENERACIÓ DEL EXCEL */
    public function generateExcel(){
        $jdb = new TicketBD();
        return $jdb->generateExcel2();
    }

    /* BUSCADORS */

    //TICKETS
    public function getSearchValue($value,$start_from,$results_per_page){
        $jdb = new TicketBD();
        return $jdb->getSearchValue2($value,$start_from,$results_per_page);
    }
    //USUARIS
    public function getSearchValueU($value){
        $jdb = new TicketBD();
        return $jdb->getSearchValueU2($value);
    }

    /* GESTIONAR GRUPS */
    public function getLlistatGrups(){
        $jdb = new TicketBD();
        return $jdb->getLlistatGrups2();
    }
    public function nouGrup($nom){
        $jdb = new TicketBD();
        return $jdb->nouGrup2($nom);
    }
    public function deleteGrup($id){
        $jdb = new TicketBD();
        return $jdb->deleteGrup2($id);
    }

}