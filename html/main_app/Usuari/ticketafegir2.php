<?php
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

$nombre_img = $_FILES['imagen']['name'];
$tipo = $_FILES['imagen']['type'];
$tamano = $_FILES['imagen']['size'];

//Si existe imagen y tiene un tamaño correcto
if ($nombre_img == !NULL) {
    // Ruta on es guardara
    $directorio = __DIR__ . '/../tickets/';
    //Check si esta repetit
    $actual_name = pathinfo($nombre_img,PATHINFO_FILENAME);
    $original_name = $actual_name;
    $extension = pathinfo($nombre_img, PATHINFO_EXTENSION);
    $i = 1;
    while(file_exists($directorio.$actual_name.".".$extension)) {
        $actual_name = (string)$original_name.$i;
        $nombre_img = $actual_name.".".$extension;
        $i++;
    }
        //indicamos los formatos que permitimos subir a nuestro servidor
        if (($_FILES["imagen"]["type"] == "image/gif")
            || ($_FILES["imagen"]["type"] == "image/jpeg")
            || ($_FILES["imagen"]["type"] == "image/jpg")
            || ($_FILES["imagen"]["type"] == "image/png")) {

            // Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
            move_uploaded_file($_FILES['imagen']['tmp_name'], $directorio . $nombre_img);
        } else {
            $message = "Format de imatge no permés O el nom de la imatges es MASSA llarg :/";
            echo "<script type='text/javascript'>alert('$message');</script>";
            echo "<meta http-equiv=\"refresh\" content=\"0; url=http://gesticket.tk/main_app/Usuari/ticketafegir.php\" />";
        }

}
else
{
    //si existe la variable pero se pasa del tamaño permitido
    if($nombre_img == !NULL){
        $message = "No has escollit una imatge (Formats aceptats: GIF,JPEG,JPG,PNG)";
        echo "<script type='text/javascript'>alert('$message');</script>";
        echo "<meta http-equiv=\"refresh\" content=\"0; url=http://gesticket.tk/main_app/Usuari/ticketafegir.php\" />";
    }
}

$nom = $_POST['nom'];
$quantitat = $_POST['quantitat'];
if (!is_numeric($quantitat)) {
    $message = "Epps! No has introduit un numero al apartat de la quantiat!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0; url=http://gesticket.tk/main_app/Usuari/ticketafegir.php\" />";
}else if($quantitat < 0){
    $message = "Epps! No has introduit un numero negatiu!";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0; url=http://gesticket.tk/main_app/Usuari/ticketafegir.php\" />";
}
$motiu = $_POST['motiu'];
$imatge = "http://gesticket.tk/main_app/tickets/".$nombre_img;
$rr = $controller->searchCorreu($nom);

if ($nom=="Selecciona un nom...") {
    $message = "Epps! No has seleccionat una persona.";
    echo "<script type='text/javascript'>alert('$message');</script>";
    echo "<meta http-equiv=\"refresh\" content=\"0; url=http://gesticket.tk/main_app/Usuari/ticketafegir.php\" />";
}

$comhorebra = $_POST['comhorebra'];
$nuccorrent = $_POST['nuccorrent'];
$grup = $_POST['grup'];
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
	  <h1>Comproveu que les dades siguin correctes...</h1>
    </section>
  <!-- CAIXES BARRA SOTA INICI -->
    <section class="content">
            <form method="post" action="ticketafegir3.php">
                <div class="form-group">
                    <label>Persona*</label>
                    <select class="form-control select2" style="width: 100%;" disabled="disabled">
                        <option selected="selected"><?=$nom?></option>
                    </select>
                </div>
                <input type="hidden" name="nom" value="<?=$rr->getNom()?>" />
                <div class="form-group">
                    <label>Grup*</label>
                    <select class="form-control select2" style="width: 100%;" disabled="disabled">
                        <option selected="selected"><?=$grup?></option>
                    </select>
                </div>
                <input type="hidden" name="grup" value="<?=$grup?>" />
                <div class="form-group">
                        <label>Correu</label>
                        <input type="text" class="form-control" value="<?=$rr->getCorreu()?>"  disabled>
                </div>
                <input type="hidden" name="correu" value="<?=$rr->getCorreu()?>" />
                <div class="form-group">
                    <label>Quantitat*</label>
                    <input type="number" step="0.01" min="0.01" max="10000" class="form-control" name="quantitat" value="<?=$quantitat?>" >
                </div>
                <div class="form-group">
                    <label>Motiu [Explicació breu]*</label>
                    <textarea class="form-control" rows="3" name="motiu"><?=$motiu?></textarea>
                </div>
                <div class="form-group">
                    <label>Com ho vols rebre?*</label>
                    <select class="form-control select2" style="width: 100%;" onchange="yesnoCheck(this);" disabled>
                        <option selected="selected"><?=$comhorebra?></option>
                    </select>
                </div>
                <?php if ($comhorebra === "Transferència"){ ?>
                    <div class="form-group">
                        <label>Numero de compte bancari*</label>
                        <input type="text" class="form-control" value="<?=$nuccorrent?>" disabled>
                    </div>
                <?php }?>
                <input type="hidden" name="nuccorrent" value="<?=$nuccorrent?>" />
                <input type="hidden" name="comhorebra" value="<?=$comhorebra?>" />

                <div class="form-group">

                    <label>Imatge</label>
                    <?php if ($imatge === "http://gesticket.tk/main_app/tickets/"){ echo "<label>[Sense Imatge]</label>" ?>
                    <?php }else{ ?>
                    <input type="hidden" name="imatge" value="<?=$imatge?>" />
                    <img src="<?=$imatge?>" width="200" height="200" style="image-orientation: from-image;">
                    <?php } ?>
                    <p>***AVÍS: NO PODRÀS MODIFICAR LA IMATGE DESPRÉS DEL SEGUENT PAS ***, si vols modificar la imatge ves un pas enrere</p>
                </div>
                <div class="form-group">
                    <label>Vols rebre mails de actualizacions?</label><br>
                    <input type="radio" name="mails" value="si" checked>Si<br>
                    <input type="radio" name="mails" value="no">No <br>
                </div>
                <input type="submit" onclick="this.form.submit(); this.disabled = true" class="btn btn-primary"/>
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
