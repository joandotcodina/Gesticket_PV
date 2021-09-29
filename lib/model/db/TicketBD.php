<?php 

require_once(__DIR__.'/../Ticket.php');
require_once(__DIR__.'/../Grup.php');
require_once(__DIR__.'/../Usuari.php');
require_once(__DIR__.'/../LoginC.php');
require_once(__DIR__.'/../../Constants.php');

class TicketBD{
    
    private $_conn;

    /* GESTIONS ADMINS */
    //Modificar el perfil d'administrador
    public function modificarPerfilAdmin2($id, $nom, $correu)
    {
        $this->openConnectionL();
        $s = $this->_conn->prepare("update usuarios set nombres=?, correu=? where id=?");
        $s->bind_param('ssi', $noms, $correus, $ids);
        $noms = $nom;
        $correus = $correu;
        $ids = $id;

        $s->execute();

        $this->closeConnection();
    }

    //Per veure el llistat d'usuaris (NO perfils d'inici de sessió)
    public function getLlistatUsuarisAdm2()
    {
        $this->openConnectionL();

        $s = $this->_conn->prepare("SELECT * FROM usuarios");
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while ($ll = $result->fetch_assoc()) {
            array_push($ret, $this->createJocFromAssocUsuarisAdm($ll));
        }

        $this->closeConnection();
        return $ret;
    }
     //Per retornar el nom de un perfil concret
    public function getUsuariAdminById2($id)
    {
        $this->openConnectionL();
        $s = $this->_conn->prepare("SELECT * FROM usuarios where id = ?");
        $s->bind_param('i', $ids);
        $ids = $id;

        $s->execute();
        $result = $s->get_result();
        $jocret = $this->createJocFromAssocUsuarisAdm($result->fetch_assoc());

        $this->closeConnection();
        return $jocret;
    }
    /* PART D'USUARIS D'INICI DE SESSIÓ*/

