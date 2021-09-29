<?php
require_once(__DIR__.'/../../../lib/controller/IndexController.php');
$controller = new IndexController();

$j2 = $controller->getNumTicketsPendent();
$j22 = $controller->getNumTicketsFDades();
$j2=$j22+$j2;
?>
<!-- BARRA ESQUERRA -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image"><img src="../../recursos/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"></div>
        <div class="pull-left info"><p><?php echo $_SESSION['usuari']['nombres'] ?></p><a href="#"><i class="fa fa-circle text-success"></i>Admin</a></div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="../index/index.php"><i class="fa fa-th"></i> <span>Inici</span></a></li>
		<li class="header">ADMINISTRACIÓ</li>
          <li><a href="../GestionarTickets/tickets.php"><i class="fa fa-files-o"></i> <span>Gestionar Tickets</span><small class="label pull-right bg-yellow"><?=$j2?></small></a></li>
          <li><a href="../GestionarGrups/gestionaGrups.php"><i class="fa fa-server"></i> <span>Gestionar grups</span></a></li>
          <li><a href="../GestionarUsuaris/gestionaUsuaris.php"><i class="fa fa-users"></i> <span>Gestionar usuaris</span></a></li>
		<li class="header">DESCARREGA DE RESULTATS</li>
          <li><a href="../estadistiques/resultats.php"><i class="fa fa-download"></i><span>Format Excel</span></a></li>
		<li class="header">CONFIGURACIÓ</li>
          <li><a href="../MeuPerfil/meuperfil.php"><i class="fa fa-edit"></i> <span>El meu perfil</span></a></li>
		  <li><a href="../notificacions/notificacions.php"><i class="fa fa-flag"></i> <span>Notificacions</span></a></li>
          <li><a href="../GestioPerfilsSessio/perfils.php"><i class="fa fa-dashboard"></i> <span>Gestió perfils d'inici de sessió</span></a></li>
      </ul>
    </section>
  </aside>
<!-- FI BARRA ESQUERRA -->