<?php

session_start();
if(isset($_SESSION['usuari'])){

    if($_SESSION['usuari']['tipo']!="Admin"){
        header("Location: ../../Usuari/");
    }
}else{
    header('Location: ../../../');
}
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once(__DIR__.'/../../../../lib/controller/IndexController.php');
$controller = new IndexController();
//Resultats per pàgina
$results_per_page=15;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $results_per_page;

$g = $controller->getLlistatAdvance($start_from,$results_per_page);
//var_dump($g);


//OLD
//$j = $controller->getLlistat();
//var_dump($j);


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
	  <h1>Tickets</h1>
    </section>
  <!-- CAIXES BARRA SOTA INICI -->
    <section class="content">
     	 <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <div class="box-tools">
                        <form method="get" action="search.php"><input type="hidden" name="page" value="1" /><input type="text" name="cerca" class="pull-right" placeholder="Buscar">
                            <button type="submit" ><i class="fa fa-search"></i></button> </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="taula" class="display">
                <tr>
				  <td></td>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Data de la darrera modificació</th>
                  <th>Estat</th>
				  <th>Quantitat</th>
                  <th>Motiu</th>
                  <th>Entregat físicament?</th>

                </tr>
				<?php foreach($g as $def){ ?>
					<?php if($def->getEstat() === "Pagat"){ ?>
						<tr>
						  <td><div class="btn-group"><a href="ticketdetall.php?id=<?=$def->getId()?>"><button type="button" class="btn btn-default"><i class="fa fa-fw fa-edit"></i></button></a></div></td>
						  <td><?=$def->getId()?></td>
						  <td><?=$def->getNom()?></td>
						  <td><?=$def->getData()?></td>
						  <td><span class="label label-success"><?=$def->getEstat()?></span></td>
						  <td><?=$def->getPreu()?>€</td>
						  <td><?=$def->getMotiu()?></td>
                          <td><?=$def->getEntregatFisic()?></td>
						</tr>
					<?php } ?>

					<?php if($def->getEstat() === "Falten dades"){ ?>
						<tr>
						  <td><div class="btn-group"><a href="ticketdetall.php?id=<?=$def->getId()?>"><button type="button" class="btn btn-default"><i class="fa fa-fw fa-edit"></i></button></a></div></td>
						  <td><?=$def->getId()?></td>
						  <td><?=$def->getNom()?></td>
						  <td><?=$def->getData()?></td>
						  <td><span class="label label-primary"><?=$def->getEstat()?></span></td>
						  <td><?=$def->getPreu()?>€</td>
						  <td><?=$def->getMotiu()?></td>
                          <td><?=$def->getEntregatFisic()?></td>
						</tr>
					<?php } ?>

					<?php if($def->getEstat() === "Pendent"){ ?>
					<tr>
					  <td><div class="btn-group"><a href="ticketdetall.php?id=<?=$def->getId()?>"><button type="button" class="btn btn-default"><i class="fa fa-fw fa-edit"></i></button></a></div></td>
					  <td><?=$def->getId()?></td>
					  <td><?=$def->getNom()?></td>
					  <td><?=$def->getData()?></td>
					  <td><span class="label label-warning"><?=$def->getEstat()?></span></td>
					  <td><?=$def->getPreu()?>€</td>
					  <td><?=$def->getMotiu()?></td>
                      <td><?=$def->getEntregatFisic()?></td>
					</tr>
					<?php } ?>

					<?php if($def->getEstat() === "Denegat"){ ?>
					<tr>
					  <td><div class="btn-group"><a href="ticketdetall.php?id=<?=$def->getId()?>"><button type="button" class="btn btn-default"><i class="fa fa-fw fa-edit"></i></button></a></div></td>
					  <td><?=$def->getId()?></td>
					  <td><?=$def->getNom()?></td>
					  <td><?=$def->getData()?></td>
					  <td><span class="label label-danger"><?=$def->getEstat()?></span></td>
					  <td><?=$def->getPreu()?>€</td>
					  <td><?=$def->getMotiu()?></td>
                      <td><?=$def->getEntregatFisic()?></td>
                    </tr>
					<?php } ?>
				<?php } ?>
              </table>
            </div>
              <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                  <ul class="pagination">
                      <li class="paginate_button previous disabled" id="example1_previous"></li>
              <?php
              $row = $controller->getPages();
              //var_dump($row);
              $total_pages = ceil($row['total'] / $results_per_page); // calculate total pages with results
              //echo "<h4>";

              for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages
                  echo "<li class=\"paginate_button ";
                  if ($i==$page){
                      echo "active \"><a href=tickets.php?page=" . $i . " aria-controls=\"example1\" data-dt-idx=" . $i . " tabindex=\"0\">" . $i . "</a></li>";
                  }else{
                      echo "\"><a href=tickets.php?page=" . $i . " aria-controls=\"example1\" data-dt-idx=" . $i . " tabindex=\"0\">" . $i . "</a></li>";
                  }
              };
              ?>

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
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
        $(document).ready(function() {
            $('#taula').dataTable();
        } );
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

    <!-- PART DE ON SON PER FER TAULES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>

</body>
</html>
