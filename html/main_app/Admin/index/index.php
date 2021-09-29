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
$j1 = $controller->getNumTicketsT();
$j2 = $controller->getNumTicketsPendent();
$j3 = $controller->getNumTicketsFDades();
$j4 = $controller->getNumTicketsPaid()
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
    <link rel="stylesheet" href="../../recursos/dist/css/skins/skin-blue.min.css">
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
	  <h1>Inici. Benvingut <?php echo $_SESSION['usuari']['nombres'] ?></h1>
    <a href="../../exit.php"> Tancar sessió</a>

    </section>
  <!-- CAIXES BARRA SOTA INICI -->
    <section class="content">
        <div class="row">

                <div class="col-lg-3 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3><?=$j4?><sup style="font-size: 20px"></sup></h3>

                            <p>Número de tickets pagats</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file-text"></i>
                        </div>
                        <a href="http://gesticket.tk/main_app/Admin/GestionarTickets/search.php?page=1&cerca=Pagat" class="small-box-footer">
                            Veure tickets <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                                <!-- ./col -->
                <div class="col-lg-3 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3><?=$j2-$j3?><sup style="font-size: 20px"></sup></h3>

                            <p>Número de tickets pendents</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <a href="http://gesticket.tk/main_app/Admin/GestionarTickets/search.php?page=1&cerca=Pendent" class="small-box-footer">
                            Veure tickets <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?=$j3?><sup style="font-size: 20px"></sup></h3>

                            <p>Número de tickets que hi falten dades</p>
                        </div>
                        <div class="icon">
                            <i class="fa  fa-file-o"></i>
                        </div>
                        <a href="http://gesticket.tk/main_app/Admin/GestionarTickets/search.php?page=1&cerca=Falten+dades" class="small-box-footer">
                            Veure tickets <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3><?=$j1?></h3>

                            <p>Número de tickets denegats</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="http://gesticket.tk/main_app/Admin/GestionarTickets/search.php?page=1&cerca=Denegat" class="small-box-footer">
                            Veure tickets<i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
        </div>
  </div>

    </section>

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
</body>
</html>

