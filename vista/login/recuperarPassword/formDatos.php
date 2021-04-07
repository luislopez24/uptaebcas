
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

<br>
<div class="row">

  <div class="col 12"></div>
  <div class="col s12">
    <div class="container"><div id="login-page" name="login-page" class="row">
      <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8" style="color: black; margin-top: auto;">

        <form action="?paso=seguridad&opcion=comContrasena" method="POST" id="quest" name="quest" class="login-form">
          <div class="row">
            <div class="input-field col s12">
              <?php foreach($datos as $us){ ?> 
              <p><?php echo $us['apellido']." ".$us['nombre'];?> </p>
              <input type="hidden" name="idUsuario" value="<?php echo $us['id_usuario'];?>">
              <?php } ?>
              <h5>Cambio de clave de internet</h5>
              <hr>
            </div>
          </div>  

          <div class="row">
            <div class="input-field col s12">
              <p><font size="4" face="Georgia, Arial">1- Indique si la fecha a continuacion es su fecha de nacimiento</font>

              </p>
              <p><h8>FECHA DE NACIMIENTO: <?php $fechaSeleccionada = NULL; for ($i=1; $i<=1; $i++){
                $var=rand( 0 , $items );
                if (in_array($array[$var], $preguntadas)){ // Buscamos si la pregunta ya se habia hecho
                $i--;  // restamos 1 para reutilizar el indice de la pregunta repetida  
              }else{
              echo $array[$var];  // Mostramos la pregunta
              $fechaSeleccionada.= $array[$var];
              $preguntadas[].=$array[$var];  // y la agregamos a las que ya se hicieron        
            }

          } ?>
        </h8></p>

        <input type="hidden" name="fechaSelec" value="<?php echo $fechaSeleccionada;?>">

         <p>
            <label>
              <input name="fechaGroup" value="si" class="with-gap" type="radio" />
              <span>Si</span>
            </label>
          </p>
          <p>
            <label>
              <input name="fechaGroup" value="no" class="with-gap" type="radio" />
              <span>No</span>
            </label>
          </p>
        </div>

        <div class="input-field col s12">
          <p><font size="4" face="Georgia, Arial">1- Indique si su número celular termina con los siguientes 4 dígitos</font>

          </p>
          <p><h8>ÚLTIMOS 4 DIGITOS: <?php $numSelec = NULL; for ($i=1; $i<=1; $i++){
            $var=rand( 0 , $items );
            if (in_array($arrayNum[$var], $preguntasNum)){ // Buscamos si la pregunta ya se habia hecho
            $i--;  // restamos 1 para reutilizar el indice de la pregunta repetida  
          }else{
          echo $arrayNum[$var];  // Mostramos la pregunta
          $numSelec.=$arrayNum[$var];
          $preguntasNum[].=$arrayNum[$var];  // y la agregamos a las que ya se hicieron        
        }

      } ?>
    </h8></p>

    <input type="hidden" name="numSeleccionado" value="<?php echo $numSelec;?>">

    <p>
      <label>
        <input name="celularGroup" value="si" class="with-gap" type="radio" />
        <span>Si</span>
      </label>
    </p>
    <p>
      <label>
        <input name="celularGroup" value="no" class="with-gap" type="radio" />
        <span>No</span>
      </label>
    </p>
  </div>

  <div class="input-field col s12">
    
    <p><font size="4" face="Georgia, Arial">Ahora responda sus preguntas de seguridad</font></p>

  </div>
    
  <?php $i=0; foreach($questAndRespuest as $quest){ $i++; ?>

    <div class="input-field col s6">
    <input type="hidden" name="preguntas[]" value="<?php echo $quest['pregunta']; ?>">
    <center><p><h8><?php echo $quest['pregunta']; ?></h8></p></center>
    </div>

    <div class="input-field col s6">
    <input type="password" id="respuesta[]" name="respuesta[]">
    <label id="respuesta[]">Respuesta <?php echo $i; ?></label>
    </div>

    <?php } ?>
  

</div>
<div class="row margin">

  <input type="submit" name="aceptar" id="aceptar" value="siguiente" class="btn waves-effect waves-light border-round gradient-45deg-blue-grey-blue col s12" style="border-radius: 60px 60px 60px 60px;">
</form>

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
<script src="vista/config/js/validacion_formDatos.js"></script>

</body>
</html>
