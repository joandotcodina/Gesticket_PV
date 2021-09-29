<?php
ini_set('display_errors', 1);
session_start();
if(isset($_SESSION['usuari'])){

    if($_SESSION['usuari']['tipo']!="Usuario"){
        header("Location: ../Admin/");
    }
}else{
    header('Location: ../../');
}
require_once(__DIR__.'/../../../lib/controller/IndexController.php');
$controller = new IndexController();

$nom = $_POST['nom'];
$correu = $_POST['correu'];
$quantitat = $_POST['quantitat'];
$motiu = $_POST['motiu'];
$imatge = $_POST['imatge'];
$comhorebra = $_POST['comhorebra'];
$nuccorrent = $_POST['nuccorrent'];
$grup = $_POST['grup'];
$mails = $_POST['mails'];
$j = $controller->nouTicketA($nom, $correu, $quantitat, $motiu, $imatge, $comhorebra, $nuccorrent, $grup, $mails);
$id = $j->getId();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//EMAIL A LA PERSONA QUI ENVIA EL TIQUET
//IF si es esplaicel, NO envia correu i deixa marcat com a pagat
if($correu == "esplaicel@gmail.com"){

}else{
    require(__DIR__ . '/../../../lib/ext/vendor/autoload.php');
    $mail2 = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $mail2->isSMTP();                                      // Set mailer to use SMTP
        $mail2->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail2->SMTPAuth = true;                               // Enable SMTP authentication
        $mail2->Username = '';                 // SMTP username
        $mail2->Password = '';                           // SMTP password
        $mail2->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail2->Port = 465;                                    // TCP port to connect to
        $mail2->setFrom('gesticket.noreply@gmail.com', 'Gesticket');
        $mail2->addAddress($correu);     // Add a recipient
        //Content
        $mail2->isHTML(true);                                  // Set email format to HTML
        $mail2->Subject = 'Has enviat un nou ticket!';
        $mail2->Body = "<h3 style=\"color:RoyalBlue ;\">Hola $nom, has enviat un ticket. </h3> <h3>Dades:</h3><h3>Motiu: </h3><h3 style=\"color:RoyalBlue ;\">$motiu</h3><h3> Quantitat: </h3><h3 style=\"color:RoyalBlue ;\">$quantitat euros</h3><h3>Com ho vols rebre? <h3 style=\"color:RoyalBlue;\">$comhorebra. </h3><h3>Grup: <h3 style=\"color:RoyalBlue;\">$grup. </h3><h3><h3>El numero de seguiment del ticket es: <h3 style=\"color:RoyalBlue;\">$id. </h3><h3> Quan hi hagin notícies rebràs un avís per mail</h3>";
        $mail2->send();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

}

/*Notificacio ADMIN INICI */
//Dades del registre del perfil notificaciones
$numerocorreus=0;
$entitat=$_SESSION['usuari']['entitat'];
$j = $controller->getLlistatUsuarisMail($entitat);
foreach($j as $def){
    $enviacorreu = true;
    $numerocorreus = "";
    if($def->getNotificacions() == "Si"){
            require (__DIR__.'/../../../lib/ext/vendor/autoload.php');
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings
                //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com;smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = '';                 // SMTP username
                $mail->Password = '';                           // SMTP password
                $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 465;                                    // TCP port to connect to
                $mail->setFrom('gesticket.noreply@gmail.com', 'Gesticket');
                $mail->addAddress($def->getCorreu());     // Add a recipient
                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = '[ADMIN - Gesticket]Nou/s tickets!';
                $mail->Body    = "<h3>Hola Administrador! Ja tens $numerocorreus nous tickets pendents per revisar.</h3><h3>Recorda visitar gesticket per fer les operacions.</h3>";

                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

    }

}





?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GesTicket | Usuari</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../recursos/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../recursos/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../recursos/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../recursos/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../recursos/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../recursos/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="../recursos/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../recursos/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../recursos/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../recursos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <!-- BARRA SUPERIOR ANCLADA -->
    <header class="main-header">
        <?php include_once("barrasuperioranclada.php"); ?>
    </header>
    <!-- FI BARRA SUPERIOR ANCLADA -->
    <!-- BARRA ESQUERRA NAVEGACIÓ -->
    <?php include_once("barra.php"); ?>
    <!-- FI BARRA ESQUERRA -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Resultat</h1>
        </section>
        <!-- CAIXES BARRA SOTA INICI -->
        <section class="content">
            <h3>Ticket afegit amb éxit, rebràs un correu amb les dades introduides.</h3>
            <h3>Dades:</h3><h3>Motiu: <?=$motiu?><h3> Quantitat: <?=$quantitat?> euros</h3><h3> Grup: <?=$grup?></h3><h3> Com ho vols rebre? <?=$comhorebra?>.</h3><h3>El número de seguiment del ticket es: <?=$id?>. </h3>
        </section>
    </div>
    <!-- PEU -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> <?php include_once("../../version.php"); ?>
        </div>
        <strong>GesTicket | Usuari</strong>
    </footer>
    <!-- FI PEU -->


    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

    <script src="../recursos/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../recursos/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="../recursos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../recursos/bower_components/raphael/raphael.min.js"></script>
    <script src="../recursos/bower_components/morris.js/morris.min.js"></script>
    <script src="../recursos/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="../recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../recursos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../recursos/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="../recursos/bower_components/moment/min/moment.min.js"></script>
    <script src="../recursos/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../recursos/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../recursos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="../recursos/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../recursos/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="../recursos/dist/js/adminlte.min.js"></script>
    <!-- PART ON SON ELS GRÀFICS -->
    <script src="../recursos/dist/js/pages/dashboard.js"></script>
    <script src="../recursos/dist/js/demo.js"></script>
</body>
</html>
