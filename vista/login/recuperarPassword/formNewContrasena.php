
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
  <style type="text/css">

    hr {
      border: 1px dashed #C0C0C0;
      height: 0;
      width: 100%;
    }

  </style>
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

       <div class="row">
            <div class="input-field col s12">
              <?php foreach($datosUs as $us){ ?> 
                <input type="hidden" name="idUsuario" value="<?php echo $us['id_usuario'];?>">
                <h5>Bienvenid@ de vuelta <?php echo $us['apellido']." ".$us['nombre'];?></h5>
              
              <hr>
            </div>
          </div>  

          <div class="row">
            <div class="input-field col s12">
              <p><h6>Ingrese su nueva contraseña</h6></p>
            </div>

          <form method="POST" action="?paso=seguridad&opcion=comContrasenaLogin" id="pass" name="pass">
          
           <input type="hidden" name="idUsuario" value="<?php echo $us['id_usuario']; ?>">

            <div class="input-field col s9 m10">
             <i class="icon-enhanced_encryption prefix"></i>
             <input id="contra_" name="contra_" type="password" class="validate" minlength="6" title="Clave mayor de 6 digitos" required data-length="12" maxlength="12">
             <label for="contra_">Nueva Contraseña</label>
           </div>

           <div class="input-field col s3 m2">
             <i class="icon-enhanced_encryption prefix"></i>
             <a href="javascript:void(0);" onclick="mostrarPassword2();" minlength="6" id='show' class="btn waves-effect waves-light green darken-2 white-text"><i id="hj" class="icon-visibility"></i></a>
           </div>

           <div class="input-field col s9 m10">
             <i class="icon-enhanced_encryption prefix"></i>
             <input  id="contra_2" name="contra_2" type="password" class="validate" minlength="6" required data-length="12" maxlength="12">
             <label for="contra_2">Confirme su contraseña</label>
           </div>

           <div class="input-field col s3 m2">
             <i class="icon-enhanced_encryption prefix"></i>
             <a href="javascript:void(0);" onclick="mostrarPas2();" id='show_p' minlength="6" class="btn waves-effect waves-light green darken-2 white-text"><i id="hl" class="icon-visibility"></i></a>
           </div>

         </div>
         <div class="row margin">

          <input type="button" onclick="validarform();" name="aceptar" id="aceptar" value="actualizar" class="btn waves-effect waves-light border-round gradient-45deg-blue-grey-blue col s12" style="border-radius: 60px 60px 60px 60px;">
        </form>

      </div>

      <div class="row">
        <div class="input-field col s6 m7">
          <p class="margin medium-small"><a href="?url=inicio">¡Volver al login!</a></p>
        </div>

      </div>
      <?php } ?>
    </form>
  </div>
</div>
</div>
</div>


<!-- ============================================================== -->
<!--               IMPORTACION DE LOS SCRIPTS                       -->
<!-- ============================================================== -->

<?php require_once 'vista/publico/Scripts.php'; ?>
<script src="vista/publico/script-new.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('input#input_text, input#contra_').characterCounter();
    $('input#input_text, input#con').characterCounter();
    $('input#input_text, input#contra_2').characterCounter();
    $("select").formSelect();
  });
</script>
<script src="vista/config/js/validar_contrasenaFinal.js"></script> 

</body>
</html>
