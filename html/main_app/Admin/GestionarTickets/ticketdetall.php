<?php
session_start();
if(isset($_SESSION['usuari'])){

    if($_SESSION['usuari']['tipo']!="Admin"){
        header("Location: ../../Usuari/");
    }
}else{
    header('Location: ../../../');
}
require_once(__DIR__.'/../../../../lib/controller/IndexController.php');
$controller = new IndexController();

$id = $_GET['id'];
$j = $controller->getTicketById($id);


$a= $j->getImatge();
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>GesTicket | Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../../recursos/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../recursos/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../recursos/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../../recursos/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../../recursos/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../../recursos/bower_components/morris.js/morris.css">
    <link rel="stylesheet" href="../../recursos/bower_components/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../../recursos/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="../../recursos/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../../recursos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
        <?php include_once("../barrasuperioranclada.php"); ?>
    </header>
    <!-- FI BARRA SUPERIOR ANCLADA -->
    <!-- BARRA ESQUERRA NAVEGACIÓ -->
    <?php include_once("../barra.php"); ?>
    <!-- FI BARRA ESQUERRA -->
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Tickets ➪ Detall</h1>
        </section>
        <!-- CAIXES BARRA SOTA INICI -->
        <section class="content">
            <form method="post" action="ticketdetall2.php">
                <input type="hidden" name="mails" value="<?=$j->getMails()?>" />
                <div class="form-group">
                    <label>ID</label>
                    <input type="hidden" name="id" value="<?=$j->getId()?>" />
                    <input type="text" class="form-control" value="<?=$j->getId() ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" class="form-control" value="<?=$j->getNom() ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Data</label>
                    <input type="text" class="form-control" value="<?=$j->getData() ?>" disabled>
                </div>
                <div class="form-group">
                    <label>Grup</label>
                    <input type="text" class="form-control" name="grup" value="<?=$j->getGrup() ?>">
                </div>
                <div class="form-group">
                    <label>Quantitat</label>
                    <input type="text" class="form-control" value="<?=$j->getPreu()?>€" disabled>
                </div>
                <div class="form-group">
                    <label>Motiu</label>
                    <textarea class="form-control" rows="3" disabled><?=$j->getMotiu() ?></textarea>
                </div>
                <div class="form-group">
                    <label>Com ho vol rebre</label>
                    <select class="form-control select2" name="comhorebra" style="width: 100%;">
                        <?php if($j->getComhorebra() == "Efectiu"){ ?>
                            <option selected="selected">Efectiu</option>
                            <option>Transferència</option>
                        <?php }else{ ?>
                            <option selected="selected">Transferència</option>
                            <option>Efectiu</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group" >
                    <label>Numero de compte bancari</label>
                    <input type="text" name="nuccorrent" class="form-control" value="<?=$j->getNuccorrent() ?>" name="nuccorrent">
                </div>
                <div class="form-group">
                    <label>Imatge</label>
                    <?php if($a != NULL){ ?>
                        <a href="<?=$j->getImatge() ?>"><img src="<?=$j->getImatge() ?>" width="200" height="200" style="image-orientation: from-image;"></a>
                    <?php }else{ ?>
                        <span>[Sense imatge]</span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label>Estat</label>
                    <select class="form-control select2" style="width: 100%;" name="estat">
                        <?php if($j->getEstat() === "Denegat"){ ?>
                            <option selected="selected"><?=$j->getEstat()?></option>
                            <option>Falten dades</option>
                            <option>Pendent</option>
                            <option>Pagat</option>
                        <?php } ?>
                        <?php if($j->getEstat() === "Falten dades"){ ?>
                            <option selected="selected"><?=$j->getEstat()?></option>
                            <option>Denegat</option>
                            <option>Pendent</option>
                            <option>Pagat</option>
                        <?php } ?>
                        <?php if($j->getEstat() === "Pagat"){ ?>
                            <option selected="selected"><?=$j->getEstat()?></option>
                            <option>Denegat</option>
                            <option>Pendent</option>
                            <option>Falten dades</option>
                        <?php } ?>
                        <?php if($j->getEstat() === "Pendent"){ ?>
                            <option selected="selected"><?=$j->getEstat()?></option>
                            <option>Denegat</option>
                            <option>Falten dades</option>
                            <option>Pagat</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Entregat físicament</label>
                    <select class="form-control select2" style="width: 100%;" name="efisicament">
                        <?php if($j->getEntregatFisic() === "Si"){ ?>
                            <option selected="selected"><?=$j->getEntregatFisic()?></option>
                            <option>No</option>
                        <?php } ?>
                        <?php if($j->getEntregatFisic() === "No"){ ?>
                            <option selected="selected"><?=$j->getEntregatFisic()?></option>
                            <option>Si</option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Comentari EXTRA Administrador</label>
                    <textarea class="form-control" rows="3" name="comentariAdmin"><?=$j->getComentarisAdm() ?></textarea>
                </div>
                <div class="form-group">
                    <label>Comentari EXTRA Usuari</label>
                    <textarea class="form-control" rows="3" disabled><?=$j->getComentariExtraUser() ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button></form>
                <form method="post" action="deleteTiquetp1.php?id=<?=$j->getId() ?>"><p></p><button type="submit" class="btn btn-primary">Eliminar tiquet</button><a> </a></form>

        </section>
    </div>
    <!-- PEU -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> <?php include_once("../../../version.php"); ?>
        </div>
        <strong>GesTicket | Admin</strong>
    </footer>
    <!-- FI PEU -->
    
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

        })
    </script>
    <script src="../../recursos/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../recursos/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <script src="../../recursos/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../recursos/bower_components/raphael/raphael.min.js"></script>
    <script src="../../recursos/bower_components/morris.js/morris.min.js"></script>
    <script src="../../recursos/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="../../recursos/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../../recursos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../../recursos/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <script src="../../recursos/bower_components/moment/min/moment.min.js"></script>
    <script src="../../recursos/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../../recursos/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="../../recursos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="../../recursos/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../../recursos/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="../../recursos/dist/js/adminlte.min.js"></script>
    <!-- PART ON SON ELS GRÀFICS -->
    <script src="../../recursos/dist/js/pages/dashboard.js"></script>
    <script src="../../recursos/dist/js/demo.js"></script>

</body>
</html>
