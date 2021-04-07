
<!DOCTYPE html>
<html>
<head>
  <title>Abastecimiento Solidario</title>
  <script type="text/javascript" src="vista/config/js/jquery.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <link rel="stylesheet" type="text/css" href="vista/config/css/materialize.css">
  <link rel="stylesheet" type="text/css" href="vista/config/css/login/style.css">
  <link rel="stylesheet" type="text/css" href="vista/config/css/login/login.css">
  <link rel="stylesheet" type="text/css" href="vista/config/icons/style.css">
  <link rel="shortcut icon" href="vista/config/img/favicon.ico" type="image/ico" />
  <script type="text/javascript" src="vista/config/js/captcha.js"></script>
  <!-- Sweet Alert -->
  <link href="vista/config/css/sweetalert.css" rel="stylesheet">
  <script src="vista/config/js/sweetalert.min.js"></script>
  <?php require_once'vista/config/css/login/responsive-login.php'; ?>
</head>

<body id="img" name="img" background="vista/login/Fondolab.bmp" style="background-size: cover; background-repeat: no-repeat;
background-attachment: fixed">

<?php require_once 'vista/config/js/alertas.php';?>


<div class="row">

  <div class="col 12"></div>
  <div class="col s12">
    <div class="container"><div id="login-page" name="login-page" class="row">
      <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8" style="color: black;">

        <form action="?paso=seguridad&opcion=FormContrasena&b=1" method="POST" id="recuperar" name="recuperar" class="login-form">
          <div class="row">
            <div class="input-field col s12">
               <h5>¿Has olvidado la contraseña?</h5>
              <p>¡Recuperala para ingresar al sistema UPTAEB-CAS ahora!</p>
            </div>
          </div>

          <div class="row margin">
            <div class="input-field col s12">
              <i class="icon-payment prefix"></i>
              <input id="ciUser" name="ciUser" type="text" autofocus autocomplete="off">
              <label for="ciUser" class="center-align">Cédula</label>
            </div>
          </div>
          <div class="row margin">
  
            <input type="button" name="aceptar" id="aceptar" value="siguiente" class="btn waves-effect waves-light border-round gradient-45deg-blue-grey-blue col s12" style="border-radius: 60px 60px 60px 60px;">

          </div>

          <div class="row">
            <div class="input-field col s6 m7">
              <p class="margin medium-small"><a href="?url=inicio">¡Volver al login!</a></p>
            </div>

          </div> 
        </form>
      </div>
    </div>
  </div>
</div>


<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Scripts.php'; ?>
<script src="vista/config/js/validacion_ciLogin.js"></script> 

</body>
</html>
