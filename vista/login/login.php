
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

        <form action="" method="POST" id="ingreso" name="ingreso" class="login-form">
          <div class="row">
            <div class="input-field col s12">
              <center><div id="hola" name="hola"><img src="vista/config/img/logo-text2.png"></div></center>
              <h5 class="ml-4">CAS</h5>
            </div>
          </div>

          <div class="row margin">
            <div class="input-field col s12">
              <i class="icon-person_outline prefix"></i>
              <input id="user" name="user" type="text" autofocus autocomplete="off">
              <label for="user" class="center-align">Cédula</label>
            </div>
          </div>
          <div class="row margin">
            <div class="input-field col s12">
              <i class="icon-lock_outline prefix"></i>
              <input id="pass" name="pass" type="password"> 
              <label for="pass">Contraseña</label>
            </div>

            

            <div class="input-field col s6">
              <font class="ml-4" size= "2" color= "black" style="margin-left: -1%!important">Por favor, ingrese ahora el captcha</font>

              <img src="vista/login/captcha/captcha.php"><br>

              <input id="captcha" name="captcha" class="browser-default" style="border: none; background-color: rgb(181, 184, 177);" type="text" autocomplete="off">

            </div>

            <div class="input-field col s6">
              <a href=""><img id="recarga" src="vista/login/captcha/proyecto.png" style="width: 20%; margin-left: 40px; margin-top: 15%" data-position="bottom" data-tooltip="Refrescar captcha" class="tooltipped"></a>
            </div>

            <input type="hidden" name="ingresar" id="ingresar" value="validar">

            <input type="submit" onclick="document.ingreso.submit();" name="aceptar" id="aceptar" value="ingresar" class="btn waves-effect waves-light border-round gradient-45deg-blue-grey-blue col s12" style="border-radius: 60px 60px 60px 60px;">

          </div>

          <div class="row">
            <div class="input-field col s6 m7">
              <p class="margin medium-small"><a href="?paso=usuario&opcion=newLogin">¡Registrate Beneficiario!</a></p>
            </div>

            <div class="input-field col s6 m5" style="margin-right: -30px!important">
              <p class="margin medium-small"><a href="?paso=usuario&opcion=recuperarContrasena">Recupera tu contraseña</a></p>
            </div>

          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once 'vista/config/css/login/style-boton.php';?>

<div class="container-cars">
 <a href="?paso=usuario&opcion=logincontactoayuda">
  <div class="container-cars">
    <figure class="car xy1" tabindex="1">
    </figure>
  </div> 
</a>
</div>



<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->
<?php require_once 'vista/publico/Scripts.php'; ?>

</body>
</html>
