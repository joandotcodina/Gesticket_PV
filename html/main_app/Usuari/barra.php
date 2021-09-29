  <!-- BARRA ESQUERRA -->
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image"><img src="../recursos/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"></div>
        <div class="pull-left info"><p><?php echo $_SESSION['usuari']['nombres'] ?></p><a href="#"><i class="fa fa-circle text-success"></i>Usuari</a></div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="index.php"><i class="fa fa-th"></i> <span>Inici</span></a></li>
		<li class="header">Tickets</li>
		<li><a href="ticketafegir.php"><i class="fa fa-files-o"></i> <span>Afegir Tickets</span></a></li>
        <li><a href="ticketstatus.php"><i class="fa fa-th"></i> <span>Veure l'estat</span></a></li>
		<li class="header">CONFIGURACIÓ</li>
        <li><a href="meuperfil.php"><i class="fa fa-edit"></i> <span>El meu perfil</span></a></li>
      </ul>
    </section>
  </aside>
<!-- FI BARRA ESQUERRA -->