    //Per modificar
    public function modificarPerfilAdm2($id, $nom, $correu, $usuari, $perfil)
    {
        $this->openConnectionL();
        //Falta/Estaria be  aplicar el sistema per evitar concurrència que es va a donar a primer a BD

        $s = $this->_conn->prepare("update usuarios set nombres=?, correu=?, usuario=?, tipo=? where id=?");
        $s->bind_param('ssssi', $noms, $correus, $usuaris, $perfils, $ids);
        $noms = $nom;
        $correus = $correu;
        $usuaris = $usuari;
        $perfils = $perfil;
        $ids = $id;

        $s->execute();

        $this->closeConnection();
    }
    //Per eliminar
    public function deleteUserAdmin2($id)
    {
        $this->openConnectionL();
        $s = $this->_conn->prepare("DELETE FROM usuarios WHERE id= ?");
        $s->bind_param('s', $ids);
        $ids = $id;
        $s->execute();
        $this->closeConnection();
    }
    //Per comprovar que el mail no s'estigui utilitzant
    public function beforeNouUsuari2($correu){
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT COUNT(id) AS total from usuaris where correu=?");
        $s->bind_param('s', $correus);
        $correus = $correu;
        $s->execute();
        $s1 = $s->get_result();
        $row = $s1->fetch_assoc();
        $this->closeConnection();
        return $row['total'];
    }
    //Per comprovar que el nom no s'estigui utilitzant
    public function beforeNouUsuariName2($usuari){
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT COUNT(id) AS total from usuaris where nom=?");
        $s->bind_param('s', $usuaris);
        $usuaris = $usuari;
        $s->execute();
        $s1 = $s->get_result();
        $row = $s1->fetch_assoc();
        $this->closeConnection();
        return $row['total'];
    }
    //Per fer un nou usuari
    public function nouUsuariLogin2($nom, $correu, $usuari, $clau1, $perfil)
    {
        $this->openConnectionL();
        $s = $this->_conn->prepare("insert into usuarios (nombres,usuario,password,tipo,correu) values(?,?,?,?,?)");
        $s->bind_param('sssss', $noms, $usuaris, $clau, $perfil1, $correus);
        $noms = $nom;
        $correus = $correu;
        $usuaris = $usuari;
        $clau = $clau1;
        $perfil1 = $perfil;


        $s->execute();

        $this->closeConnection();
    }
    //Per comprovar que no existeixi aquell id de usuari
    public function beforeNouUsuariLogin2($usuari)
    {
        $this->openConnectionL();
        $s = $this->_conn->prepare("SELECT COUNT(usuario) AS total from usuarios where usuario=?");
        $s->bind_param('s', $usuaris);
        $usuaris = $usuari;
        $s->execute();
        $s1 = $s->get_result();
        $row = $s1->fetch_assoc();
        $this->closeConnection();
        return $row['total'];
    }
    //Per ficar una nova clau
    public function novaClauUsuari2($id, $clau1)
    {
        $this->openConnectionL();
        //Falta/Estaria be  aplicar el sistema per evitar concurrència que es va a donar a primer a BD

        $s = $this->_conn->prepare("update usuarios set password=? where id=?");
        $s->bind_param('si', $clau, $ids);
        $clau = $clau1;
        $ids = $id;

        $s->execute();

        $this->closeConnection();
    }
    //Per rebre el llistat OLD
    public function getAll()
    {
        $this->openConnection();
        
        $s = $this->_conn->prepare("SELECT id,nom,data,estat,preu,motiu,entregatFisic,comentarisAdm FROM ticketsall");
        $s->execute();
        $result = $s->get_result();
        
        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocAdminList($ll));
        }
        
        $this->closeConnection();
        return $ret;
    }
    //Per rebre el llistat, amb pàgines
    public function getLlistatAdvance2($start_from,$results_per_page)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT id,nom,data,estat,preu,motiu,entregatFisic,comentarisAdm FROM ticketsall ORDER BY id DESC LIMIT ?,?");
        $s->bind_param('ii', $start_from1,$results_per_page1);
        $start_from1 = $start_from;
        $results_per_page1 = $results_per_page;
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocAdminList($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    //Per comptar les pàgines
    public function getPages2()
    {
        $this->openConnection();
        $result = $this->_conn->prepare("SELECT COUNT(id) AS total FROM ticketsall");
        $result->execute();
        $result1 = $result->get_result();
        $row = $result1->fetch_assoc();
        $this->closeConnection();
        return $row;
    }
    //Per comptar pàgines, per la part de SEARCH
    public function getPagesS2($value){
        $this->openConnection();
        $result = $this->_conn->prepare("SELECT COUNT(id) AS total FROM ticketsall where id LIKE '%".$value."%' or nom LIKE '%".$value."%' or data LIKE '%".$value."%' or motiu LIKE '%".$value."%' or estat LIKE '%".$value."%' or preu LIKE '%".$value."%' ");
        $result->execute();
        $result1 = $result->get_result();
        $row = $result1->fetch_assoc();
        $this->closeConnection();
        return $row;

    }

    /* BUSCADORS */
    //Buscador per tickets
    public function getSearchValue2($value,$start_from,$results_per_page)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT id,nom,data,estat,preu,motiu,entregatFisic,comentarisAdm FROM ticketsall where id LIKE '%".$value."%' or nom LIKE '%".$value."%' or data LIKE '%".$value."%' or motiu LIKE '%".$value."%' or estat LIKE '%".$value."%' or preu LIKE '%".$value."%' ORDER BY id DESC LIMIT ?,?");
        $s->bind_param('ii', $start_from1,$results_per_page1);
        $start_from1 = $start_from;
        $results_per_page1 = $results_per_page;
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocAdminList($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    //Buscador per usuaris (NO per perfils d'inici de sessió)
    public function getSearchValueU2($value)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT id,nom,nom,correu FROM usuaris where id LIKE '%".$value."%' or nom LIKE '%".$value."%' or correu LIKE '%".$value."%' ");
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocUsuaris($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    //Check, maybe old?
    public function getAllFull()
    {
        $this->openConnection();

        $s = $this->_conn->prepare("SELECT id,nom,data,estat,preu,motiu,entregatFisic,comentarisAdm,correu,imatge,comentariExtraUser,nuccorrent,comhorebra,grup,mails FROM ticketsall");
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocUsuariDetall($ll));
        }

        $this->closeConnection();
        return $ret;
    }

    //Ticket detall
    public function getTicketById2($id)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT id,nom,data,estat,preu,motiu,entregatFisic,comentarisAdm,correu,imatge,comentariExtraUser,nuccorrent,comhorebra,grup,mails FROM ticketsall where id = ?");
        $s->bind_param('i', $ids);
        $ids = $id;

        $s->execute();
        $result = $s->get_result();
        $jocret = $this->createJocFromAssocUsuariDetall($result->fetch_assoc());

        $this->closeConnection();
        return $jocret;
    }
    //Per modificar comentaris del usuari (depen de la condició només deixa modificar un valor, per això esta per separat)
    public function modificarComentari2($id,$comentari)
    {
        $this->openConnection();

        $s = $this->_conn->prepare("update ticketsall set comentariExtraUser=? where id=?");
        $s->bind_param('si', $comentari, $ids);
        $comentaris= $comentari;
        $ids=$id;

        $s->execute();

        $this->closeConnection();
    }
    //Per modificar comentaris del usuari (depen de la condició només deixa modificar un valor, per això esta per separat)
    public function modificarComentariV22($id,$nom,$preu,$motiu,$comentari,$comhorebra,$nuccorrent)
    {
        $this->openConnection();

        $s = $this->_conn->prepare("update ticketsall set nom=?, preu=?, motiu=?,comentariExtraUser=?, comhorebra=?, nuccorrent=? where id=?");
        $s->bind_param('sdssssi', $noms,$preus,$motius,$comentaris,$comhorebras,$nuccorrents,$ids);
        $noms=$nom;
        $preus=$preu;
        $motius=$motiu;
        $comentaris= $comentari;
        $comhorebras=$comhorebra;
        $nuccorrents=$nuccorrent;
        $ids=$id;

        $s->execute();

        $this->closeConnection();
    }
    //Per modificar comentaris admin
    public function modificarTicketAdm2($id,$estat,$efisicament,$comentariAdmin,$comhorebra,$nuccorrent,$grup)
    {
        $this->openConnection();
        //Falta/Estaria be  aplicar el sistema per evitar concurrència que es va a donar a primer a BD
        $s = $this->_conn->prepare("update ticketsall set comentarisAdm=?, estat=?,entregatFisic=?, comhorebra=?, nuccorrent=?, grup=? where id=?");
        $s->bind_param('ssssssi', $comentaris,$estats,$efisicaments,$comhorebras,$nuccorrents,$grups,$ids);
        $comentaris= $comentariAdmin;
        $estats=$estat;
        $efisicaments=$efisicament;
        $comhorebras=$comhorebra;
        $nuccorrents=$nuccorrent;
        $grups=$grup;
        $ids=$id;

        $s->execute();

        $this->closeConnection();
    }
    //Llista per a l'hora d'afegir tickets
    public function getLlistatUsuarisNom2()
    {
        $this->openConnection();

        $s = $this->_conn->prepare("SELECT nom FROM usuaris");
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocUsuarisN($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    //Comprova si el correu existeix
    public function searchCorreu2($nom)
    {
        $this->openConnection();

        $s = $this->_conn->prepare("SELECT id,nom,correu FROM usuaris where nom =?");
        $s->bind_param('s', $noms);
        $noms= $nom;
        $s->execute();
        $result = $s->get_result();

        $ret= $this->createJocFromAssocUsuaris($result->fetch_assoc());
        $this->closeConnection();
        return $ret;
    }

    //GESTIÓ D'USUARIS
    public function getLlistatUsuarisOldW2()
    {
        $this->openConnection();

        $s = $this->_conn->prepare("SELECT id,nom,correu FROM usuaris");
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocUsuaris($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    //Llistat d'usuaris per pàgines
    public function getLlistatUsuaris2($start_from,$results_per_page)
    {
        $this->openConnection();

        $s = $this->_conn->prepare("SELECT id,nom,correu FROM usuaris ORDER BY id DESC LIMIT ?,?");
        $s->bind_param('ii', $start_from1,$results_per_page1);
        $start_from1 = $start_from;
        $results_per_page1 = $results_per_page;
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while($ll = $result->fetch_assoc()){
            array_push($ret, $this->createJocFromAssocUsuaris($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    //Pàgines de la part d'usuaris
    public function getPagesU2()
    {
        $this->openConnection();
        $result = $this->_conn->prepare("SELECT COUNT(id) AS total FROM usuaris");
        $result->execute();
        $result1 = $result->get_result();
        $row = $result1->fetch_assoc();
        $this->closeConnection();
        return $row;
    }
    //Usuari detall
    public function getUsuariById2($id)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT id,nom,correu FROM usuaris where id = ?");
        $s->bind_param('i', $ids);
        $ids = $id;

        $s->execute();
        $result = $s->get_result();
        $jocret = $this->createJocFromAssocUsuaris($result->fetch_assoc());

        $this->closeConnection();
        return $jocret;
    }
    //Modificar usuari
    public function modificarUsuariAdm2($id,$nom,$correu)
    {
        $this->openConnection();

        $s = $this->_conn->prepare("update usuaris set nom=?, correu=? where id=?");
        $s->bind_param('ssi', $noms, $correus, $ids);
        $noms= $nom;
        $correus=$correu;
        $ids=$id;

        $s->execute();

        $this->closeConnection();
    }
    //Eliminar usuari
    public function deleteUser2($id)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("DELETE FROM usuaris WHERE id= ?");
        $s->bind_param('s', $ids);
        $ids = $id;
        $s->execute();
        $this->closeConnection();
    }

    /* Contadors, barra LATERAL */
    public function getNumTicketsT2()
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT COUNT(*) as contador FROM ticketsall where estat=\"Denegat\"");
        $s->execute();
        $result = $s->get_result();
        $r2=$result->fetch_assoc();

        $this->closeConnection();
        return $r2['contador'];
    }
    //Inici contador 1
    public function getNumTickets2()
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT COUNT(*) as contador FROM ticketsall where estat=\"Falten dades\"");
        $s->execute();
        $result = $s->get_result();
        $r=$result->fetch_assoc();

        $this->closeConnection();
        return $r['contador'];
    }
    public function getNumTickets22()
    {
        $this->openConnection();

        $s = $this->_conn->prepare("SELECT COUNT(*) as contador FROM ticketsall where estat=\"Pendent\"");
        $s->execute();
        $result = $s->get_result();
        $r=$result->fetch_assoc();

        $this->closeConnection();
        return $r['contador'];
    }
    //Inici contador 4
    public function getNumTicketsPaid2()
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT COUNT(*) as contador FROM ticketsall where estat=\"Pagat\"");
        $s->execute();
        $result = $s->get_result();
        $r2=$result->fetch_assoc();

        $this->closeConnection();
        return $r2['contador'];
    }
    //Inici contador 2
    public function getNumTicketsPendent2()
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT COUNT(*) as contador FROM ticketsall where estat=\"Pendent\"");
        $s->execute();
        $result = $s->get_result();
        $r2=$result->fetch_assoc();

        $this->closeConnection();
        return $r2['contador'];
    }
    //Inici contador 3
    public function getNumTicketsFDades2()
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT COUNT(*) as contador FROM ticketsall where estat=\"Falten dades\"");
        $s->execute();
        $result = $s->get_result();
        $r2=$result->fetch_assoc();

        $this->closeConnection();
        return $r2['contador'];
    }
    //Generadors d'Excel
    public function generateExcel2()
    {
        $this->openConnection();
        $s = $this->_conn->prepare("SELECT * FROM ticketsall");
        $s->execute();
        //$result = $s->get_result();

        $this->closeConnection();
        //var_dump($r1);
        return $s;
    }
    //Nou ticket
    public function nouTicketA2($nom, $correu, $quantitat, $motiu, $imatge, $comhorebra, $nuccorrent, $grup, $mails)
    {
        $this->openConnection();
        
        $s = $this->_conn->prepare("insert into ticketsall (nom,correu,preu,motiu,imatge,estat,entregatFisic,comhorebra,nuccorrent,grup,mails) values(?,?,?,?,?,?,?,?,?,?,?)");
        $s->bind_param('ssdssssssss',$noms,$correus,$quantitats,$motius,$imatges,$estat,$ef,$comhorebra1,$nuccorrent1,$grup1,$mails1);
        $noms= $nom;
        $correus = $correu;
        $quantitats= $quantitat;
        $motius=$motiu;
        $imatges=$imatge;
        if($correu == "esplaicel@gmail.com") {
            $estat = "Pagat";
        }else{
            $estat = "Pendent";
        }
        $ef="No";
        $comhorebra1= $comhorebra;
        $nuccorrent1 = $nuccorrent;
        $grup1=$grup;
        $mails1=$mails;
        
        
        $s->execute();

        $s2 = $this->_conn->prepare("select id from ticketsall where nom=? and correu=? and preu=? and motiu=?");
        $s2->bind_param('ssds',$noms2,$correus2,$quantitats2,$motius2);
        $noms2 = $nom;
        $correus2 = $correu;
        $quantitats2 = $quantitat;
        $motius2 = $motiu;

        $s2->execute();

        $result = $s2->get_result();
        $r2 = $this->createJocFromAssocUsuariDetall2($result->fetch_assoc());
        $this->closeConnection();

        return $r2;
    }
    //nou Usuari
    public function nouUsuari2($nom, $correu){
        $this->openConnection();

        $s = $this->_conn->prepare("insert into usuaris (nom,correu) values(?,?)");
        $s->bind_param('ss',$noms,$correus);
        $noms= $nom;
        $correus = $correu;


        $s->execute();

        $this->closeConnection();
    }

    /* NOTIFICACIONS */
    public function canviarNoti2($opcio,$id){
        $this->openConnectionL();
        $s2 = $this->_conn->prepare("update usuarios set notificacions=? where id=?");
        $s2->bind_param('si',$opcio2,$id2);
        $opcio2 = $opcio;
        $id2 = $id;
        $s2->execute();

        $this->closeConnection();
    }
    public function getLlistatUsuarisMail2($entitat){
        $this->openConnectionL();
        $s = $this->_conn->prepare("SELECT * FROM usuarios where entitat=?");
        $s->bind_param('s',$entitats);
        $entitats= $entitat;
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while ($ll = $result->fetch_assoc()) {
            array_push($ret, $this->createJocFromAssocUsuarisAdm($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    /* GESTIONAR GRUPS */
    //Mostrar tot el llistat de grups.
    public function getLlistatGrups2(){
        $this->openConnection();

        $s = $this->_conn->prepare("SELECT * FROM grups");
        $s->execute();
        $result = $s->get_result();

        $ret = array();
        while ($ll = $result->fetch_assoc()) {
            array_push($ret, $this->createJocFromAssocGrups($ll));
        }

        $this->closeConnection();
        return $ret;
    }
    //Afegir grup
    public function nouGrup2($nom)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("insert into grups (grup) values(?)");
        $s->bind_param('s', $noms);
        $noms = $nom;

        $s->execute();

        $this->closeConnection();
    }
    //Eliminar grup
    public function deleteGrup2($id)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("DELETE FROM grups WHERE id= ?");
        $s->bind_param('s', $ids);
        $ids = $id;
        $s->execute();
        $this->closeConnection();
    }

    //Eliminar tiquet [new]
    public function deleteTiquet($id)
    {
        $this->openConnection();
        $s = $this->_conn->prepare("DELETE FROM ticketsall WHERE id= ?");
        $s->bind_param('i', $ids);
        $ids = $id;
        $s->execute();
        $this->closeConnection();
    }
    private function createJocFromAssocAdminList($arr){
        $ticket = new Ticket($arr['id'],$arr['nom'],$arr['data'],$arr['estat'],$arr['preu'],$arr['motiu'],$arr['entregatFisic'],$arr['comentarisAdm']);
        return $ticket;
    }
    private function createJocFromAssocUsuariDetall($arr){
        $ticket = new Ticket($arr['id'],$arr['nom'],$arr['data'],$arr['estat'],$arr['preu'],$arr['motiu'],$arr['entregatFisic'],$arr['comentarisAdm'],$arr['correu'],$arr['imatge'],$arr['comentariExtraUser'],$arr['nuccorrent'],$arr['comhorebra'],$arr['grup'], $arr['mails']);
        return $ticket;
    }
    private function createJocFromAssocUsuariDetall2($arr){
        $ticket = new Ticket($arr['id']);
        return $ticket;
    }
    private function createJocFromAssocUsuaris($arr){
        $us = new Usuari($arr['id'],$arr['nom'],$arr['correu']);
        return $us;
    }
    private function createJocFromAssocGrups($arr){
        $us = new Grup($arr['id'],$arr['grup']);
        return $us;
    }
    private function createJocFromAssocUsuarisAdm($arr){
        $ll = new LoginC($arr['id'],$arr['nombres'],$arr['usuario'],$arr['correu'],$arr['tipo'],$arr['password'],$arr['entitat'],$arr['notificacions']);
        return $ll;
    }

    private function createJocFromAssocUsuarisN($arr){
        $ll = new Usuari($arr['nom']);
        return $ll;
    }
    private function createJocFromAssocUsuarisNC($arr){
        $ll = new Usuari($arr['nom'],$arr['correu']);
        return $ll;
    }

    //DB TICKETAREA
    private function openConnection(){
        $this->_conn = new mysqli(Constants::$dbhost, Constants::$dbuser, 
                Constants::$dbpassword, Constants::$dbname);
    }
    //DB LOGIN
    private function openConnectionL(){
        $this->_conn = new mysqli(Constants::$dbhost, Constants::$dbuser,
            Constants::$dbpassword, Constants::$dbnameL);
    }
    
    private function closeConnection(){
        $this->_conn->close();
    }
    
}