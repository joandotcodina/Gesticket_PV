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
$id = $_POST['id'];
$nom = $_POST['nom'];
$correu = $_POST['correu'];
$j = $controller->modificarPerfilAdmin($id,$nom,$correu);


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
            <h1>Resultat</h1>
        </section>
        <!-- CAIXES BARRA SOTA INICI -->
        <section class="content">
            <h1>Perfil guardat correctament! </h1>
            <meta http-equiv="refresh" content="0; URL=../../exit.php">
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
