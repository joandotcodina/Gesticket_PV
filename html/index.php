<?php
    session_start();
    if(isset($_SESSION['usuari'])){
        if($_SESSION['usuari']['tipo']=="Admin"){
            header('Location: main_app/Admin/');
        }else if($_SESSION['usuari']['tipo']=="Usuario"){
            header('Location: main_app/Usuari/');
        }
    }



?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>GesTicket | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/recursos/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/recursos/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/recursos/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/recursos/main.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/recursos/blue.css">
  <link rel="stylesheet" href="css/main.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<div class="error">
      <span>Dades de ingrés no vàlides, torna-ho a intentar siusplau.</span>

    </div>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b><img src="/img/foto.png" width="186" height="112"></b></a>
  </div>
  <div class="login-box-body">
    <form action="" id="form" method="post">
      <div class="form-group has-feedback"><input type="text" class="form-control" name="usuarilg" placeholder="Usuari" required></div>
      <div class="form-group has-feedback"><input type="password" class="form-control" name="passlg" placeholder="Contrasenya" required></div>
      <div class="row">
        <div class="col-xs-12"><input type="submit" formmethod="post" class="mainjsb btn btn-primary btn-block btn-flat"  value="Iniciar Sessió" ></div>
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="/recursos/jquery.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/recursos/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/recursos/icheck.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/main.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>

