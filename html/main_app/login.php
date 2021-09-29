<?php
//AMB SISTEMA DE SEGURETAT
//Comprovem que no vagi buida i sigui una petició sigui AJAX

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    require_once 'acces.php';
   
    session_start();
    $mysqli->set_charset('utf8');

    $usuari= $mysqli->real_escape_string($_POST['usuarilg']);
    $pass = $mysqli->real_escape_string($_POST['passlg']);

    //BIG PROBLEM: si fiques dos dades existents a la BD, entres, com un cabró
    if($c = $mysqli->prepare("SELECT nombres,tipo,id,correu,entitat,notificacions FROM usuarios WHERE BINARY usuario=? AND BINARY password=?")){

        $c->bind_param('ss',$usuaris, $passs);
        $usuaris=$usuari;
        $passs=$pass;
        $c->execute();
        //var_dump($c);

        $r = $c->get_result();
        //var_dump($r);

            if($r->num_rows == 1){
                $datos = $r->fetch_assoc();
                $_SESSION['usuari'] = $datos;
                echo json_encode(array('error'=>false,'tipo'=>$datos['tipo']));
            }else{
                echo json_encode(array('error'=>true));
            }

        $c->close();
    }


}
$mysqli->close();

 ?>
